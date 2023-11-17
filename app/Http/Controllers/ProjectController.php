<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::orderByDesc('id')->paginate(10);
        // $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {


        $validated = $request->validate([
            'title' => 'required|max:50|min:2',
            'description' => 'nullable|max:1000|min:2',
            'authors' => 'nullable|max:50|min:2',
            'thumb' => 'nullable|mimes:jpg,bmp,png|max:300',
            'projectlink' => 'nullable|url:http,https',
            'githublink' => 'nullable|url:http,https',

        ]);

        $project = new Project();



        if ($request->has('thumb')) {
            $file_path =  Storage::put('projects_images', $request->thumb);
            $project ->thumb = $file_path;
        }

        $project->githublink = $request->githublink;
        $project->projectlink = $request->projectlink;
        $project->description = $request->description;
        $project->title = $request->title;
        $project->authors = $request->authors;
        $project->type_id = $request->type_id;
        $project->save();
        $project->technologies()->attach($request->technologies);
        return to_route('project.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        $technologies = Technology::all();
        return view('admin.projects.show', compact('project', 'technologies'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.edit', compact('project','types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {

        $validated = $request ->validate([
            'title'=>'required|max:50|min:4',
            'description'=>'nullable|max:1000|min:3',
            'authors'=>'nullable|max:1000|min:3'
        ]);

        $data = $request->all();

        
        if ($request->has('thumb')) {
            $file_path =  Storage::put('projects_images', $request->thumb);
            $project ->thumb = $file_path;
            $data['thumb'] = $file_path;
        }

        $project->technologies()->detach();

        $project->update($data);

        $project->technologies()->attach($request->technologies);

        return redirect()->route('project.show', $project->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->technologies()->detach();
        $project->delete();
        return redirect()->route('project.index')->with('messaggio', 'hai cancellato il progetto con successo!');
    }
}
