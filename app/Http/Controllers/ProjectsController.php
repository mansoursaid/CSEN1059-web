<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use Auth;

class ProjectsController extends Controller
{

    public function __construct() {
        $this->middleware('isAdmin', ['only' => ['destroy', 'edit', 'update']]);
    }

    public function index(){
        $projects = Project::all();
        return $projects;
    }

    public function show($id){
        $project = Project::findOrfail($id);
        return $project;
    }

    public function create(){
        return view('projects.create');
    }

    public function store(Request $request){

        // validations
        $this->validate($request, [
            'name' => 'required|min:3|max:12',
            'description' => 'required|min:3s',
            'created_by' => 'required'
        ]);
        error_log($request->created_by);

        // create a new project
        $project = Project::create($request->all());
        $user = Auth::user();

        // create the many_to_many relation between projects & users
        $project->users()->attach($user->id);

        $request->session()->flash('status', 'project_creation_success');
        return back();
    }

    public function destroy($id, Request $request){
        $project = Project::find($id);

        if($project->delete())
        {
            $request->session()->flash('status', 'project_delete_success');
        }
        else
        {
            $request->session()->flash('status', 'project_delete_failure');
        }

        return back();
    }

    public function edit($id){

        $project = Project::find($id);
        return view('projects.edit', compact('project'));
    }

    public function update($id, Request $request){

        $project = Project::find($id);

        $newName = $request->name;
        $newDescription = $request->description;

        $project->name = $newName;
        $project->description = $newDescription;

        if($project->save()){
            $request->session()->flash('status', 'project_update_success');
        }
        else
        {
            $request->session()->flash('status', 'project_update_failure');
        }

        return redirect("projects");

    }

    public function projectsAddAndIndex(Request $request){

        $projects = Project::all();
        $user = Auth::user();

        return view('projects.projectsAddAndIndex', compact('projects', 'user'));
    }

}
