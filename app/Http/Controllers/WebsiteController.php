<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Website;

class WebsiteController extends Controller
{
    
    public function index()
    {
        $websites = Website::all();
        return view('websites.index', compact('websites'));
    }

     // Show the form for creating a new website
     public function create()
     {
         return view('websites.create');
     }
 
     // Store a newly created website in the database
     public function store(Request $request)
     {
       
        $request->validate([
            'title' => 'required|string|max:255',
            'url' => 'nullable|string|url|max:255',
        ], [
            'title.required' => 'The title field is required.',
            'title.string' => 'The title must be a string.',
            'title.max' => 'The title may not be greater than 255 characters.',
            'url.string' => 'The URL must be a string.',
            'url.url' => 'The URL format is invalid.',
            'url.max' => 'The URL may not be greater than 255 characters.',
        ]);
        

        
 
         Website::create($request->all());
 
         return redirect()->route('websites.index')
                          ->with('success', 'Website created successfully.');
     }
 

 
     // Remove the specified website from the database
     public function destroy($id)
     {
        
        $website = Website::findOrFail($id);
        $website->delete();
 
         return redirect()->route('websites.index')
                          ->with('success', 'Website deleted successfully');
     }
}
