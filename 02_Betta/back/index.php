<?php

/*
		
*/

#Retrieve raw HTTP request data
$str_json = file_get_contents('php://input');

#Decode raw HTTP data into json format
$decoded_data = json_decode($str_json, true);

if (is_null($decoded_data)){
  	
	//$decoded_data = array("request_id"=>"START_EXAM","exam_name"=> "spring19finals");
	echo "Data is Null";
	
	//$decoded_data = array("request_id"=>"CREATE_EXAM","questions" => array("1","2"));
		
		//echo $decoded_data['questions'][1];
		//question should be added one by one;
		//echo $decoded_data['questions']['0'][0];
		
	//route($decoded_data);
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
            include "is_available.php";
            include "getall.php";
            //header("Location:https://web.njit.edu/~jsf25/create_exam.php"); //header("Location:create_exam.php");
			//exit;
            break;
    case "GET_TEST_CASES":
            include "is_available.php"; //getting table name
            echo $row[0];
            include "get_cases.php";
        case "RELEASE_EXAM":
            include "release_exam.php";
            break;
        case "SUBMIT_EXAM":
            include "is_available.php";
            include "answers.php";
            break;
        case "END_EXAM":
			      include "end_exam.php";
            // TODO: Update exams IN_PROGRESS as CLOSED
            // TODO: Calculate Grades + update scores in db + mark exam as "TO REVIEW GRADES"
            // TODO: Return response OK/Error
            break;
        default:
            // TODO: Invalid request
            echo("Invalid request block");
    }
}

//$conn->close()

?>
