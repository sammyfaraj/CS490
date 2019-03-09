<?php

include "login.php";
include "getall.php";
include "addquestion.php";
include "filter.php";
include "get_active_exam.php";
include "create_exam.php";
//include "add_to_exam.php";
include "is_available.php";
include "answers.php";

# Retrieve raw HTTP request data
$decoded_data = get_http_request();

if (is_null($decoded_data)){
    echo "Data is Null";
    $data = array(
        "request_id" => "GET_ACTIVE_EXAM"
    );
    route($data);
}
else
    route($decoded_data);

function route($data)
{

    switch ($data["request_id"]) {
        case "LOGIN":
            $response = verify_credentials($data["username"], $data["password"]);
            echo json_encode(array("role" => $response));
            break;
        case "GET_ALL":
            $all_questions = get_all_questions();
            echo json_encode($all_questions);
            break;
        case "ADD_QUESTION":
            $response = add_question($data);
            echo json_encode(array("response" => $response));
            break;
        case "FILTER":
            $response = filter($data);
            echo json_encode($response);
            break;
        case "CREATE_EXAM":
            create_exam($data);
            break;
        case "IS_AVAILABLE":
            $response = is_available();
            echo json_encode(array("status" => $response));
            break;
        case "GET_ACTIVE_EXAM":
            if (is_available()) {
                $response = get_active_exam();
                echo json_encode($response);
            } else
                echo json_encode("Exam not Available");
            break;
        case "GET_TEST_CASES":
            include "is_available.php"; //getting table name
            include "get_cases.php";
            break;
        case "POST_TEMP_GRADES":
            $exam_name = get_active_exam_name();
            answers($data, $exam_name."results");
            break;
        case "END_EXAM":
            include "end_exam.php";
            $response = end_exam();
            echo json_encode(array("response" => $response));
            break;
        default:
            echo("BACKEND - Invalid request block");
    }
}

function get_http_request()
    /** Decodes HTTP request from Front-end **/
{
    $raw_data = file_get_contents("php://input");
    $decoded_json = json_decode($raw_data, true);
    return $decoded_json;
}


