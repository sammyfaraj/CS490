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
            "password" => "password"
        ),
        array(
            "request_id" => "LOGIN",
            "username" => "student1",
            "password" => "password"
        ),
        array(
            "request_id" => "LOGIN",
            "username" => "teacher1",
            "password" => "BAD_PASSWORD"
        )
    ),
    "ADD_QUESTION" => array(
        "request_id" => "ADD_QUESTION",
        "question" => array(
            "intro" => "Write a function named vowelCount that counts and returns the number of vowels in a string parameter. The letters 'a', 'e', 'i', 'o' and 'u' are the vowels.",
            "id" => 1,
            "topic" => "string",
            "diff" => "easy",
            "func_names" => array(
                "id" => 1,
                "name" => "vowelCount"
            ),
            "param_intro" => "The function vowelCount takes one parameter:",

            "params" => array(
                "var_name" => "text",
                "type" => "string",
                "description" => "null"
            ),
            "close" => "null",
            "hint" => "both upper and lower case instances of vowels should be counted.",
            "example_intro" => "For example, the following would be correct output:",

            "example" => array(
                "line1" => ">>> beatleLine = 'I am the walrus'",
                "line2" => ">>> print(vowelCount(beatleLine))",
                "line3" => ">>> 5"
            ),

            "test cases" => array(
                "func_id" => 1,
                "unit_test" => array(
                    array("I am the walrus", 5),
                    array("aeiou", 5),
                    array("I love you", 5)
                )
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
    )
);