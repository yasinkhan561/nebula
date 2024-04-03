<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Issue;
use App\Models\Website;
use App\Exports\IssuesExport;
use App\Imports\IssuesImport;

use Excel;

class IssuesController extends Controller
{
    public function index()
    {
        $issues = Issue::all();
        $websites = Website::all(); 
        return view('issues.index', ['issues' => $issues, 'websites' => $websites]);
    }



    public function export(Request $request){
        return Excel::download(new IssuesExport($request), 'issues.xlsx');
    }

    public function import(Request $request){
        $websites = Website::all();
        return view('issues.import', compact('websites'));
    }

    public function import_excel(Request $request){

        if ($request->hasFile('bulk_file')) {
            Excel::import(new IssuesImport($request), $request->file('bulk_file'));
            $request->session()->flash('success', 'Import successful!');
        } else {
            $request->session()->flash('error', 'No file uploaded.');
        }

        return back();
    }
    
}






?>