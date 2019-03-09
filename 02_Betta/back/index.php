<?php

include "login.php";
include "getall.php";
include "addquestion.php";
include "filter.php";
include "get_active_exam.php";
include "create_exam.php";
include "is_available.php";
include "answers.php";
include "get_cases.php";
include "get_temp_grades.php";
include "end_exam.php";

# Retrieve raw HTTP request data
$decoded_data = get_http_request();

if (is_null($decoded_data)){
    echo "Data is Null";
    $data = array(
        "request_id" => "GET_ACTIVE_EXAM"
    );
    route($data);
}
else{
    route($decoded_data);
}

function route($data)
{
    switch ($data["request_id"]) {
        //Login functionality
        //Arguemnts: Username and password
        //Return: 0/1/2
        case "LOGIN":
            $response = verify_credentials($data["username"], $data["password"]);
            echo json_encode(array("role" => $response));
            break;
       
        //Get All Questions
        //Arguments: None
        //Return: JSON of all questions
        case "GET_ALL":
            $all_questions = get_all_questions();
            echo json_encode($all_questions);
            break;
        
        //Add Question to Database
        //Arguemnts: Questions data
        //Return: None
        case "ADD_QUESTION":
            $response = add_question($data);
            echo json_encode(array("response" => $response));
            break;
        
        //Apply Filter to Questions
        //Arguments: Filters
        //Return: JSON of remaining questions
        case "FILTER":
            $response = filter($data);
            echo json_encode($response);
            break;
        
        //Create Exam
        //Arguments: Exam id and points
        //Return: None    
        case "CREATE_EXAM":
            create_exam($data);
            break;
        
        //Check if an Exam Exist
        //Arguments: None
        //Return: 1/0
        case "IS_AVAILABLE":
            $response = is_available();
            echo json_encode(array("status" => $response));
            break;
        
        //Get the Currently Active Exam
        //Arguments: None
        //Return: Active Exam Questions
        case "GET_ACTIVE_EXAM":
            if (is_available()) {
                $response = get_active_exam();
                echo json_encode($response);
            } else
                echo json_encode("Exam not Available");
            break;
        
        //Teacher Changes Active Exam to Inactive
        //Arguments: None
        //Return: None
        case "END_EXAM":
            $response = end_exam();
            echo json_encode(array("response" => $response));
            break;
        
        //Get Active Exam's Question Info
        //Arguemnts: None
        //Return: Func_name, Inone, Outone, Intwo, Outtwo
        //IN PROGRESS
        case "GET_TEST_CASES":
            $name = get_active_exam_name();
            $test_cases = get_test_cases($name);
            echo json_encode($test_cases);
            break;
        
        //Middle Passes Grading Info to Back
        //Arguments: Username, Scores, Anwers, Comments 
        //Return: None
        //IN PROGRESS
        case "POST_TEMP_GRADES":
            $exam_name = get_active_exam_name();
            post_temp_grades($data, $exam_name."results");
            break;
        
        //Get All Pending Grades
        //Arguments: None
        //Return: Username, Questions, Answers, Scores, Comments
        //IN PROGRESS
        case "GET_TEMP_GRADES":
            $exam_name = get_active_exam_name();
            $message = get_temp_grades($exam_name."results");
            echo json_encode($message);
            break;
        
        //Teacher Stores new comments and Grades
        //Arguments: Score, Comments
        //Return: None
        //IN PROGRESS
        case "POST_FINAL_GRADES":
            $exam_name = get_active_exam_name();
            post_final_grades($data, $exam_name."results");
            
        //Student Views Final Grades
        //Arguemnts: Student Id
        //Return: Question, Grades, Comments, Answers
        //IN PROGRESSS
        case "GET_FINAL_GRADES":
            $exam_name = get_active_exam_name();
            get_final_grades($data, $exam_name."results");
            
        //DEFAULT
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


