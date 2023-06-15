<?php

function dd($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";

    die();
}

function abort($code = 404)
{
    http_response_code($code);

    jsonResponse('Not Found');
    die();
}


function jsonResponse($message, $data = null, $errors = null, $statusCode = 200)
{

    $response = [
        'message' => $message,
        'data' => $data,
        'error' => ($errors !== null),
    ];

    if ($errors !== null) {
        $response['errors'] = $errors;
    }

    // Set the response content type to JSON
    header("Content-Type: application/json");

    header("Access-Control-Allow-Origin: *");

    header('Access-Control-Allow-Methods: GET, POST');

    header("Access-Control-Allow-Headers: X-Requested-With");

    // Set the response status code
    http_response_code($statusCode);

    // Convert the response data to JSON
    $jsonResponse = json_encode($response);

    // Return the JSON response
    echo $jsonResponse;

    die();
}

function base_path($path)
{
    return BASE_PATH . $path;
}


function old($key, $default = '')
{
    return Core\Session::get('old')[$key] ?? $default;
}