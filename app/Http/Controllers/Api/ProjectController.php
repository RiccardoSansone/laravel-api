<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index (){
        return response()->json([
            'status' => 'Success',
            'result' => Project::with('type', 'technologies')->paginate(20)
        ]);
    }
    public function show ($id){
        $project = Project::with('type', 'technologies')->where('id', $id)->first();
        if ($project) {
            return response()->json([
                'success' => true,
                'result' => $project
            ]);
        } else {
            return response()->json([
                'success' => false,
                'result' => 'Ops! Page not found'
            ]);
        }
    }
}