<?php
  $username=$_POST['username'];
  $password=$_POST['password'];
  $data = array('username' => $username,'password' =>$password);
  //$url = "https://web.njit.edu/~jsf25/sample.php";
  //$url = "http://localhost:8080/Back/sample.php";
  $url = "https://web.njit.edu/~bt74/alpha/middle/index.php";

  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
  $response = curl_exec($ch);
  curl_close ($ch);
  
  $decoded = json_decode($response, true);
  $njitreply = $decoded["NJIT"];
  $backreply = $decoded["BACKEND"];
  /*
  $x = file_get_contents($response), true;
  echo $x;
  echo "<br>";
  echo "NJIT THINKS: $njitreply";
  echo "<br>";
  echo "DATABASE THINKS: $backreply"; 
  */
  echo $response;
  return $response;
?>