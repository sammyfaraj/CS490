<?php

include "test_cases.php";

function router($input_data)
{
//    echo("<br>request_id: ".$input_data["request_id"]."<br>");

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
//        case "REVIEW_GRADES":
//            echo send_to_backend($input_data);
//            break;
//        case "POST_FINAL_GRADES":
//            echo send_to_backend($input_data);
//            break;
//
//        # ***************** STUDENT *****************
        case "IS_AVAILABLE":
            echo send_to_backend($input_data);
            break;
//        case "START_EXAM":
//            echo send_to_backend($input_data);
//            break;
        case "SUBMIT_EXAM":
            var_dump($input_data);
            $submit_data = auto_grader($input_data);
            echo send_to_backend($submit_data);
            break;
//        case "SEE_SCORE":
//            echo send_to_backend($input_data);
//            break;
        default:
            echo("MIDDLE RESPONSE - Invalid request block");
    }
}

function send_to_backend($input_data)
    /** Sends input data from front-end to backend **/
{
//    $url = "https://web.njit.edu/~jsf25/index.php";
    $url = "https://web.njit.edu/~bt74/betta/backend/index.php";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($input_data));
    $response = curl_exec($ch);
    curl_close($ch);

    return $response;

}

function run_test_cases()
    /** Run $test_cases variable - this function servers as a testing case for middleware **/
{

    echo("<h1>Running Test Cases</h1>");
    echo("<h3 style='color: #ce0806'>sending data to backend URL: https://web.njit.edu/~jsf25/</h3>");

    echo "<p style='color: #0332ff'>COMPLETED:</p>";
    echo "=> LOGIN:<br>";
    echo "=> ADD_QUESTION:<br>";
    echo "=> FILTER:<br>";
    echo "=> GET_ALL<br>";
    echo "=> CREATE_EXAM:<br>";
    echo "=> IS_AVAILABLE:<br>";
    echo "=> END_EXAM:<br>";
    echo "=> START_EXAM:<br>";

    echo "<p style='color: #ff0012'>IN PROGRESS:</p>";
    echo "<b>TEACHER SIDE</b><br>";
    echo "=> REVIEW_GRADES:<br>";
    echo "=> POST_FINAL_GRADES:<br>";

    echo "<br><b>STUDENT SIDE</b><br>";
    echo "=> SEE_SCORE:<br>";
    echo "=> SUBMIT_EXAM:<br>";

    echo "<br><b>AUTO_GRADER SIDE</b><br>";
    echo "=> GET_PENDING_EXAMS:<br>";
    echo "=> POST_TEMP_GRADES:<br>";


    foreach ($GLOBALS['test_cases'] as $k => $v) {
        if ($k == "LOGIN" || $k == "ADD_QUESTION" || $k == "FILTER") {
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

            echo("<br><br>EXPECTED response:<br>");
            var_dump($v['expected_response']);

            echo("<br><br>BACKEND response:<br>");
            router($v);
            echo "<hr>";
        }
    }
}

function get_http_request()
    /** Decodes HTTP request from Front-end **/
{
    $raw_data = file_get_contents("php://input");
    $decoded_json = json_decode($raw_data, true);
    return $decoded_json;
}

function correct_($function_name, $str)
    /** Simply checks whether student answer has correct function name **/
{
    $response = false;

    if (strpos($str, " " . $function_name . "(") !== false)
        $response = true;
    elseif (strpos($str, " " . $function_name . " ") !== false)
        $response = true;

    return $response;
}

function assert_func_name($ans, $correct_function_name)
    /** Replaces misspelled function name with correct one **/
{
    $def_pos = strpos($ans, "def ");
    $paren_pos = 0;

    $i = $def_pos + 3;
    while ($i < strlen($ans)) {  # Finds the first opening parenthesis index location after 'def'
        if ($ans[$i] == "(") {
            $paren_pos = $i;
            break;
        }
        $i++;
    }

    $start = substr($ans, 0, $def_pos + 3);
    $end = substr($ans, $paren_pos, -1);

    return $start . " " . $correct_function_name . $end;
}

function run_answer($ans, $fn, $input)

{
    # Saving into file
    $append = "\n\nimport sys\narg1 = sys.argv[1]\nprint($fn(arg1))";
    $ans = $ans . $append;
    $file_name = "answer.py";
    file_put_contents($file_name, $ans);

    # Executing file
    $command = "chmod 777 answer.py && python answer.py \"$input\"";
    exec($command, $out, $ret);

    return end($out);
}

function auto_grader($in_data)
{
    $get_test_cases = array("request_id" => "GET_TEST_CASES");
    $test_cases = json_decode(send_to_backend($get_test_cases), true);

    echo "<br>TEST CASES FROM BACKEND<br>";
    var_dump($test_cases);
    echo "<br>";

    $scores = "";
    $comments = "";
    $answers = explode("|~|", $in_data['answers']);

    $i = 0;
    foreach ($answers as $answer) {

        if ($answer == null) {
            $scores = $scores . "0,";
            $comments = $comments . "no answer,";
            $i++;
            continue;
        }

        $func_name = $test_cases[$i][0];
        $score = intval($test_cases[$i][1]);
        $comment = "success";

        #  STEP 1: Is the function name correct?
        if (!correct_($func_name, $answer)) {
            echo "Correcting function name - Deducting 2 pts<br>";
            $answer = assert_func_name($answer, $func_name);
            $score -= 2;
            $comment = "incorrect function name";
        }

        # STEP 2: Run test cases
        $r1 = run_answer($answer, $func_name, $test_cases[$i][2]);
        $r2 = run_answer($answer, $func_name, $test_cases[$i][4]);

        # STEP 3: Check results
        $expected1 = $test_cases[$i][3];
        $expected2 = $test_cases[$i][5];

        if (strcasecmp($r1, $expected1) != 0 or strcasecmp($r2, $expected2) != 0) {
            $score = 0;
            $comment = "fail";
        }

        $scores = $scores . "," . $score;
        $comments = $comments . "," . $comment;
        $i++;
    }

    $in_data["request_id"] = "POST_TEMP_GRADES";
    $in_data["scores"] = $scores;
    $in_data["comments"] = $comments;

    return $in_data;
}