<?php

include "test_cases.php";
include "auto_grader.php";

function router($input_data)
{
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
            $submit_data = auto_grader($input_data);
            echo send_to_backend($submit_data);
            break;
        default:
            echo("MIDDLE RESPONSE - Invalid request block");
    }
}