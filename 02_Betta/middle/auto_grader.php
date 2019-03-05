<?php
/**
 * User: Braulio Tonaco
 * Date: 2019-03-04
 */

$exams = array(
    array(
        "username" => "student1",
        "exam_name" => "Sprint2019",
        "answers" => array(
            "awr1", "anwr2", "awr3"
        ),
        array("username" => "student2",
            "exam_name" => "Sprint2019",
            "answers" => array(
                "awr1", "anwr2", "awr3"
            )
        ),
        array(
            "username" => "student2",
            "exam_name" => "Sprint2019",
            "exam_status" => "PENDING",
            "questions" => array(
                array("q1",
                    "def vowelCount(test):
    test.lower()
    counter = 0

    for chr in test:
        if chr in \"AEIOUaeiou\":
            counter += 1

    return counter",
                    "test_cases" => array(
                        array("I am the welrus", "5"),
                        array("aeiou", "5"),
                    )
                ),
                array("q2",
                    "def vowelCount(test):
                        test.lower()
                        counter = 0

                        for chr in test:
                            if chr in \"AEIOUaeiou\":
                                counter += 1
        
                        return counter",
                    "test_cases" => array(
                        array("I am the welrus", "5"),
                        array("aeiou", "5"),
                    )
                ),
            )
        )
    );

$answer = "def vowelCount(test):
    test.lower()
    counter = 0

    for chr in test:
        if chr in \"AEIOUaeiou\":
            counter += 1
    
    print(78)
    return counter
    
vowelCount('aeiou')";

echo "Saving into file<br>";
file_put_contents("answer.py", $answer);

echo "executing python file<br>";
$ret = exec("chmod 777 ./answer.py && python answer.py", $out);

echo "<br><br>";
var_dump($out);
echo "<br><br>$ret";

//foreach ($exams as $student) {
//    $questions = $student['questions'];
//
//    foreach ($questions as $question){
//        $q = $question[0];
//        $answer = $question[1];
//        $test_cases = $question['test_cases'];
//
//        foreach ($test_cases as $test_case){
//            $input = $test_case[0];
//            $output = $test_case[1];
//
//            file_put_contents("answer.py", $answer);
//
//            exec("python answer.py $input", $func_output, $returned_value);
//            echo "<br>Question: $q<br>";
//            echo "<br>Input: $input<br>";
//            echo "<br>Output: $func_output -       Expected Output: $output<br>";
//
//            echo "<br>Returned value: $returned_value<br><br>";
//        }
//    }
//}
