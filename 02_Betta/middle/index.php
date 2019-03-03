<?php
/**
 *  Author:  Braulio Tonaco
 *  Date:    2019-02-19
 *  Class    CS490
 */

include "test_cases.php";
require_once("helper_functions.php");

$data = get_http_request();

if (is_null($data))         # Check if request is coming from Front-end and data is successfully retrieved
    run_test_cases();
else                        # Call router
    router($data);