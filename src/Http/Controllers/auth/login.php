<?php

use Core\App;
use Core\Database;
use Core\Session;
use Firebase\JWT\JWT;

class LoginController
{
    function login()
    {
        // validate request
        // if user exists and password is correct
        // return jwt token

        $db = App::resolve(Database::class);

        // Retrieve the input data
        $email = $_POST['email'] ?? null;
        $password = $_POST['password'] ?? null;

        $errors = [];

        // Check if email, password, or name is missing
        if (!$email || !$password) {
            $errors['missing_fields'] = 'Please provide all the required fields.';
            return jsonResponse('Validation failed', null, $errors, 400);
        }

        $user = $db->get(
            'users',
            '*'
            ,
            ['email' => $email]
        );

        if ($user) {
            if (password_verify($password, $user['password'])) {

                // Generate JWT token
                $config = require base_path('config.php');
                $jwtSecret = $config['jwt']['key'];

                $jwtPayload = [
                    'user_id' => $user['id'],
                    'email' => $user['email'],
                    'name' => $user['name']
                    // Add more data as needed
                ];

                $jwtToken = JWT::encode($jwtPayload, $jwtSecret, 'HS256');

                return jsonResponse('Login successful', ['token' => $jwtToken]);
            }
        }

        return jsonResponse('email or password is incorrect', null, [], 400);
    }

    public function logout()
    {
        Session::destroy();
    }

}

return new LoginController();