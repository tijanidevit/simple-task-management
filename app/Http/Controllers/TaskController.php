<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\FilterRequest;
use App\Http\Requests\Task\StoreRequest;
use App\Http\Requests\Task\UpdateRequest;
use App\Services\TaskService;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    use ResponseTrait;
    public function __construct(protected TaskService $taskService) {

    }

    public function index(FilterRequest $request) : Response {
        try {
            $response = $this->taskService->getAll($request->validated());
            return $this->successResponse("All tasks retrieved successfully", $response);
        } catch (Exception $ex) {
            Log::error($ex->getMessage());
            return $this->errorResponse();
        }
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

    public function show(int $taskId) : Response {
        try {
            $response = $this->taskService->getOne($taskId);
            return $this->successResponse("Task retrieved successfully", $response);
        } catch (Exception $ex) {
            Log::error($ex->getMessage());
            return $this->errorResponse($ex->getMessage(), 404);
        }
    }



    public function update(UpdateRequest $request) : Response {
        try {
            $this->taskService->update($request->validated());
            return $this->successResponse("Task updated successfully");
        } catch (Exception $ex) {
            Log::error($ex->getMessage());
            return $this->errorResponse();
        }
    }

    public function delete(int $taskId) : Response {
        try {
            $this->taskService->delete($taskId);
            return $this->successResponse("Task deleted successfully");
        } catch (Exception $ex) {
            Log::error($ex->getMessage());
            return $this->errorResponse($ex->getMessage());
        }
    }
}
