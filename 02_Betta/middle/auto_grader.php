<?php
/**
 * Author:  Braulio Tonaco
 * Date:    2019-03-04
 */

function auto_grader($in_data)
{
    $test_cases = json_decode(send_to_backend(array("request_id" => "GET_TEST_CASES")), true);
    $answers = explode("|~|", $in_data['answers']);
    array_pop($answers);

    $scores = "";
    $comments = "";
    $question = 0;

    foreach ($answers as $answer) {
        $comment = "success";

        if ($answer == null or !strlen($answer)) {
            $scores = "0," . $scores;
            $comments = $comments . "no answer,";
            $question++;
            continue;
        }

        # Question Details
        $score = intval($test_cases[$question][0]);
        $param_type = $test_cases[$question][6];
        $func_name = $test_cases[$question][1];

        # Test Cases
        $in_1 = $test_cases[$question][2];
        $out_1 = $test_cases[$question][3];
        $in_2 = $test_cases[$question][4];
        $out_2 = $test_cases[$question][5];

        #  STEP 1: Is the function name correct?
        if (!correct_($func_name, $answer)) {
            $answer = assert_func_name($answer, $func_name);
            $score -= 10;
            $comment = "incorrect function name";
        }

        # STEP 2: Run test cases
        $r1 = run_answer($answer, $func_name, $in_1, $param_type, $question);
        $r2 = run_answer($answer, $func_name, $in_2, $param_type, $question);

        # STEP 3: Check results
        if (strcasecmp($r1, $out_1) != 0 or strcasecmp($r2, $out_2) != 0) {
            $score = 0;
            $comment = $comment == "success" ? "fail" : $comment . "-fail";
        }

        $scores = $scores . "," . $score;
        $comments = $comments . "," . $comment;
        $question++;
    }

    $scores = substr($scores, 1);
    $comments = substr($comments, 1);

    $in_data["answers"] = $answers;
    $in_data["request_id"] = "POST_TEMP_GRADES";
    $in_data["scores"] = $scores;
    $in_data["comments"] = $comments;


    return $in_data;
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
    $end = substr($ans, $paren_pos);

    return $start . " " . $correct_function_name . $end;
}

function run_answer($ans, $fn, $input, $p_type, $q_num)

{
    $in = $p_type == "int" ? $in = "int(sys.argv[1])" : "sys.argv[1]";
    $append = "\n\nimport sys\narg1 = $in\nprint($fn(arg1))\n";
    $ans = $ans . $append;
    $file_name = "answer_$q_num.py";

    $command = "echo '$ans' >| $file_name && chmod 777 $file_name && python $file_name \"$input\"";

    exec($command, $out, $ret);

    return end($out);
}

function send_to_backend($input_data)
    /** Sends input data from front-end to backend **/
{
    $url = "https://web.njit.edu/~jsf25/index.php";
//    $url = "https://web.njit.edu/~bt74/betta/backend/index.php";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($input_data));
    $response = curl_exec($ch);
    curl_close($ch);

    return $response;

}