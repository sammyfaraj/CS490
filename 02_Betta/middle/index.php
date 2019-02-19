<?php
/**
 *  Author:  Braulio Tonaco
 *  Date:    2019-02-19
 *  Class    CS490
 */

$json_data = json_decode(
    file_get_contents("php://input"), true
);

switch ($json_data["request_id"]) {
    case "LOGIN":
        // TODO: Authenticate credentials with backend and return response to front-end
        //      INPUT:
        //          1.  username
        //          2.  password
        //      OUTPUT:
        //          1.  role
        //              1. [ 0 ] - Invalid username OR password
        //              2. [ 1 ] - Teacher login
        //              3. [ 2 ] - Teacher login
        echo("Authenticate Credentials block");
        break;
    case "T_MAIN":
        // TODO: Request all available test questions from backend and return response in json format to front-end
        //      OUTPUT:
        //          1.  questions
        //      OUTPUT_FORMAT Example:
        //          {
        //              questions = [
        //                              {
        //                                  "id": "QUESTION UNIQUE ID"
        //                                  "question": "SOME QUESTION",
        //                                  "diff": "EASY"
        //                                  "topic: "LIST"
        //                                  "test cases": [
        //                                                  [(input1, input2), (output)], [(input1), (output1)]
        //                                                ]
        //                              }
        //                          ]
        //          }
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