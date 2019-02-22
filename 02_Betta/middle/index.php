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
        "request_id" => $_POST["request_id"],
        "username" => $_POST["username"],
        "password" => $_POST["password"]
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
    case "GET_ALL":
        $response = get_all_questions($data);
        if ($DEBUG)
            debug_print($data, $response, "T_CREATE_QUESTION");
        else
            echo(json_encode($response));
        break;
    case "T_ADD_QUESTION":
        // TODO: Send added question(s) to backend
        // TODO: Return OK/Error
        echo("Add questions block");
        break;
    case "T_CREATE_EXAM":
        // TODO: Send to backend newly created exam
        // TODO: Return response OK/Error
        echo("Create Exam block");
        break;
    case "T_RELEASE_EXAM":
        // TODO: Request from backend exam(s) + list of of students
        // TODO: Return response OK/Error
        echo("Release Exam block");
        break;
    case "T_END_EXAM":
        // TODO: Update exams IN_PROGRESS as CLOSED
        // TODO: Calculate Grades + update scores in db + mark exam as "TO REVIEW GRADES"
        // TODO: Return response OK/Error
        echo("End Exam block");
        break;
    case "T_REVIEW_GRADES":
        // TODO: Request from backend list of "TO REVIEW GRADES" exams  + Student Name associated w/ it
        // TODO: Send response to Front-End
        echo("Review grades block");
        break;
    case "T_SUBMIT_GRADES":
        // TODO: Send to Backend reviewed exams
        // TODO: Return response OK/Error
        echo("Submit grades block");
        break;
    case "S_MAIN":
        // TODO: Request from back if student has available test
        // TODO: Send response back to frontend
        echo("Student main block");
        break;
    case "S_TEST":
        // TODO: Request from backend exam assigned to student
        // TODO: Send response back to frontend
        echo("Exam request block");
        break;
    case "S_GRADES":
        // TODO: Request exam grade from backend, if test is stil in "TO REVIEW GRADES" status, return
        //  "Grading in progress" or coding (YET TO DECIDE)
        echo("Student Grade Request block");
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
            echo("<br>Authenticate block");
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

