<?php

namespace App\Http\Controllers\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\SignUpRequest;
use App\Services\Auth\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    private $auth;

    public function __construct(AuthService $auth)
    {
        $this->auth = $auth;
    }

    /**
     * @OA\Post(
     *     path="/api/v1/login",
     *     operationId="Login",
     *     tags={"Auth"},
     *     summary="Login",
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="email", type="string"),
     *             @OA\Property(property="password", type="string"),
     *         ),
     *     ),
     *     @OA\Response(response="200", description="success"),
     *     @OA\Response(response="401", description="error"),
     * ),
     */
    public function postLogin(LoginRequest $request): JsonResponse
    {
        try {
            $data = $request->only(['email', 'password']);
            $result = $this->auth->authenticate($data);

            return $this->responseOk($result);
        } catch (ValidationException $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 401);
        }
    }

    /**
     * @OA\Post(
     *     path="/api/v1/signup",
     *     operationId="SignUp",
     *     tags={"Auth"},
     *     summary="Create a new user",
     *     @OA\RequestBody(
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="name", type="string"),
     *             @OA\Property(property="email", type="string"),
     *             @OA\Property(property="password", type="string"),
     *         ),
     *     ),
     *     @OA\Response(response="201", description="User created successfully"),
     *     @OA\Response(response="422", description="Invalid input"),
     * )
     */
    public function postSignUp(SignUpRequest $request): JsonResponse
    {
        $data = $request->all();

        try {
            $user = $this->auth->createUser($data);

            return response()->json([
                'data' => ['message' => 'User created successfully!', 'user' => $user]
            ], 201);
        } catch (\Exception $e) {
            return $this->responseUnprocessableEntity();
        }
    }
}
