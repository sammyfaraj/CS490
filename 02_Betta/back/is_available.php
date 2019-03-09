<?php

/*
	
*/

/*********************** 1 **********************/
require_once("db.php");

$db = new DB();
$conn = $db->get_connection();

// Check connection
if ($conn->connect_error)
    die("<br>Connection failed: " . $conn->connect_error);


//$json = file_get_contents('php://input'); 
//$received = json_decode($json, true);

/*********************** 2 **********************/

//front end to create own exam name---



//$query = "SELECT  FROM `Exam Status` WHERE `status` = 1";

//$result = $conn->query($query);

/*
$row = mysqli_fetch_array($result);
$exam_name = $data[$row[1]];
echo $exam_name;
*/
$query = "SELECT exam_name FROM `Exam Status` WHERE status = 1";
$result = $conn->query($query);

$end_temp = "Results";
$row = mysqli_fetch_array($result);


if ($data["request_id"] != "GET_TEST_CASES" and $result->num_rows > 0)
{
    if(!is_null($row))
    {
      $end_name = $row[0].$end_temp;
      //echo $end_name;
    }
    else
    {
      $ret_json->status = '1';
	    $json_message = json_encode($ret_json);
	    echo $json_message;
    }   
}
else if ($data["request_id"] != "GET_TEST_CASES")
{
    $ret_json->status = '0';
	  $json_message = json_encode($ret_json);
	  echo $json_message;
}


//echo $row[0];

/*
if($result)
	echo $row[0]; //to return without quotations
else 
	echo $result;
*/

//echo json_encode($row[0]);


$conn->close()

?>
