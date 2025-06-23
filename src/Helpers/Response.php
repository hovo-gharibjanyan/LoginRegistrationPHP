<?php
namespace App\Helpers;

// This class provides helper methods for sending JSON responses.
class Response {    
    public static function json(array $data, int $status = 200): void {
        http_response_code($status);
        header('Content-Type: application/json');
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        exit;
    }
}