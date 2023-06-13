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

    return jsonResponse('Not Found');
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

    // Set the response status code
    http_response_code($statusCode);

    // Convert the response data to JSON
    $jsonResponse = json_encode($response);

    // Return the JSON response
    echo $jsonResponse;
}

function base_path($path)
{
    return BASE_PATH . $path;
}


function old($key, $default = '')
{
    return Core\Session::get('old')[$key] ?? $default;
}