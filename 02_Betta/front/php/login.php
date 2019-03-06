<?php
  $url = "https://web.njit.edu/~bt74/betta/middleware/";
  
  $data = $_POST;
      
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
  $response = curl_exec($ch);
  curl_close ($ch);
  
  echo $response; 
?>