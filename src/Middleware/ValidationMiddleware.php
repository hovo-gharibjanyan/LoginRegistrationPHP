<?php

namespace App\Middleware;

class ValidationMiddleware
{
    public function handle(array $request, callable $next)
    {
        $errors = [];

        if (!isset($request['name']) || strlen(trim($request['name'])) < 2) {
            $errors[] = 'Name must be at least 2 characters.';
        }

        if (!isset($request['age']) || (int)$request['age'] < 18) {
            $errors[] = 'User must be at least 18 years old.';
        }

        if (!empty($errors)) {
            http_response_code(422);
            echo json_encode(['errors' => $errors]);
            return;
        }

        return $next($request);
    }
}
