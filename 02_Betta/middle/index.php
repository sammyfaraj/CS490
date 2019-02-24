<?php
/**
 *  Author:  Braulio Tonaco
 *  Date:    2019-02-19
 *  Class    CS490
 */

include "test_cases.php";
require_once("helper_functions.php");

# Retrieves http request from front-end
$raw_data = file_get_contents("php://input");

# Decode raw data
$data = json_decode($raw_data, true);

# Check if request is coming from Front-end and data was successfully retrieved
if (is_null($data))
    run_test_cases();
else {

    $back_response = router($data);

    $encoded = json_encode($data);
    echo "FRONT-END INPUT => *** $encoded ***";
    $encoded = json_encode($back_response);
    echo "BACKEND OUTPUT => *** $encoded ***";

}


function router($input_data)
{

    $ret_to_frontend = null;
    switch ($input_data["request_id"]) {
        case "LOGIN":
            #$ret_to_frontend = array( "role" => 2 );
            #break;
        case "ADD_QUESTION":
            #$ret_to_frontend = array("response" => "questions added [ question id ] successfully");
            #break;
        case "FILTER":
            #$test_data = $GLOBALS['test_cases'];
            #$ret_to_frontend = $test_data['ADD_QUESTION'];
            #break;
        case "GET_ALL":
            # TODO:Return all questions from DB (yet to code in backend)
            #$test_data = $GLOBALS['test_cases'];
            #$ret_to_frontend = $test_data['ADD_QUESTION'];
            #break;
        case "CREATE_EXAM":
            #$ret_to_frontend = array("response" => "exam [ exam id ] created successfully");
            $ret_to_frontend = send_to_backend($input_data);
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

    #$ret_to_frontend['front-end_input'] = $input_data;
    return $ret_to_frontend;
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
                $back_response = router($value);
                $encoded = json_encode($back_response);
                echo "==>>> $encoded <<<==";
                echo "<hr>";
            }
        } else {
            echo("<br><br>FRONT-END input for request_id: <b style='color: #ff6e39'>$k</b><br>");
            var_dump($v);

            echo("<br><br>BACKEND response:<br>");
            $back_response = router($v);
            $encoded = json_encode($back_response);
            echo "==>>> $encoded <<<==";
            echo "<hr>";
        }
    }
}