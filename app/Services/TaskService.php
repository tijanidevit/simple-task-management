<?php

namespace App\Services;

use App\Filters\ProjectFilter;
use App\Http\Resources\TaskResource;
use App\Models\Task;
use Exception;
use Illuminate\Support\Facades\Hash;

/**
 * Class TaskService.
 */
class TaskService
{
    public function __construct(protected Task $task) {
    }
    public function addNew(array $data): TaskResource
    {
        $task = $this->task->create($data);
        return new TaskResource($task);
    }

    public function getAll($filters) : mixed
    {
        $query = $this->task->with('project')->whereHas('project', function ($query) {
            return $query->where('user_id', auth()->id());
        });

        ProjectFilter::apply($query, $filters);

        $tasks = $query->get();
        return TaskResource::collection($tasks);
    }

    public function getOne(int $taskId) : TaskResource
    {
        $task = $this->task
        ->with('notes')
        ->where('id', $taskId)
        ->whereHas('project', function ($query) {
            return $query->where('user_id', auth()->id());
        })->first();

        if (!$task) {
            throw new Exception("Task not found");
        }

        return new TaskResource($task);
    }

    public function update(array $data): TaskResource
    {
        $task = $this->task->where('id', $data['id'])->update($data);
        return new TaskResource($task);
    }

    public function delete(int $taskId) : void
    {
        $task = $this->task
            ->with('notes')
            ->where('id', $taskId)
            ->whereHas('project', function ($query) {
                return $query->where('user_id', auth()->id());
            })->first();


        if (!$task) {
            throw new Exception("Project not found");
        }

        $task->notes()->delete();
        $task->delete();
        //could have used database cascade in the migration
    }

}
