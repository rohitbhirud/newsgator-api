<?php

namespace Core\Middleware;

use Core\Session;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Core\App;
use Core\Database;

class Authenticated
{
    public function handle()
    {
        $authorizationHeader = $_SERVER['HTTP_AUTHORIZATION'] ?? '';

        $config = require base_path('config.php');

        // Check if the authorization header contains a Bearer token
        if (strpos($authorizationHeader, 'Bearer') !== false) {
            $db = App::resolve(Database::class);

            $bearerToken = trim(str_replace('Bearer', '', $authorizationHeader));

            // TODO: catch error on invalid jwt
            $decoded = JWT::decode($bearerToken, new Key($config['jwt']['key'], 'HS256'));

            $userId = $decoded->user_id;

            // Retrieve user data from the database
            $user = $db->get('users', ['id', 'name', 'email'], ['id' => $userId]);

            // If user not found, return a 404 response
            if (!$user) {
                $this->handleErrorResponse('User not found', 404);
            }

            // Store user data in the session
            Session::put('user', $user);

        } else {
            $this->handleErrorResponse('User not authenticated', 403);
        }

    }

    private function handleErrorResponse($message, $statusCode)
    {
        Session::flush();
        jsonResponse($message, null, null, $statusCode);
        die();
    }
}