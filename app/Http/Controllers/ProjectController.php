<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    public function index()
    {
        $projects = Project::all();
        return view('projects.index', ['projects' => $projects]);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $project = new Project;
        $project->project_name = $request['project_name'];
        $project->description = $request['description'];
        $project->user_id = auth()->user()->id;
        $project->save();

        return redirect('/project')->with('success', 'Project created successfully.');
    }

    public function show(Project $project)
    {
        return view('projects.show', ['project' => $project]);
    }

    public function edit(Project $project)
    {
        //
    }

    public function update(Request $request, Project $project)
    {

        $project->project_name = $request->project_name;
        $project->description = $request->description;
        $project->user_id = auth()->user()->id;

        $project->save();

        return redirect('/project');
    }

    public function destroy(Project $project)
    {
        //
    }
}
