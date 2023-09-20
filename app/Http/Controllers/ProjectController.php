<?php

namespace App\Http\Controllers;

use App\Http\Requests\Project\FilterRequest;
use App\Http\Requests\Project\StoreRequest;
use App\Http\Requests\Project\UpdateRequest;
use App\Services\ProjectService;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class ProjectController extends Controller
{
    use ResponseTrait;
    public function __construct(protected ProjectService $projectService) {

    }

    public function index(FilterRequest $request) : Response {
        try {
            $response = $this->projectService->getAll($request->validated());
            return $this->successResponse("All projects retrieved successfully", $response);
        } catch (Exception $ex) {
            Log::error($ex->getMessage());
            return $this->errorResponse();
        }
    }

    public function store(StoreRequest $request) : Response {
        try {
            $response = $this->projectService->addNew($request->validated());
            return $this->successResponse("Project added successfully", $response, 201);
        } catch (Exception $ex) {
            Log::error($ex->getMessage());
            return $this->errorResponse();
        }
    }

    public function show(int $projectId) : Response {
        try {
            $response = $this->projectService->getOne($projectId);
            return $this->successResponse("Project retrieved successfully", $response);
        } catch (Exception $ex) {
            Log::error($ex->getMessage());
            return $this->errorResponse($ex->getMessage());
        }
    }

    public function update(UpdateRequest $request) : Response {
        try {
            $this->projectService->update($request->validated());
            return $this->successResponse("Project updated successfully");
        } catch (Exception $ex) {
            Log::error($ex->getMessage());
            return $this->errorResponse();
        }
    }

    public function delete(int $projectId) : Response {
        try {
            $this->projectService->delete($projectId);
            return $this->successResponse("Project deleted successfully");
        } catch (Exception $ex) {
            Log::error($ex->getMessage());
            return $this->errorResponse($ex->getMessage());
        }
    }
}
