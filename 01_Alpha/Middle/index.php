<?php
echo "Running Middle";

# STEP 1: Retrieve raw HTTP request data
$str_json = file_get_contents('php://input');

# STEP 2: Decode raw HTTP data into json format
$response = json_decode($str_json, true);

# STEP 3: Testdata until connection to front-end is setup
$username = "Username";
$password = "Password";

?>