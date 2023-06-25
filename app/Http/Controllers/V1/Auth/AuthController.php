<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\AuthRequest;
use App\Services\Auth\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Exception;

class AuthController extends Controller
{
    private $auth;

    public function __construct(AuthService $auth)
    {
        $this->auth = $auth;
    }

    public function postLogin (LoginRequest $request): JsonResponse
    {
        try {
            $data = $request->only(['email', 'password']);
            $result = $this->auth->authenticate($data);

            return response()->json(['data' => $result], 200);
        } catch (ValidationException $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 401);
        }
    }

    public function postSignUp(SignUpRequest $request)
    {
        $data = $request->all();

        try {
            $user = $this->user->createUser($data);

            return response()->json([
                'data' => ['message' => 'User created successfully!', 'user' => $user]
            ], 201);
        } catch (DefaultException $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], $e->getCode());
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 500);
        }
    }
}
