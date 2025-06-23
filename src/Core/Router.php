<?php
namespace App\Core;

use App\Controller\AuthController;

// This class handles routing for the application.

class Router {
    public function route(string $method, string $uri): void {
        $authController = new AuthController();

        if ($method === 'POST' && $uri === '/api/register') { // Проверяем метод и маршрут для регистрации
            $data = json_decode(file_get_contents('php://input'), true);    // Получаем данные из тела запроса
            $authController->register($data);   // Вызываем метод регистрации контроллера
            return;
        }

        if ($method === 'POST' && $uri === '/api/login') {
            $data = json_decode(file_get_contents('php://input'), true);
            $authController->login($data);
            return;
        }

        // Если маршрут не найден
        http_response_code(404);
        echo json_encode(['error' => 'Not Found']);
    }
}