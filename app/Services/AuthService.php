<?php

namespace App\Services;

use App\Http\Resources\UserResource;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;

/**
 * Class AuthService.
 */
class AuthService
{
    public function __construct(protected User $user) {
    }
    public function register(array $data): UserResource
    {
        $data['password'] = Hash::make($data['password']);
        $user = $this->user->create($data);
        return new UserResource($user);
    }

    public function login(array $data) : array
    {
        if (auth()->attempt($data)) {
            $token =  auth()->user()->createToken('user')->plainTextToken;
            $user = new UserResource(auth()->user());
            return compact('token', 'user');
        }
        else {
            throw new Exception('Incorrect password');
        }
    }

}
