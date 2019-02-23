<?php
/**
 *  Author:  Braulio Tonaco
 *  Date:    2019-02-19
 *  Class    CS490
 */

include "test_cases.php";
require_once("helper_functions.php");

# Retrieves http request from front-end
$data = json_decode(file_get_contents("php://input"), true);

# Check if request is coming from Front-end and data was successfully retrieved
if (is_null($data))
    run_test_cases();
else
    router($data);

function router($input_data)
{
    switch ($input_data["request_id"]) {
        case "LOGIN":
        case "ADD_QUESTION":
        case "FILTER":
        case "CREATE_EXAM":
            $response = send_to_backend($input_data);
            echo json_encode($response);
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
}

function run_test_cases()
{
    echo("<h1>Running Test Cases</h1>");
    echo("<h3 style='color: #ce0806'>sending data to backend URL: https://web.njit.edu/~jsf25/</h3>");

    foreach ($GLOBALS['test_cases'] as $k => $v) {
        if ($k == "LOGIN") {
            foreach ($v as $value) {
                echo("<br><br>FRONT-END input for request_id: <b style='color: #ff6e39'>$k</b><br>");
                var_dump($value);
                echo("<br><br>BACKEND response:<br>");
                router($value);
                echo "<hr>";
            }
        } else {
            echo("<br><br>FRONT-END input for request_id: <b style='color: #ff6e39'>$k</b><br>");
            var_dump($v);

            echo("<br><br>BACKEND response:<br>");
            router($v);
            echo "<hr>";
        }
    }
}