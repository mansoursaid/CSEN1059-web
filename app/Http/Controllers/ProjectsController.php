<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;

class ProjectsController extends Controller
{
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
        $rules = array(
            'name'=>'required',
            'created_by'=>'required'
        );
        $this->validate($request,$rules);
        $project = new Project;
        $project->name = Input::get('name');
        $project->description    = Input::get('description');
        $project->created_by = Input::get('created_by');
        $project->save();
        return $project;
    }

    public function destroy(Project $project){
        $project->delete();
    }

    public function edit($id){
        $project = Project::findOrfail($id);
        return view('projects.edit')->with('project',$project);
    }

    public function update($id){
        $project = Project::findOrfail($id);
        $project->name = Input::get('name');
        $project->save();
        return $project;
    }

}
