<?php

include "test_cases.php";

function router($input_data)
{
    $ret_to_frontend = null; $expect = null;
    $req_id = $input_data["request_id"];
    $test = $GLOBALS['test_cases'][$input_data["request_id"]];

    if( $req_id == "LOGIN" || $req_id == "ADD_QUESTION" || $req_id == "FILTER" )
        $expect = $test[0]['expected_response'];
    else
        $expect = $test['expected_response'];

    switch ( $req_id ) {
        case "LOGIN":
        case "ADD_QUESTION":
        case "FILTER":
        case "GET_ALL":
        case "CREATE_EXAM":
        case "RELEASE_EXAM":
            $encoded = send_to_backend($input_data);
            $decoded = json_decode($encoded, true);

            $decoded['expected_response'] = $expect;

            return json_encode($decoded);
            break;
        case "END_EXAM":
            // TODO: Update exams IN_PROGRESS as CLOSED
            // TODO: Calculate Grades + update scores in db + mark exam as "TO REVIEW GRADES"
            // TODO: Return response OK/Error
            echo("End Exam block");
            break;
        case "REVIEW_GRADES":
            // TODO: Request from backend list of "TO REVIEW GRADES" exams  + Student Name associated w/ it
            // TODO: Send response to Front-End
            echo("Review grades block");
            break;
        case "SUBMIT_GRADES":
            // TODO: Send to Backend reviewed exams
            // TODO: Return response OK/Error
            echo("Submit grades block");
            break;
        case "GET_EXAM":
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

function send_to_backend($input_data)
    /** Sends input data from front-end to backend **/
{
    $url = "https://web.njit.edu/~jsf25/index.php";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($input_data));
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;

}

function run_test_cases()
{
    echo("<h1>Running Test Cases</h1>");
    echo("<h3 style='color: #ce0806'>sending data to backend URL: https://web.njit.edu/~jsf25/</h3>");

    foreach ($GLOBALS['test_cases'] as $k => $v) {
        if ( $k == "LOGIN" || $k == "ADD_QUESTION" || $k == "FILTER") {
            foreach ($v as $value) {
                echo("<br><br>FRONT-END input for request_id: <b style='color: #ff6e39'>$k</b><br>");
                var_dump($value);

                echo("<br><br>EXPECTED response:<br>");
                var_dump($value['expected_response']);

                echo("<br><br>BACKEND response:<br>");
                echo router($value);
                echo "<hr>";
            }
        } else {
            echo("<br><br>FRONT-END input for request_id: <b style='color: #ff6e39'>$k</b><br>");
            var_dump($v);

            echo("<br><br>EXPECTED response:<br>");
            var_dump($v['expected_response']);

            echo("<br><br>BACKEND response:<br>");
            echo router($v);
            echo "<hr>";
        }
    }
}

function get_http_request(){
    # Retrieves http request from front-end
    $raw_data = file_get_contents("php://input");

    # Decode raw data
    $decoded_json = json_decode($raw_data, true);

    # Return decoded
    return $decoded_json;
}