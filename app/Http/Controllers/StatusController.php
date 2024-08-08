<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Status;

class StatusController extends Controller
{
    public function index()
    {
        $statuses = Status::all();
        return view('statuses.index', compact('statuses'));
    }

     // Show the form for creating a new website
     public function create()
     {
         return view('statuses.create');
     }
 
     // Store a newly created website in the database
     public function store(Request $request)
     {
       
        $request->validate([
            'status' => 'required|string|max:255',
        ], [
            'status.required' => 'The status field is required.',
            'status.string' => 'The status must be a string.',
            'status.max' => 'The status may not be greater than 255 characters.',
        ]);
        
 
         Status::create($request->all());
 
         return redirect()->route('statuses.index')
                          ->with('success', 'Status created successfully.');
     }
 

 
     // Remove the specified website from the database
     public function destroy($id)
     {
        
        $website = Status::findOrFail($id);
        $website->delete();
 
         return redirect()->route('statuses.index')
                          ->with('success', 'Status deleted successfully');
     }
}
