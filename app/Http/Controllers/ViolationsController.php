<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use ZipArchive;
use App\Models\Tool;
use App\Models\Website;
use App\Models\Status;
use App\Models\Page;
use App\Models\Violation;
use App\Models\Node;
use App\Exports\ViolationExport;
use App\Imports\IssuesImport;
use Excel;
use DateTime;


class ViolationsController extends Controller
{
    private $toolId = 2;
    public function index(Request $request)
    {
        
        
        $violationQuery = Violation::query()->with(['page', 'page.website']);
              
        if ($request->has('website_id') && $request->website_id !== null) {
            $websiteId = $request->website_id;
            $violationQuery = Violation::query()->whereHas('page', function ($query) use ($websiteId) {
                $query->where('website_id', $websiteId);
            })->with(['page', 'page.website']);
        }

     
        if ($request->has('sortBy') && $request->sortBy !== null) {
            if ($request->has('sortBy') && $request->sortBy == 'batch') {
                // Sort by batch in the pages table
                $violationQuery->select('violations.*') // Ensure only violation fields are selected to avoid column name conflicts
                               ->join('pages', 'pages.id', '=', 'violations.page_id')
                               ->orderBy('pages.batch', $request->get('sortOrder', 'asc')); // Default sort order is ascending
            } else if ($request->has('sortBy') && $request->sortBy == 'website_id'){
                $violationQuery->select('violations.*') // Ensure only violation fields are selected to avoid column name conflicts
                ->join('pages', 'pages.id', '=', 'violations.page_id')
                ->orderBy('pages.website_id', $request->get('sortOrder', 'asc'));
            }
            else {
                // Sort by violation field
                $sortOrder = $request->get('sortOrder', 'asc'); // Default to ascending
                $violationQuery->orderBy($request->sortBy, $sortOrder);
            }
           
        }
    
        $perPage = $request->get('perPage', 25);  
        $violations = $violationQuery->latest()->paginate($perPage);
        $tool = Tool::findorfail($this->toolId); 
        $websites = Website::where('tool_id', $tool->id)->get();
        $statuses = Status::all();
       
       
        if ($request->ajax()) {
            return response()->json([
                'tool' => $tool,
                'violations' => $violations,
                'websites' => $websites,
                'statuses' => $statuses,
                'pagination' => [
                    'total' => $violations->total(),
                    'per_page' => $violations->perPage(),
                    'current_page' => $violations->currentPage(),
                    'last_page' => $violations->lastPage(),
                    'from' => $violations->firstItem(),
                    'to' => $violations->lastItem()
                ]
            ]);
        } else {
            return view('violations.index', compact('tool','violations', 'websites','statuses', 'perPage'));
        }
    }
    
    
    
        public function export(Request $request){
            $toolName = Tool::find($this->toolId)->name;
            $fileName = $toolName.' issues.xlsx';
            return Excel::download(new ViolationExport($request),  $fileName);
        }
    
        public function import(Request $request){
            $websites = Website::where('tool_id', $this->toolId)->get();
            $tool = Tool::find($this->toolId);
            return view('violations.import', compact('tool','websites'));
        }
    
        public function import_excel(Request $request)
        {
            if ($request->hasFile('bulk_file')) {
                $file = $request->file('bulk_file');
                $extension = $file->getClientOriginalExtension();
    
                switch ($extension) {
                    case 'xlsx':
                    case 'csv':
                        Excel::import(new IssuesImport($request->website), $file);
                        $request->session()->flash('success', 'Import successful!');
                        break;
    
                    case 'zip':
                        $zip = new ZipArchive;
                        $extractPath = storage_path('app/temp'); // Change to your desired extraction path
    
                        if ($zip->open($file) === TRUE) {
                            $zip->extractTo($extractPath);
                            $zip->close();
    
    
                            if ($extractPath) {
                                $files = File::allFiles($extractPath);
                                echo "<pre>";
                                foreach ($files as $file) { 
                                    if ($file->getExtension() === 'json') {
                                            $filePath = $file->getRealPath();
                                            $jsonContent = file_get_contents($file->getRealPath());
                                            $data = json_decode($jsonContent, true);

                                            foreach($data["pages"] as $page){
                                                $dateTime = new DateTime($page["timestamp"]);
                                                $mysqlDateTime = $dateTime->format('Y-m-d H:i:s');

                                                $newPage = new Page;
                                                $newPage->website_id = $request->website;
                                                $newPage->batch = $data["metadata"]["batch_id"];
                                                $newPage->url = $page["url"];
                                                $newPage->nodes = $page["page_analytics"]["num_nodes"];
                                                $newPage->critical = $page["page_analytics"]["num_critical"];
                                                $newPage->serious = $page["page_analytics"]["num_serious"];
                                                $newPage->moderate = $page["page_analytics"]["num_moderate"];
                                                $newPage->minor = $page["page_analytics"]["num_minor"];
                                                $newPage->score = $page["page_analytics"]["page_score"];
                                                $newPage->aria = isset($page["page_analytics"]["category_count"]["aria"]) ? $page["page_analytics"]["category_count"]["aria"]:0;
                                                $newPage->forms = isset($page["page_analytics"]["category_count"]["forms"]) ? $page["page_analytics"]["category_count"]["forms"]:0;
                                                $newPage->name_role_value = isset($page["page_analytics"]["category_count"]["name-role-value"]) ? $page["page_analytics"]["category_count"]["name-role-value"]:0;
                                                $newPage->scan_time = $mysqlDateTime;
                                                $newPage->save();

                                                $lastInsertedId = $newPage->id;
                                               

                                                foreach($page["violations"] as $currentViolation){
                                                
                                                    $violation = new Violation; // Assuming Violation is your model class
                                                    $violation->page_id = $lastInsertedId;
                                                    $violation->violation = $currentViolation["id"];
                                                    $violation->description = $currentViolation["description"];
                                                    $violation->help = $currentViolation["help"];
                                                    $violation->help_url = $currentViolation["helpUrl"];
                                                    $violation->impact = $currentViolation["impact"];
                                                    $violation->tags = json_encode($currentViolation["tags"]);
                                                    $violation->save();
                                                    
                                                    // // Retrieve the last inserted ID
                                                    $lastViolationId = $violation->id;


                                                if($currentViolation["nodes"]  && !empty($currentViolation["nodes"])){

                                                        foreach($currentViolation["nodes"] as $node){
                                                            $newNode = new Node;
                                                            $newNode->violation_id = $lastViolationId;
                                                            $newNode->any = (!empty($node["any"])) ? json_encode($node["any"]) : null;
                                                            $newNode->all = (!empty($node["all"])) ? json_encode($node["all"]) : null;
                                                            $newNode->none = (!empty($node["none"])) ? json_encode($node["none"]) : null;
                                                            $newNode->node_impact = $node["impact"];
                                                            $newNode->html = isset($node["html"]) ? $node["html"] : null;
                                                            $newNode->target = isset($node["target"]) ? json_encode($node["target"]) : null;
                                                            $newNode->failureSummary = isset($node["failureSummary"]) ? $node["failureSummary"] : null;
                                                            $newNode->save();
                                                        }

                                                }
                                            }
                                        }
                                    }
                                    File::delete($file->getRealPath()); 
                                }
                              
                                $request->session()->flash('success', 'Zip file extracted and imported successfully!');
                            } else {
                                $request->session()->flash('error', 'Pages folder not found in the zip file.');
                            }
                        } else {
                            $request->session()->flash('error', 'Failed to open zip file.');
                        }
                        break;
    
                    case 'json':
                        // Placeholder for JSON handling logic
                        $request->session()->flash('success', 'JSON file handling will be implemented soon.');
                        break;
    
                    default:
                        $request->session()->flash('error', 'Unsupported file type.');
                }
            } else {
                $request->session()->flash('error', 'No file uploaded.');
            }
    
            return back();
        }
    
    
        private function findPagesFolder($directory)
        {
            $directories = new \RecursiveIteratorIterator(
                new \RecursiveDirectoryIterator($directory),
                \RecursiveIteratorIterator::SELF_FIRST
            );
    
            foreach ($directories as $dir) {
                if ($dir->isDir() && basename($dir) === 'pages') {
                    return $dir->getPathname();
                }
            }
    
            return null;
        }

        public function updateStatus(Request $request)
        {
            $request->validate([
                'violationId' => 'required|integer',
                'statusId' => 'required|integer',
            ]);
    
            $violation = Violation::find($request->violationId);
            if (!$violation) {
                return false;
            }
    
            $violation->status_id = $request->statusId;
            $violation->save();
    
            return true;
            
        }

        public function bulkUpdate(Request $request)
        {
            $request->validate([
                'issueIds' => 'required|array',
                'statusId' => 'required|integer',
            ]);
    
            $issues = Violation::whereIn('id', $request->issueIds)->get();
            if ($issues->isEmpty()) {
                return false;
            }
    
            $issues->each(function ($issue) use ($request) {
                $issue->status_id = $request->statusId;
                $issue->save();
            });
    
            return true;
        }
}
