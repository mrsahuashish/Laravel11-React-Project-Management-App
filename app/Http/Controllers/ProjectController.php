<?php

namespace App\Http\Controllers;

use App\Models\project;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreprojectRequest;
use App\Http\Requests\UpdateprojectRequest;
use App\Http\Resources\ProjectResource;

class ProjectController extends Controller
{
    public static $wrap = false;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = Project::query();

        $sortFields = request("sort_field", 'created_at');
        $sortDirection = request("sort_direction", "desc");

        if (request('name')) {
            $query->where("name", "like", "%" . request("name") . '%');
        }

        if (request('status')) {
            $query->where("status", request("status"));
        }

        $projects = $query->orderBy($sortFields, $sortDirection)->paginate(10)->onEachSide(1);

        return inertia("Project/Index", [
            "projects" => ProjectResource::collection($projects),
            'queryParams' => request()->query() ?: null,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreprojectRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(project $project)
    {
        $query = $project->tasks();
        
        $sortFields = request("sort_field", 'created_at');
        $sortDirection = request("sort_direction", "desc");

        if (request('name')) {
            $query->where("name", "like", "%" . request("name") . '%');
        }

        if (request('status')) {
            $query->where("status", request("status"));
        }

        $tasks = $query->orderBy($sortFields, $sortDirection)->paginate(10)->onEachSide(1);
        
       return inertia('Project/Show',[
        'project' => new ProjectResource($project),
       ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateprojectRequest $request, project $project)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(project $project)
    {
        //
    }
}
