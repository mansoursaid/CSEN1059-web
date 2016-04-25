<?php

namespace App\Http\Controllers;

use App\Project;
use App\User;
use App\Project_User;
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

    public function addUserToProject($id , $pid) {
       
        if(User::find($id)) {
            $project_user = new Project_User;
            $project_user->user_id = $id;
            $project_user->project_id = $pid;
            $project_user->save();
            return $project_user;
        }else{
            //error message
            echo 'errorrrr';
        }

    }

    public function addUsersToProject($users, $pid){
        if(Project::find($pid)){
            foreach ($users as $user){
                $id = $user->id;
                if(Project_User::where('user_id', $id )->where('project_id',$pid)->get()!=null) {
                    $this->addUserToProject($id, $pid);
                }else{
                    echo 'already exists';
                }
            }

        }else{
            echo 'errrorrrr';
        }

    }

}
