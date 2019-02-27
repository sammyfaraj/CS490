<?php
/**
 *  Author:  Braulio Tonaco
 *  Date:    2019-02-19
 *  Class    CS490
 */

$test_cases = array(
    "FILTER" => array(
        "request_id" => "FILTER",
        "topic" => "string",
        "diff" => "easy",
        "key" => "vowelCount"
    ),
    "CREATE_EXAM" => array(
        "request_id" => "CREATE_EXAM",
        "description" => "Creates exam in DB and set its status to 'inactive'",
        "questions" => array(
            array("1", "20"),
            array("2", "15"),
        ),
        "semester" => "fall",
        "year" => "2019",
        "class" => "CS490"
    ),
    "GET_ALL" => array(
        "request_id" => "GET_ALL",
        "description" => "This case would requests for all questions in DB",
        "expected_output" => "All questions from DB"

    ),
    "RELEASE_EXAM" => array(
        "request_id" => "RELEASE_EXAM",
        "description" => "Assuming we have only one exam in DB, sets exam status to available",
        "expected_response" => array(
            "response" => "Exam [ id ] is now available"
        )
    ),
    "END_EXAM" => array(
        "request_id" => "END_EXAM",
        "description" => "Ends exam session, DB will set exam status to 'inactive' - GradingTool gets activated",
        "expected_response" => array(
            "response" => "Exam [ id ] session has ended and grades are ready for review"
        )
    ),
    "REVIEW_GRADES" => array(
        "request_id" => "REVIEW_GRADES",
        "description" => "Requests from database all completed exams",
        "expected_response" => array(
            "exams" => array(
                "Student1_exam1", "Student2_exam1", "Student3_exam1"
            )
        ),
        "student_exam_format" => array(
            "student_id" => "student_id",
            "exam" => "exam information you guys want to output",
            "question_1" => array("answer", "score"),
            "question_2" => array("answer", "score")
        )
    ),
    "EXAM_COMPLETED" => array(
        "request_id" => "EXAM_COMPLETED",
        "description" => "this is for when a student clicks on submit test",
        "username" => "SOME STUDENT USERNAME",
        "exam_id" => "some exam id",
        "exam_status" => "THIS IS FOR DATABASE ONLY, this exam is unique to student profile, so set its status to REVIEW GRADE",
        "question_id" => "1",
        "answer_1" => " def vowelCount(test):
                            test.lower()
                            counter = 0
    
                            for chr in test:
                                if chr in \"AEIOUaeiou\":
                                    counter += 1
            
                            return counter"
    ),
    "GET_PENDING_EXAMS" => array(
        "request_id" => "GET_PENDING_EXAMS",
        "description" => "This will request from DB all students exams that need to be graded by GradingTool",
        "expected_response" => array(
            "username" => "student",
            "exam_id" => "SOME EXAM ID",
            "question_id" => "SOME QUESTION ID",
            "answer_id" => "SOME ANSWER WHERE ID is the QUESTION ID number"
        )
    ),
    "POST_TEMP_GRADES" => array(
        "request_id" => "POST_TEMP_GRADES",
        "description" => "When GradingTool finishes grading exams - post result onto DB",
        "username" => "SOME STUDENT USERNAME",
        "exam_id" => "SOME EXAM ID",
        "question_id" => "SOME QUESTION ID",
        "score" => "SOME CALCULATED SCORE",
        "response" => "Exam [ id ] session has ended and grades are ready for review"
    )
);

$completed = array(
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
        "intro" => "Write a function named vowelCount that counts and returns the number of vowels in a string parameter. The letters 'a', 'e', 'i', 'o' and 'u' are the vowels. both upper and lower case instances of vowels should be counted. The function vowelCount takes one parameter:",
        "topic" => "string",
        "diff" => "easy",

        "func_name" => "vowelCount",

        "paramname" => "text",
        "paramtype" => "string",

        "inone" => "I am the welrus",
        "outone" => "5",
        "intwo" => "aeiou",
        "outtwo" => "5",
    ),
);
