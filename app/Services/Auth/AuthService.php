<?php

namespace App\Services\Auth;

use App\Models\User;
use App\Services\BaseService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthService extends BaseService
{
    public function __construct(protected User $book)
    {
    }

    /**
     * @throws ValidationException
     */
    public function authenticate($data): array
    {
        $user = $this->model::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        $token = $user->createToken($data['email'])->plainTextToken;

        return ['user' => $user, 'token' => $token];
    }

    public function createUser($data)
    {
        $data['password'] = bcrypt($data['password']);
        $user = $this->create($data);

        if(!$user) {
            throw new \Exception('Email already registered');
        }

        return $user;
    }
}
