<?php

namespace App\Services;

use App\Filters\ProjectFilter;
use App\Http\Resources\TaskNoteResource;
use App\Models\TaskNote;
use Exception;
use Illuminate\Support\Facades\Hash;

/**
 * Class TaskNoteService.
 */
class TaskNoteService
{
    public function __construct(protected TaskNote $task) {
    }
    public function addNew(array $data): TaskNoteResource
    {
        $task = $this->task->create($data);
        return new TaskNoteResource($task);
    }
}
