<?php

use Core\Response;

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

function jsonResponse($message, $data = null)
{

    $response = [
        'message' => $message,
        'data' => $data
    ];

    // Set the response content type to JSON
    header("Content-Type: application/json");

    // Convert the response data to JSON
    $jsonResponse = json_encode($response);

    // Return the JSON response
    echo $jsonResponse;
}

function base_path($path)
{
    return BASE_PATH . $path;
}