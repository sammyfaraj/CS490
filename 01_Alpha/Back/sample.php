<?php
  echo 'HELLOOOOOOOOOOOOOOOO';
  header("Content-type: application/json; charset=UTF-8");
  $str_json = file_get_contents('php://input'); 
  $response = json_decode($str_json, true);
  if(isset($response['name'])) $name = $response['name'];
  if(isset($response['pass'])) $pass = $response['pass'];

	
  define('dbhost', 'sql.njit.edu');
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
  else
  {
	  echo 'Connection Successful';
  }
  
  echo $name;
  echo $pass;
  
   $sql="CREATE TABLE IF NOT EXISTS `WOOOZERS` 
	(
    `NAME` varchar(255) NOT NULL default '',
    `PASS` varchar(255) NOT NULL default '',
    PRIMARY KEY  (`NAME`)
	) ENGINE = InnoDB;";
  
   $stmt = mysqli_prepare($sql);
   
   $stmt->bind_param("sss", $name, $pass);
   $stmt = mysql_query($stmt, $conn);
   $stmt->execute();
  
 
?>