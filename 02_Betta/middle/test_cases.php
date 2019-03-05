<?php
/**
 *  Author:  Braulio Tonaco
 *  Date:    2019-02-19
 *  Class    CS490
 */

$test_cases = array(
    "CREATE_EXAM" => array(
        "request_id" => "CREATE_EXAM",
        "exam_name" => "Fall2019",
        "description" => "Creates exam in DB and set its status to '1'",
        "questions" => array('28', '29', '30'),
        "scores" => array('20', '40', '40'),
        "expected_response" => array("response" => "Exam [ exam_name ] Created Successfully")
    ),
    "IS_AVAILABLE" => array(
        "request_id" => "IS_AVAILABLE",
        "description" => "Checks if there is a exam where exam_status is 1",
        "expected_response" => array(
            "active" => "1 or 0, where 1 means active, and 0 means inactive",
        )
    ),
    "GET_ACTIVE_EXAM" => array(
        "request_id" => "START_EXAM",
        "description" => "Request from db exam WHERE exam_status is 1",
        "expected_response" => "All questions assigned to available exam"
    ),
    "SUBMIT_EXAM" => array(
        "request_id" => "SUBMIT_EXAM",
        "description" => "This cases insert into database exam answers",
        "username" => "student1",
        "exam_name" => "Spring2019",
        "grade_status" => "THIS IS FOR DATABASE ONLY, this exam is unique to student profile, so set its grade_status to '0'",
        "answers" => array(
            "def vowelCount(test):
                        test.lower()
                        counter = 0

                        for chr in test:
                            if chr in \"AEIOUaeiou\":
                                counter += 1
        
                        return counter",
            "some answer for question 2",
            "some answer for question 3",
            "some answer for question 4"
        ),
        "expected_response" => array(
            "response" => "Exam [exam_name] successfully submitted"
        )
    ),
    "END_EXAM" => array(
        "request_id" => "END_EXAM",
        "description" => "Ends exam session, DB will set exam ALL exam_status to '0' - GradingTool gets activated",
        "expected_response" => array(
            "response" => "Exam [ exam_name ] session has ended and grades are ready for review"
        )
    ),
    "GET_PENDING_EXAMS" => array(
        "request_id" => "GET_PENDING_EXAMS",
        "description" => "This will request from DB all students exams that WHERE grade_status is '0' - need to be graded by GradingTool",
        "expected_response" => array(
            "Description" => "TO BE DECIDED BY BACKEND"
        )
    ),
    "POST_TEMP_GRADES" => array(
        "request_id" => "POST_TEMP_GRADES",
        "description" => "When GradingTool finishes grading exams - post result onto DB
                          SETS grade_status to '1'",
        "username" => "student1",
        "exam_name" => "Spring2019",
        "score" => array(
            array("scr1", "scr2", "scr3"),
        ),
        "expected_response" => "Temporary Grades Successfully added to DB"
    ),
    "REVIEW_GRADES" => array(
        "request_id" => "REVIEW_GRADES",
        "description" => "Requests username, answer, grades, from database where WHERE grade_status is '1'",
        "expected_response" => array(
            "Student1_exam1",
            "Student2_exam1",
            "Student3_exam1"
        ),
    ),
    "POST_FINAL_GRADES" => array(
        "request_id" => "POST_FINAL_GRADES",
        "description" => "When teacher finishes grading exams - post result onto DB
                          SETS grade_status to '2'",
        "username" => "student1",
        "score" => array(20, 40, 10),
        "comments" => array('good', 'bad', 'good'),

        "expected_response" => "Exam [ exam_name ] for student [ student_name ] grades successfully reviewed and posted"
    ),
    "SEE_SCORE" => array(
        "request_id" => "SEE_SCORE",
        "description" => "username is requesting from db grades, comments where exam is grade_status is '2'",
        "username" => "student1",
        "expected_response" => array(
            "grade1", "grade2", "grade3"
        ),
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
