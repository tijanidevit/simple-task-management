<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\AuthService;
use App\Traits\ResponseTrait;
use Exception;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    use ResponseTrait;
    public function __construct(protected AuthService $authService) {

    }

    // public function logout() : Response {
    //     auth()->logout();
    // }

    public function login(LoginRequest $request) : Response {
        try {
            $response = $this->authService->login($request->validated());
            return $this->successResponse("Login successful", $response);
        } catch (Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 422);
        }
    }

    public function register(RegisterRequest $request) : Response {
        try {
            $user = $this->authService->register($request->validated());
            return $this->successResponse("Registration successful", $user);
        } catch (Exception $ex) {
            return $this->errorResponse($ex->getMessage(), 422);
        }
    }
}
