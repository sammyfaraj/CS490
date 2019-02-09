<?php
  echo 'HELLOOOOOOOOOOOOOOOO';
  header("Content-type: application/json; charset=UTF-8");
  $str_json = file_get_contents('php://input'); 
  $response = json_decode($str_json, true);
  if(isset($response['name'])) $name = $response['name'];
  if(isset($response['pass'])) $pass = $response['pass'];

	
  define('dbhost', 'sql2.njit.edu');
  define('dbuser', 'jsf25');
  define('dbpass', '8FJBGgDP');
  define('dbtable', 'jsf25');
  //sample logins
  //username || password
  //pw65 || abc
  //test || test
  
  //create connection
  $conn = new mysqli(dbhost,dbuser,dbpass,dbtable);
  
  //check connection
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  
   $query="select * from users where  `username` like '$name' and `password` like '$pass'";
  
   //$result = $conn->query($sql);
  
  $query = $conn->query($query);
  $result=$query->fetchAll();
	if($result) echo "Project Accept";
	else echo "Project Reject";
  
  
  if ($result->num_rows == 0) { //user doesnt exist
  	echo json_encode("fail");
    //output data of each row
 
  } else {
  	echo json_encode("success");
  }
  
  $conn->close();
  
 
?>