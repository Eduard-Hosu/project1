<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::latest()->paginate(10);
        
        return view('projects.index', compact('projects'));
    }

    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'startDate' => 'required',
            'duration' => 'required',

        ]);
        Project::whereId($id)->update($validatedData);

        return redirect('projects')->with('success', 'Project data is successfully updated');
    }

    public function destroy(Project $project)
    {
        $project->delete();
    
        return redirect('projects')
            ->with('success', 'The project was successfully deleted');
    }
}