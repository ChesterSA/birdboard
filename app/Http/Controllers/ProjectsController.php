<?php

namespace App\Http\Controllers;
use App\Http\Requests\UpdateProjectRequest;
use App\Project;

use Illuminate\Http\Request;


class ProjectsController extends Controller
{
    public function index()
    {
      $projects = auth()->user()->projects()->get();

      return view('projects.index', compact('projects'));
    }

    public function show(Project $project)
    {
      $this->authorize('update', $project);

      return view('projects.show', compact('project'));
    }

    public function store()
    {
      $project = auth()->user()->projects()->create($this->validateRequest());

      return redirect($project->path());
    }

    public function create()
    {
      return view('projects.create');
    }

    public function update(UpdateProjectRequest $request)
    {

      return redirect($request->save()->path());
    }

    public function edit(Project $project)
    {
      return view('projects.edit', compact('project'));
    }

    private function validateRequest(){
      return request()->validate([
        'title' => 'sometimes|required',
        'description' => 'sometimes|required',
        'notes' => 'nullable'
      ]);
    }
}
