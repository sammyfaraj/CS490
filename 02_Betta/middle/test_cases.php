<?php
/**
 *  Author:  Braulio Tonaco
 *  Date:    2019-02-19
 *  Class    CS490
 */

$test_cases = array(
    "CREATE_EXAM" => array(
        "request_id" => "CREATE_EXAM",
        "exam_name" => "Spring2019",
        "description" => "Creates exam in DB and set its status to 'active'",
        "questions" => array(
            array("1", "20"),
            array("2", "15"),
            array("3", "10")
        ),

        "expected_response" => array("response" => "Exam [ id ] Created Successfully")
    ),

    "IS_AVAILABLE" => array(
        "request_id" => "IS_AVAILABLE",
        "description" => "Check if there is any 'active' exam on DB, response will be either 0 or 1",
        "expected_response" => array(
            "active" => "1 or 0, where 1 means active, and 0 means inactive",
        )
    ),

    "START_EXAM" => array(
        "request_id" => "START_EXAM",
        "description" => "Student has an available exam and want to start taking test",
        "expected_response" => "All questions related to assigned to specific exam"
    ),

    "SEE_SCORE" => array(
        "request_id" => "SEE_SCORE",
        "description" => "Student is requesting to see score for an exam taken, IF EXAM STATUS is NOT 'GRADED' return 
                         'grade not yet available' otherwise return grades",
        "expected_response" => array(
            array("q1", "score"),
            array("q2", "score"),
            array("q3", "score")
        ),
    ),

    "REVIEW_GRADES" => array(
        "request_id" => "REVIEW_GRADES",
        "description" => "Requests from database all student exams WHERE status is 'AUTO_GRADED'",
        "expected_response" => array(
            "Student1_exam1",
            "Student2_exam1",
            "Student3_exam1"
        ),
    ),

    "END_EXAM" => array(
        "request_id" => "END_EXAM",
        "exam_name" => "Spring2019",
        "description" => "Ends exam session, DB will set exam status to 'inactive' - GradingTool gets activated",

        "expected_response" => array(
            "response" => "Exam [ id ] session has ended and grades are ready for review"
        )
    ),

    "SUBMIT_EXAM" => array(
        "request_id" => "SUBMIT_EXAM",
        "description" => "this is for when a student clicks on submit test",
        "username" => "student1",
        "exam_name" => "Spring2019",
        "exam_status" => "THIS IS FOR DATABASE ONLY, this exam is unique to student profile, so set its status to 'PENDING'",
        "questions" => array(
            " def vowelCount(test):
                        test.lower()
                        counter = 0

                        for chr in test:
                            if chr in \"AEIOUaeiou\":
                                counter += 1
        
                        return counter",
            "some answer for question 2",
            "some answer for question 3",
            "some answer for question 4"
        )
    ),
    "GET_PENDING_EXAMS" => array(
        "request_id" => "GET_PENDING_EXAMS",
        "description" => "This will request from DB all students exams that need to be graded by GradingTool",
        "expected_response" => array(
            "Description" => "TO BE DECIDED BY BACKEND"
        )
    ),
    "POST_TEMP_GRADES" => array(
        "request_id" => "POST_TEMP_GRADES",
        "description" => "When GradingTool finishes grading exams - post result onto DB
                          SETS exam status to 'AUTO_GRADED'",
        "username" => "student1",
        "exam_name" => "Spring2019",
        "score" => array(
            array("q1", "score"),
            array("q2", "score"),
            array("q3", "score"),
            array("q4", "score"),
        ),
        "expected_response" => "Exam [ id ] session has ended and grades are ready for review"
    ),
    "POST_FINAL_GRADES" => array(
        "request_id" => "POST_FINAL_GRADES",
        "description" => "When teacher finishes grading exams - post result onto DB
                          SETS exam status to 'GRADED'",
        "username" => "student1",
        "exam_name" => "Spring2019",
        "score" => array(
            array("q1", "score"),
            array("q2", "score"),
            array("q3", "score"),
            array("q4", "score"),
        ),
        "expected_response" => "Exam [ id ] session has ended and grades are ready for review"
    )
);

$completed = array(
    "LOGIN" => array(
        array(
            "request_id" => "LOGIN",
            "username" => "teacher1",
            "password" => "password",
            "description" => "Testing for TEACHER password",

            "expected_response" => array("role" => "2")
        ),
        array(
            "request_id" => "LOGIN",
            "username" => "student1",
            "password" => "password",
            "description" => "Testing for STUDENT password",

            "expected_response" => array("role" => "1")
        ),
        array(
            "request_id" => "LOGIN",
            "username" => "teacher1",
            "password" => "BAD_PASSWORD",
            "description" => "Testing for INCORRECT password",

            "expected_response" => array("role" => "0")
        )
    ),
    "ADD_QUESTION" => array(
        array(
            "request_id" => "ADD_QUESTION",
            "intro" => "some intro vowelCount",
            "topic" => "string",
            "diff" => "easy",

            "func_name" => "vowelCount",

            "paramname" => "text",
            "paramtype" => "string",

            "inone" => "I am the welrus",
            "outone" => "5",
            "intwo" => "aeiou",
            "outtwo" => "5",

            "expected_response" => array("response" => "Question [ id ] Added Successfully")
        ),
        array(
            "request_id" => "ADD_QUESTION",
            "intro" => "some intro",
            "topic" => "dictionary",
            "diff" => "medium",

            "func_name" => "vowelEndings",

            "paramname" => "text",
            "paramtype" => "string",

            "inone" => "input_one",
            "outone" => "output_one",
            "intwo" => "iinput_two",
            "outtwo" => "output_two",

            "expected_response" => array("response" => "Question [ id ] Added Successfully")
        )
    ),
    "FILTER" => array(
        array(
            "request_id" => "FILTER",
            "topic" => "string",
            "diff" => "easy",
            "key" => "vowelCount",

            "expected_response" => array(
                array(
                    "id" => "1",
                    "intro" => "Write a function named vowelCount that counts and returns the number of vowels in a string parameter. The letters 'a', 'e', 'i', 'o' and 'u' are the vowels. both upper and lower case instances of vowels should be counted. The function vowelCount takes one parameter:",
                    "topic" => "string",
                    "diff" => "easy",
                ),
                array(
                    "id" => "2",
                    "intro" => "",
                    "topic" => "",
                    "diff" => "",
                )
            )

        ),
        array(
            "request_id" => "FILTER",
            "topic" => "dictionary",
            "diff" => "medium",
            "key" => "",

            "expected_response" => array(
                array(
                    "id" => "2",
                    "intro" => "Write a function named vowelCount that counts and returns the number of vowels in a string parameter. The letters 'a', 'e', 'i', 'o' and 'u' are the vowels. both upper and lower case instances of vowels should be counted. The function vowelCount takes one parameter:",
                    "topic" => "string",
                    "diff" => "easy",
                ),
                array(
                    "id" => "3",
                    "intro" => "Some other question intro",
                    "topic" => "dictionary",
                    "diff" => "medium",
                )
            )

        )
    ),
    "GET_ALL" => array(
        "request_id" => "GET_ALL",
        "description" => "This case would requests for all questions in DB",

        "expected_response" => array(
            array(
                "question 1 row",
                "question 2 row",
                "question 3 row",
                "question 4 row",
            ),
        ),
    ),
);
