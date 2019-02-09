<?php
/*  Author: Braulio Tonaco
    Class: CS490
    Date: 02/09/19
*/

# STEP 1: Retrieve raw HTTP request data
$str_json = file_get_contents('php://input');

# STEP 2: Decode raw HTTP data into json format
$decoded_data = json_decode($str_json, true);

# STEP 3: Retrieve values
$username = $decoded_data["username"];
$password = $decoded_data["password"];

# STEP 3.1: Test case
//$username = "bt74";
//$password = "password";

// STEP 4: Check credentials against backend
$back_response = backend($username, $password);
$back_decoded = json_decode($back_response, true);

// STEP 5: Check credentials against njit website
$njit_response = njit($username, $password);

// STEP 6: Initialize an array
$ret_json = array(
    "NJIT" => $njit_response,
    "BACKEND" => $back_decoded["DATABASE"]
);

# STEP 7: Return/Echo JsonFile
echo json_encode($ret_json);


# HELPER FUNCTIONS
function backend($name,$pass) {
    $data = array('username' => $name, 'password' => $pass);
    //$url = "https://web.njit.edu/~bt74/alpha/back/";
    $url = "https://web.njit.edu/~jsf25/index.php";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    $response = curl_exec($ch);
    curl_close($ch);
    return $response;
}

function njit($name,$pass){
    $url = "https://cp4.njit.edu/cp/home/login";
    $data= array("user" => $name,"pass" =>$pass,"uuid" => "0xACA021");
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    $response = curl_exec($ch);
    curl_close ($ch);

    if (strpos($response,"Error: Failed Login")==false)
        return "1";
    else
        return "0";
}
?>