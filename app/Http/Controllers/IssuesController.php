<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use ZipArchive;
use App\Models\Tool;
use App\Models\Issue;
use App\Models\Website;
use App\Models\Status;
use App\Exports\IssuesExport;
use App\Imports\IssuesImport;

use Excel;

class IssuesController extends Controller
{
    private $toolId = 1;

    public function index(Request $request)
    {
        $issuesQuery = Issue::query()->with('website');
        
        if ($request->has('website_id') && $request->website_id !== null) {
            $issuesQuery->where('website_id', $request->website_id);
        }

        if ($request->has('sortBy') && $request->sortBy !== null) {
            $sortOrder = $request->get('sortOrder', 'asc'); // Default to ascending
            $issuesQuery->orderBy($request->sortBy, $sortOrder);
        }


        $perPage = $request->get('perPage', 25);  // Default to 25 if not specified
        $issues = $issuesQuery->latest()->paginate($perPage);




        $tool = Tool::findorfail($this->toolId); // 1 is the ID of the UsableNet AQA tool
        $websites = Website::where('tool_id', $tool->id)->get();
        $statuses = Status::all();

    
        if ($request->ajax()) {
            return response()->json([
                'issues' => $issues,
                'tool' => $tool,
                'websites' => $websites,
                'statuses' => $statuses,
                'pagination' => [
                    'total' => $issues->total(),
                    'per_page' => $issues->perPage(),
                    'current_page' => $issues->currentPage(),
                    'last_page' => $issues->lastPage(),
                    'from' => $issues->firstItem(),
                    'to' => $issues->lastItem()
                ]
            ]);
        } else {
            return view('issues.index', compact('tool', 'issues', 'websites','statuses', 'perPage'));
        }
    }



    public function export(Request $request){
        $toolName = Tool::find($this->toolId)->name;
        $fileName = $toolName.' issues.xlsx';
        return Excel::download(new IssuesExport($request), $fileName);
    }

    public function import(Request $request){
        $websites = Website::where('tool_id', $this->toolId)->get();
        $tool = Tool::find($this->toolId);
        return view('issues.import', compact('tool','websites'));
    }

    public function import_excel(Request $request)
    {
        if ($request->hasFile('bulk_file')) {
            $file = $request->file('bulk_file');
            $extension = $file->getClientOriginalExtension();
            

            switch ($extension) {
                case 'xlsx':
                    $singleFileName = $file->getClientOriginalName();
                    Excel::import(new IssuesImport($request->website, [$singleFileName, $file->getPathname()]), $file->getPathname());
                    $request->session()->flash('success', 'Import successful!');
                    break;

                case 'zip':
                    $zip = new ZipArchive;
                    $extractPath = storage_path('app/temp'); // Change to your desired extraction path

                    if ($zip->open($file) === TRUE) {
                        $zip->extractTo($extractPath);
                        $zip->close();

                        $pagesDir = $this->findPagesFolder($extractPath);

                        if ($pagesDir) {
                            $files = File::allFiles($pagesDir);

                            foreach ($files as $file) {
                                if (in_array($file->getExtension(), ['xlsx', 'csv'])) {
                                  
                                    Excel::import(new IssuesImport($request->website, [$file->getFileName(), $file->getPathname()]), $file->getPathname());
                                
                                    File::delete($file->getRealPath());
                                }
                            }
                          

                            $request->session()->flash('success', 'Zip file extracted and imported successfully!');
                        } else {
                            $request->session()->flash('error', 'Pages folder not found in the zip file.');
                        }
                    } else {
                        $request->session()->flash('error', 'Failed to open zip file.');
                    }
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
            'issueId' => 'required|integer',
            'statusId' => 'required|integer',
        ]);

        $issue = Issue::find($request->issueId);
        if (!$issue) {
            return false;
        }

        $issue->status_id = $request->statusId;
        $issue->save();

        return true;
        
    }


    public function bulkUpdate(Request $request)
    {
        $request->validate([
            'issueIds' => 'required|array',
            'statusId' => 'required|integer',
        ]);

        $issues = Issue::whereIn('id', $request->issueIds)->get();
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






?>