<?php

use Core\App;
use Core\Database;
use Core\Validator;

class RegisterController
{

    function register()
    {

        $db = App::resolve(Database::class);

        // Retrieve the input data
        $email = $_POST['email'] ?? null;
        $password = $_POST['password'] ?? null;
        $name = $_POST['name'] ?? null;

        $errors = [];

        // Check if email, password, or name is missing
        if (!$email || !$password || !$name) {
            $errors['missing_fields'] = 'Please provide all the required fields.';
            return jsonResponse('Validation failed', null, $errors, 400);
        }


        // Validate the email
        if (!Validator::email($email)) {
            $errors['email'] = 'Please provide a valid email address.';
        }

        // Validate the password
        if (!Validator::string($password, 6, 255)) {
            $errors['password'] = 'Please provide a password of minimum six characters.';
        }

        // Validate the name
        if (!Validator::string($name, 1, 255)) {
            $errors['name'] = 'Please provide a name of minimum one characters.';
        }

        // If validation errors exist, return a JSON response with errors and 400 status
        if (!empty($errors)) {
            return jsonResponse('Validation failed', null, $errors, 400);
        }

        // Check if the user already exists
        $user = $db->select(
            'users',
            'email',
            ['email' => $email]
        );


        if ($user) {
            // If the user exists, return a JSON response with a message anduser data
            return jsonResponse('User already exists', $user, null);
        } else {
            // insert the user into the database
            $db->insert('users', [
                'email' => $email,
                'name' => $name,
                'password' => password_hash($password, PASSWORD_BCRYPT),
                'created' => date('Y-m-d H:i:s')
            ]);

            // Return a JSON response with a success message
            return jsonResponse('User created', $email, null);
        }
    }
}

return new RegisterController();