<?php

/*
		
*/

#Retrieve raw HTTP request data
$str_json = file_get_contents('php://input');

#Decode raw HTTP data into json format
$decoded_data = json_decode($str_json, true);

if (is_null($decoded_data)){
  	
	//$decoded_data = array("request_id"=>"START_EXAM","exam_name"=> "spring19finals");
	echo "hellooooooo";
	
	//$decoded_data = array("request_id"=>"CREATE_EXAM","questions" => array("1","2"));
		
		//echo $decoded_data['questions'][1];
		//question should be added one by one;
		//echo $decoded_data['questions']['0'][0];
		
	route($decoded_data);
}
else{
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
        //echo "Question addition skipped...";
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
            include "getall.php";
            break;
        case "CREATE_EXAM":
			include "create_exam.php";
            //header("Location:https://web.njit.edu/~jsf25/create_exam.php"); //header("Location:create_exam.php");
			//exit;
            break;
		case "ADD_TO_EXAM":
            include "add_to_exam.php";
            //header("Location:https://web.njit.edu/~jsf25/create_exam.php"); //header("Location:create_exam.php");
			//exit;
            break;
		case "IS_AVAILABLE":
            include "is_available.php";
            //header("Location:https://web.njit.edu/~jsf25/create_exam.php"); //header("Location:create_exam.php");
			//exit;
            break;
		case "GET_ACTIVE_EXAM":
            include "start_exam.php";
            //header("Location:https://web.njit.edu/~jsf25/create_exam.php"); //header("Location:create_exam.php");
			//exit;
            break;
        case "RELEASE_EXAM":
            include "release_exam.php";
            break;
        case "END_EXAM":
			
            // TODO: Update exams IN_PROGRESS as CLOSED
            // TODO: Calculate Grades + update scores in db + mark exam as "TO REVIEW GRADES"
            // TODO: Return response OK/Error
            echo("End Exam block");
            break;
        case "REVIEW_GRADES":
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

//$conn->close()

?>
