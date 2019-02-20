<?php
/**
 *  Author:  Braulio Tonaco
 *  Date:    2019-02-19
 *  Class    CS490
 */

$DEBUG = 0;

if ($DEBUG) {
    echo("<b>############ Debugging ############</b><br>");
    $data = array(
        "request_id" => "LOGIN",
        "username" => "user",
        "password" => "pass"
    );
} else
    $data = json_decode(file_get_contents("php://input"), true);


switch ($data["request_id"]) {
    case "LOGIN":
        $response = array("role" => authenticate_credentials($data));
        if ($DEBUG)
            debug_print($data, $response, "LOGIN");
        else
            echo(json_encode($response));
        break;
    case "T_CREATE":
        $response = get_all_questions($data);
        if ($DEBUG)
            debug_print($data, $response, "T_CREATE");
        else
            echo(json_encode($response));
        break;
    case "T_ADD":
        // TODO: Send added question to backend and return updated questions list from backend
        echo("Add questions block");
        break;
    case "S_MAIN":
        // TODO: Request all available test questions from backend and return response in json format to front-end
        echo("Retrieve Questions block");
        break;
    case "S_TEST":
        // TODO: Request all available test questions from backend and return response in json format to front-end
        echo("Retrieve Questions block");
        break;
    case "S_GRADES":
        // TODO: Send added question to backend and return updated questions list from backend
        echo("Add questions block");
        break;
    default:
        // TODO: Invalid request
        echo("Invalid request block");
}


function authenticate_credentials($data)
{
    $url = "https://web.njit.edu/~jsf25/";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    $response = json_decode(curl_exec($ch), true);
    curl_close($ch);

    if ($GLOBALS['DEBUG'])
        return 1;
    else
        return $response['role'];
}

function get_all_questions($data)
{
    $url = "https://web.njit.edu/~jsf25/";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    $response = json_decode(curl_exec($ch), true);
    curl_close($ch);

    if ($GLOBALS['DEBUG'])
        return json_decode(file_get_contents("questions.json"), true);
    else
        return $response;
}

function debug_print($input, $output, $case)
{
    switch ($case) {
        case "LOGIN":
            echo("<br>Retrieve Questions block");
            break;
        case "T_CREATE":
            echo("<br>Retrieve Questions block");
            break;
    }
    echo("<br><br>INPUT: ");
    var_dump($input);
    echo("<br><br>OUTPUT: ");
    var_dump($output);
}
