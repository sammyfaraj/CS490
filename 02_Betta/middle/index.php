<?php
/**
 *  Author:  Braulio Tonaco
 *  Date:    2019-02-19
 *  Class    CS490
 */

include "test_cases.php";
require_once("router.php");

$data = get_http_request();

//$data = array(
//    "request_id" => "SUBMIT_EXAM"
//);

# Check if request is coming from Front-end and data is successfully retrieved
if (is_null($data)) {
    echo "Unable to read data from front-end - index.php file";
} else{
    router($data);
}


function get_http_request()
    /** Decodes HTTP request from Front-end **/
{
    $raw_data = file_get_contents("php://input");
    $decoded_json = json_decode($raw_data, true);
    return $decoded_json;
}