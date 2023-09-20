<?php

namespace App\Services;

use App\Filters\ProjectFilter;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Exception;
use Illuminate\Support\Facades\Hash;

/**
 * Class ProjectService.
 */
class ProjectService
{
    public function __construct(protected Project $project) {
    }
    public function addNew(array $data): ProjectResource
    {
        $data['user_id'] = auth()->id();
        $project = $this->project->create($data);
        return new ProjectResource($project);
    }

    public function getAll($filters) : mixed
    {
        $query = $this->project->where('user_id', auth()->id());

        ProjectFilter::apply($query, $filters);

        $projects = $query->get();
        return ProjectResource::collection($projects);
    }

    public function getOne(int $projectId) : ProjectResource
    {
        $project = $this->project->where('user_id', auth()->id())
                    ->where('id', $projectId)
                    ->with('tasks')->first();

        if (!$project) {
            throw new Exception("Project not found");
        }

        return new ProjectResource($project);
    }


    public function update(array $data): ProjectResource
    {
        $project = $this->project->where('id', $data['id'])->update($data);
        return new ProjectResource($project);
    }

    public function delete(int $projectId) : void
    {
        $project = $this->project->where('user_id', auth()->id())
                    ->where('id', $projectId)
                    ->with('tasks')->first();


        if (!$project) {
            throw new Exception("Project not found");
        }

        $project->tasks()->delete();
        $project->delete();
        //could have used database cascade in the migration
    }

}
