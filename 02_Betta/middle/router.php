<?php

include "auto_grader.php";

function send_to_backend($input_data){
    /** Sends input data from front-end to backend **/

    $url = "https://web.njit.edu/~jsf25/index.php";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($input_data));
    $response = curl_exec($ch);
    curl_close($ch);

    return $response;

}

function router($input_data) {
    file_put_contents("data_from_front_MIDDLE.json", json_encode($input_data));

    switch ($input_data["request_id"]) {
        # ***************** TEACHER *****************
        case "LOGIN":
            echo send_to_backend($input_data);
            break;
        case "ADD_QUESTION":
            echo send_to_backend($input_data);
            break;
        case "FILTER":
            echo send_to_backend($input_data);
            break;
        case "GET_ALL":
            echo send_to_backend($input_data);
            break;
        case "CREATE_EXAM":
            echo send_to_backend($input_data);
            break;
        case "GET_ACTIVE_EXAM":
            echo send_to_backend($input_data);
            break;
        case "END_EXAM":
            echo send_to_backend($input_data);
            break;
        case "GET_TEMP_GRADES":
            echo send_to_backend($input_data);
            break;
        case "POST_FINAL_GRADES":
            echo send_to_backend($input_data);
            break;
        case "GET_FINAL_GRADES":
            echo send_to_backend($input_data);
            break;
        # ***************** STUDENT *****************
        case "IS_AVAILABLE":
            echo send_to_backend($input_data);
            break;
        case "SUBMIT_EXAM":
            $raw_test_cases = send_to_backend(array("request_id" => "GET_TEST_CASES"));
            $decoded_test_cases = json_decode($raw_test_cases, true);
            $submit_data = auto_grader($input_data, $decoded_test_cases);
            echo send_to_backend($submit_data);
            break;
        default:
            echo("MIDDLE RESPONSE - Invalid request block");
    }
}