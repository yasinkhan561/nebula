<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use ZipArchive;
use App\Models\Page;
use App\Models\Website;
use App\Exports\IssuesExport;
use Excel;

class PageController extends Controller
{


public function index(Request $request)
{
    $pagesQuery = Page::query()->with('website');
    
    if ($request->has('website_id') && $request->website_id !== null) {
        $pagesQuery->where('website_id', $request->website_id);
    }


    $perPage = $request->get('perPage', 25);  // Default to 25 if not specified
    $pages = $pagesQuery->latest()->paginate($perPage);
    $websites = Website::all();
   
   
    if ($request->ajax()) {
        return response()->json([
            'pages' => $pages,
            'websites' => $websites,
            'pagination' => [
                'total' => $pages->total(),
                'per_page' => $pages->perPage(),
                'current_page' => $pages->currentPage(),
                'last_page' => $pages->lastPage(),
                'from' => $pages->firstItem(),
                'to' => $pages->lastItem()
            ]
        ]);
    } else {
        return view('pages.index', compact('pages', 'websites', 'perPage'));
    }
}



    public function export(Request $request){
        return Excel::download(new IssuesExport($request), 'issues.xlsx');
    }

  

    
    
}


