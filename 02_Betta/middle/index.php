<?php
/**
 *  Author:  Braulio Tonaco
 *  Date:    2019-02-19
 *  Class    CS490
 */

require_once("router.php");

function get_http_request() {
    /** Decodes HTTP request from Front-end **/

    $raw_data = file_get_contents("php://input");
    $decoded_json = json_decode($raw_data, true);
    return $decoded_json;
}

$data = get_http_request();

echo "Data Received from Front-end\n";
echo var_export($data, true);

if (is_null($data)){
    # Check if request is coming from Front-end and data is successfully retrieved
    
    echo "Unable to read data from front-end - index.php file<br>Running sample case";
    $data = array(
        "request_id" => "SUBMIT_EXAM",
        "answers" => "def doubleMe(some_num):\n    return some_num * 2|~|def printStr(str_one):\n    print(str_one)|~|",
        "username" => "student1"
    );
    router($data);
}  
else
    # Call router
    router($data);

