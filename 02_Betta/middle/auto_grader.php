<?php
/**
 * Author:  Braulio Tonaco
 * Date:    2019-03-04
 */

include "auto_grader_helpers.php";

function auto_grader($in_data, $test_cases) {
    $answers = explode("|~|", $in_data['answers']);
    array_pop($answers);

    $scores = "";
    $comments = "";  # TODO: Change me to array
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
        $func_name = $test_cases[$question][1];

        # Test Cases

        $inputs = $test_cases[$question][2] == "null" ? null : arrayfy($test_cases[$question][2]); 
        $outputs = arrayfy($test_cases[$question][3]); 

        # Enforcers
        $enforcer = array(
            'for' => json_decode($test_cases[$question][4], true),
            'while' => json_decode($test_cases[$question][5], true),
            'print' => json_decode($test_cases[$question][6], true)
        );

        #  STEP 1: Is the function name correct?
        if ( !correct_($func_name, $answer) ) {
            $answer = assert_func_name($answer, $func_name);
            $score -= 2;
            $comment = "BAD function name";
        }

        if ( $enforcer["for"] ) {
            $pattern = '/\s*for\s*.*:/';
            preg_match($pattern, $answer, $out);
            
            if( sizeof($out) == 0 ){
                $comment = $comment == "success" ? "missing FOR keyword" : $comment . ",missing FOR keyword";
                $score -= 2;
            }
        }
        if ( $enforcer["while"] ) {
            $pattern = '/\s*while\s*\(.*\).*:/';
            preg_match($pattern, $answer, $out);
            
            if( sizeof($out) == 0 ){
                $comment = $comment == "success" ? "missing WHILE keyword" : $comment . ",missing WHILE keyword";
                $score -= 2;
            }
        }
        if ( $enforcer["print"] ) {
            $pattern = '/\s*print\s*\(.*\)/';
            preg_match($pattern, $answer, $out);
            
            if( sizeof($out) == 0 ){
                $comment = $comment == "success" ? "missing PRINT keyword" : $comment . ",missing PRINT keyword";
                $score -= 2;
            }
        }

        # STEP 2: Run test cases
        $returned_values = array();
        $n_test_cases = 0;
        if ( $inputs != null ){
            foreach( $inputs as $test ){
                if ( is_array($test) ){
                    # Makes sure that eash test cases is comming in as array
                    array_push($returned_values, run_answer($answer, $func_name, $test, $enforcer["print"], $question)); 
                    $n_test_cases += 1;
                }
                else{
                    array_push($returned_values, run_answer($answer, $func_name, array($test), $enforcer["print"], $question));
                    $n_test_cases += 1;
                }
            }
        }

        # STEP 3: Check results
        $i = 0;
        $failed_cases = 0;
        while( $i < sizeof($outputs) ){
            $test_case = $i + 1;
            if ( $returned_values[$i] == $outputs[$i] ) {
                $comment = $comment . ",test case $test_case - PASSED";
            }
            else{
                $comment = $comment == "success" ? "test case $test_case FAILED" : $comment . ",test case $test_case - FAILED";
                $score -= 2;
                $failed_cases += 1;
            }
            $i++;
        } 

        # Failed all test cases ?
        if ( $n_test_cases == $failed_cases ){
            $score = 0;
        }

        $scores = $scores . "," . $score;
        $comments = $comments . "," . $comment;
        $question++;
    }
    
    $in_data["answers"] = $answers;
    $in_data["request_id"] = "POST_TEMP_GRADES";
    $in_data["scores"] = $scores;
    $in_data["comments"] = $comments;

    return $in_data;
}