<?php
/**
 * Author:  Braulio Tonaco
 * Date:    2019-03-04
 */

function correct_($function_name, $str) {
    /** Simply checks whether student answer has correct function name **/

    $response = false;

    if (strpos($str, " " . $function_name . "(") !== false)
        $response = true;
    elseif (strpos($str, " " . $function_name . " ") !== false)
        $response = true;

    return $response;
}

function assert_func_name($ans, $correct_function_name) {
    /** Replaces misspelled function name with correct one **/
    
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

function arrayfy($raw_data){
    # Array to be returned
    $inputs = array();
    
    # Remove outter brackets
    preg_match("/^\[(.*)\]$/", $raw_data, $regexed);

    # Are there more arrays?
    if ( preg_match("/\[.*\]/", $regexed[1], $out) ){
        $string = $out[0];

        $i = 0;
        $array_position = 0;
        while( $i < strlen($string) ){
            $start = strpos($string, '[', $i);
            $end = strpos($string, ']', $start);
            $delta = $end - $start - 1;

            array_push(
                $inputs, explode(',', substr($string, $start +1, $delta) ) 
            );

            $i = $end + 1;
        }
    }
    else
        $inputs = explode(',', $regexed[1]);

    return $inputs;
}

function run_answer($ans, $fn, $input, $print_type, $q_num) {
    $input_str= "";
    foreach($input as $variable){
        $temp = preg_match("/^[0-9]+$/", $variable) ? "int($variable), " : "\"$variable\", ";
        $input_str = $input_str . $temp;
    }

    $cleaned = substr($input_str, 0, -2);
    $function_call = $print_type ? "\n\n$fn( $cleaned )" : "\n\nprint( $fn( $cleaned ) )";
    $ans = $ans . $function_call;
    $file_name = "answer_$q_num.py";
    
    $command = "echo '$ans' > $file_name && chmod 777 $file_name && python3 $file_name";

    exec($command, $out, $ret);
    
    return end($out);
    }