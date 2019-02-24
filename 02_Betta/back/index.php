<?php

/*
		
*/

#Retrieve raw HTTP request data
$str_json = file_get_contents('php://input');

#Decode raw HTTP data into json format
$decoded_data = json_decode($str_json, true);

if (is_null($decoded_data))
    echo "Data is NULL";
else {
    route($decoded_data);
}

function route($data)
{
    switch ($data["request_id"]) {
        case "LOGIN":
			include "login.php";
            //header("Location:https://web.njit.edu/~jsf25/login.php"); //header("Location:login.php");
			//exit;
            break;
        case "ADD_QUESTION":
			include "addquestion.php";
            //header("Location:https://web.njit.edu/~jsf25/addquestion.php"); //header("Location:addquestion.php");
			//exit;
            break;
        case "FILTER":
            include "filter.php";
            //header("Location:https://web.njit.edu/~jsf25/filter.php"); //header("Location:filter.php");
			//exit;
            break;
        case "GET_ALL":
            
            break;
        case "CREATE_EXAM":
            include "addquestion.php";
            //header("Location:https://web.njit.edu/~jsf25/create_exam.php"); //header("Location:create_exam.php");
			//exit;
            break;
        case "T_RELEASE_EXAM":
            
            break;
        case "T_END_EXAM":
            // TODO: Update exams IN_PROGRESS as CLOSED
            // TODO: Calculate Grades + update scores in db + mark exam as "TO REVIEW GRADES"
            // TODO: Return response OK/Error
            echo("End Exam block");
            break;
        case "T_REVIEW_GRADES":
            // TODO: Request from backend list of "TO REVIEW GRADES" exams  + Student Name associated w/ it
            // TODO: Send response to Front-End
            echo("Review grades block");
            break;
        case "T_SUBMIT_GRADES":
            // TODO: Send to Backend reviewed exams
            // TODO: Return response OK/Error
            echo("Submit grades block");
            break;
        case "S_MAIN":
            // TODO: Request from back if student has available test
            // TODO: Send response back to frontend
            echo("Student main block");
            break;
        case "S_TEST":
            // TODO: Request from backend exam assigned to student
            // TODO: Send response back to frontend
            echo("Exam request block");
            break;
        case "S_GRADES":
            // TODO: Request exam grade from backend, if test is stil in "TO REVIEW GRADES" status, return
            //  "Grading in progress" or coding (YET TO DECIDE)
            echo("Student Grade Request block");
            break;
        default:
            // TODO: Invalid request
            echo("Invalid request block");
    }
}

$conn->close()

?>