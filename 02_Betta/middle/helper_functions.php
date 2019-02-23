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