<?php

  $url = "https://web.njit.edu/~bt74/betta/middleware/index.php";
  $requestid = $_POST['request_id'];
  
  if ($requestid === "LOGIN"){
    $username=$_POST['username'];
    $password=$_POST['password'];
    $data = array('request_id' => $requestid, 'username' => $username,'password' =>$password); 
  } 
  elseif ($requestid === "GET_ALL"){
    $data = array('request_id' => $requestid);
  }
  elseif ($requestid === "ADD_QUESTION"){
    $data = array('request_id' => $requestid);
  }
  else{
      $data = array('request_id' => $requestid);
  }
      
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
  $response = curl_exec($ch);
  curl_close ($ch);
  
  echo $response; 
?>