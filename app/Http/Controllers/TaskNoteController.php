<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskNote\StoreRequest;
use App\Http\Requests\TaskNote\UpdateRequest;
use App\Services\TaskNoteService;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class TaskNoteController extends Controller
{
    use ResponseTrait;
    public function __construct(protected TaskNoteService $taskNoteService) {

    }


    public function store(StoreRequest $request) : Response {
        try {
            $response = $this->taskNoteService->addNew($request->validated());
            return $this->successResponse("Note added successfully", $response, 201);
        } catch (Exception $ex) {
            Log::error($ex->getMessage());
            return $this->errorResponse();
        }
    }


    public function update(UpdateRequest $request) : Response {
        try {
            $this->taskNoteService->update($request->validated());
            return $this->successResponse("Note updated successfully");
        } catch (Exception $ex) {
            Log::error($ex->getMessage());
            return $this->errorResponse();
        }
    }

    public function delete(int $taskNoteId) : Response {
        try {
            $this->taskNoteService->delete($taskNoteId);
            return $this->successResponse("Note deleted successfully");
        } catch (Exception $ex) {
            Log::error($ex->getMessage());
            return $this->errorResponse($ex->getMessage());
        }
    }

}
