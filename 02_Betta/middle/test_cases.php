<?php
/**
 *  Author:  Braulio Tonaco
 *  Date:    2019-02-19
 *  Class    CS490
 */

$test_cases = array(
    "SUBMIT_EXAM" => array(
        "description" => "BACKEND never sees this request_id",

        "request_id" => "SUBMIT_EXAM",
        "username" => "student1",
        "grading_status" => "0",
        "answers" => "ans1|~|ans2|~|ans3|~|ans4|~|...|~|ansN",
        "expected_response" => array("response" => "Exam [exam_name] successfully submitted")
    ),
    "GET_TEST_CASES" => array(
        "request_id" => "GET_TEST_CASES",
        "description" => "This requests the backend for the active exam question test cases, func_name, score",
        "expected_response" => array(
            array(
                "hello",                                    # func_name
                "10",                                       # question score
                "Braulio", "Hello Braulio, How are you?",   # inone, outone
                "Junior", "Hello Junior, How are you?",     # intwo, outtwo
                "5"                                         # question id
            ), #q1
            array(
                "get_vowels", "10", "CS490 is awesome!", "5", "CS490 sucks, but NJIT is awesome", 8, 7
            ) #q2
        )
    ),
    "POST_TEMP_GRADES" => array(
        "request_id" => "POST_TEMP_GRADES",
        "description" => "When GradingTool finishes grading exams - post result onto DB
                          SETS grade_status to '1'",
        "username" => "student1",
        "grading_status" => "0",
        "answers" => "ans1|~|ans2|~|ans3|~|ans4|~|...|~|ansN",
        "scores" => "scr1,scr2,scr3,...,scrN",
        "comments" => "success,incorrect function name,success,failed,failed",
        "expected_response" => "Temporary Grades Successfully added to DB"
    ),
    "REVIEW_GRADES" => array(
        "request_id" => "REVIEW_GRADES",
        "description" => "Requests username, answer, grades/scores, comments from database where WHERE grade_status is '1'",
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
            "grades" => "scr1,scr2,scr3,...,scrN",
            "comments" => "cmt1,cmt2,cmt3,...,cmtN"
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
    "END_EXAM" => array(
        "request_id" => "END_EXAM",
        "description" => "Ends exam session, DB will set exam ALL exam_status to '0'",
        "expected_response" => array(
            "response" => "Exam [ exam_name ] session has ended and grades are ready for review"
        )
    ),
);


$t = array(
"def maxInt(lst):
    m = lst[0]
    for num in lst:
        if (num > m): m = num
    return m",
"def hello(str):
    return \"Hello {}, how are you?\".format(str)",
"def get_vowels(str):
    counter = 0
    for chr in str:
        if chr in \"AEIOUaeiou\":
            counter += 1
    return counter|~|
def half(num):
    return num / 2"
);


