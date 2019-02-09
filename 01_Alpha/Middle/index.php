<?php
echo "Running Middle";

# STEP 1: Retrieve raw HTTP request data
$str_json = file_get_contents('php://input');

# STEP 2: Decode raw HTTP data into json format
$response = json_decode($str_json, true);

# STEP 3: Testdata until connection to front-end is setup
$username = "Username";
$password = "Password";



$r = login_project($username, $password);

echo $r;

function login_project($name,$pass){
    echo "<br>Running login_project";

    $data = array('name' => $name,'pass' =>$pass);
    $url = "https://web.njit.edu/~jsf25/sample.php";
    //$url = "http://localhost:8080/Back/sample.php";

    echo "<br>Calling curl_init() to URL -> ".$url."<br>";

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    $response = curl_exec($ch);
    curl_close ($ch);
    return $response;
}
?>