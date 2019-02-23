<?php

function send_to_backend($data)
    /** Sends input data from front-end to backend **/
{
    $url = "https://web.njit.edu/~jsf25/";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    $response = curl_exec($ch);
    curl_close($ch);

    return $response;
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