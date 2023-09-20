<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskNote\StoreRequest;
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
            $response = $this->taskService->addNew($request->validated());
            return $this->successResponse("Task added successfully", $response, 201);
        } catch (Exception $ex) {
            Log::error($ex->getMessage());
            return $this->errorResponse();
        }
    }

}
