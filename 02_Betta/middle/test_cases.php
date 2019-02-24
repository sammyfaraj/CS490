<?php
/**
 *  Author:  Braulio Tonaco
 *  Date:    2019-02-19
 *  Class    CS490
 */

$test_cases = array(
    "LOGIN" => array(
        array(
            "request_id" => "LOGIN",
            "username" => "teacher1",
            "password" => "password",
            "description" => "Testing for TEACHER password"
        ),
        array(
            "request_id" => "LOGIN",
            "username" => "student1",
            "password" => "password",
            "description" => "Testing for STUDENT password"
        ),
        array(
            "request_id" => "LOGIN",
            "username" => "teacher1",
            "password" => "BAD_PASSWORD",
            "description" => "Testing for INCORRECT password"
        )
    ),
    "ADD_QUESTION" => array(
        "request_id" => "ADD_QUESTION",
        "question" => array(
            "intro" => "Write a function named vowelCount that counts and returns the number of vowels in a string parameter. The letters 'a', 'e', 'i', 'o' and 'u' are the vowels. both upper and lower case instances of vowels should be counted. The function vowelCount takes one parameter:",
            "topic" => "string",
            "diff" => "easy",
            "score" => 15,
            "func_name" => "vowelCount",

            "params" => array(
                array(
                    "var_name" => "text",
                    "type" => "string",
                    "description" => "null"
                )
            ),

            "test cases" => array(
                array("I am the walrus", 5),
                array("aeiou", 5),
                array("I love you", 5)
            )
        )
    ),
    "FILTER" => array(
        "request_id" => "FILTER",
        "topic" => array("string", "list", "dict", "all"),
        "diff" => array("hard", "intermediate", "easy", "all"),
        "keyword" => array("keyword may vary")
    ),
    "CREATE_EXAM" => array(
        "request_id" => "CREATE_EXAM",
        "questions" => array(
            array("q1_ID", "score1"),
            array("q2_ID", "score2"),
            array("q3_ID", "score3"),
            array("q4_ID", "score4"),
            array("q4_ID", "score5")
        ),
        "semester" => "fall",
        "year" => "2019",
        "class" => "CS490"
    ),
    "GET_ALL" => array(
        "request_id" => "GET_ALL"
    )
);