<?php
/**
 *  Author:  Braulio Tonaco
 *  Date:    2019-02-19
 *  Class    CS490
 *
 *  This file will serve as a starting point for middleware.
 */

$json_data = json_decode(
    file_get_contents("php://input"), true
);

switch ($json_data["request_id"]) {
    case "LOGIN":
        // TODO: Authenticate credentials with backend and return response to front-end
        echo("Authenticate Credentials block");
        break;
    case "T_MAIN":
        // TODO: Request all available test questions from backend and return response in json format to front-end
        echo("Retrieve Questions block");
        break;
    case "T_CREATE":
        // TODO: Request all available test questions from backend and return response in json format to front-end
        echo("Retrieve Questions block");
        break;
    case "T_ADD":
        // TODO: Send added question to backend and return updated questions list from backend
        echo("Add questions block");
        break;
    case "S_MAIN":
        // TODO: Request all available test questions from backend and return response in json format to front-end
        echo("Retrieve Questions block");
        break;
    case "S_TEST":
        // TODO: Request all available test questions from backend and return response in json format to front-end
        echo("Retrieve Questions block");
        break;
    case "S_GRADES":
        // TODO: Send added question to backend and return updated questions list from backend
        echo("Add questions block");
        break;
    default:
        // TODO: Invalid request
        echo("Invalid request block");
}

?>