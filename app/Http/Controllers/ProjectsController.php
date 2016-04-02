<?php

namespace App\Http\Controllers;

use App\Project;
use Illuminate\Http\Request;

use App\Http\Requests;

class ProjectsController extends Controller
{
    public function index(){
        $projects = Project::all();
        return $projects;
    }
}
