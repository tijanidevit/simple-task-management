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
    public function __construct(protected TaskNote $taskNote) {
    }
    public function addNew(array $data): TaskNoteResource
    {
        $taskNote = $this->taskNote->create($data);
        return new TaskNoteResource($taskNote);
    }


    public function update(array $data): TaskNoteResource
    {
        $taskNote = $this->taskNote->where('id', $data['id'])->update($data);
        return new TaskNoteResource($taskNote);
    }

    public function delete(int $taskNoteId) : void
    {
        $this->taskNote->where('id', $taskNoteId)->delete();
    }
}
