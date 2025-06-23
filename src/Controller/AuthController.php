<?php

namespace App\Controller;

use App\Model\User;
use App\Repository\UserRepository;
use App\Core\Database;
use App\Helpers\Response;
use App\Middleware\ValidationMiddleware;

class AuthController
{
    private UserRepository $userRepo;

    public function __construct()
    {
        $this->userRepo = new UserRepository(new Database());
    }

    // POST /api/register
    public function register(array $body)
    {
        $middleware = new ValidationMiddleware();

        $middleware->handle($body, function ($validRequest) {
            $user = new User(
                $validRequest['name'],
                $validRequest['email'],
                $validRequest['password']
            );

            $this->userRepo->save($user); //  используем уже созданный объект

            http_response_code(201);
            echo json_encode(['message' => 'User registered successfully']);
        });
    }

    // POST /api/login
    public function login(array $data): void
    {
        $user = $this->userRepo->findByEmail($data['email']);

        if (!$user || !password_verify($data['password'], $user->password)) {
            Response::json(['error' => 'Invalid credentials'], 401);
            return;
        }

        $token = base64_encode(json_encode([
            'user_id' => $user->id,
            'exp' => time() + 3600,
        ]));

        Response::json(['token' => $token]);
    }
}
