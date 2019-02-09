<?php
/*  Author: Braulio Tonaco
    Class: CS490
    Date: 02/09/19
*/

# Link:
# https://webauth.njit.edu/idp/profile/cas/login;jsessionid=551CC509EC3B477AEE1D6C022FE98835?execution=e1s1

# STEP 1: Retrieve raw HTTP request data
$str_json = file_get_contents('php://input');

# STEP 2: Decode raw HTTP data into json format
$decoded_data = json_decode($str_json, true);

# STEP 3: Retrieve values
$username = $decoded_data["username"];
$password = $decoded_data["password"];

# STEP 4: Jsonify Retrieved data!
$ret_json = "{ 'username': '$username', 'password': '$password' }";

# STEP 5: Return JsonFile
echo $ret_json;

?>