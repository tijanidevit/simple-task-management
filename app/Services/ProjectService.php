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

}
