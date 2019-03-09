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
if ($data["request_id"] == "GET_ALL")
{
   
      $query = "SELECT * FROM masterquestions";

      $getall_result=array();

      if ($result = $conn->query($query)) 
      {
          while ($row = $result->fetch_row()) 
          {
          //array_push($getall_result, $row);
		      $getall_result[]=$row;
          }
      $result->close();
       }
       
      echo json_encode($getall_result);
}
else if ($data["request_id"] == "GET_ACTIVE_EXAM")
{

      $query = "SELECT * FROM $row[0]";
      if ($result = $conn->query($query)) 
      {
        
          while ($row = $result->fetch_row()) 
          {

            //array_push($getall_result, $row);
            //$sql = "SELECT intro FROM masterquestions WHERE id = $row[2]";
            //$question = $result->fetch_row();                                    
		        //$getall_result[]=$question[0];
          }
	
      $result->close();
      }
      
      echo json_encode($getall_result);
}


$conn->close()

?>
