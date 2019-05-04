<?php

require_once("db.php");

function add_question($in_data)
{
    echo "in addquestion";
    $db = new DB();
    $conn = $db->get_connection();

    $intro = $in_data["intro"];
    $topic = $in_data["topic"];
    $diff = $in_data["diff"];
    $func_name = $in_data["func_name"];
    $inone = $in_data["inone"];
    $outone = $in_data["outone"];
    $enforcefor = $in_data["enforcefor"];
    $enforcewhile = $in_data["enforcewhile"];
    $enforceprint = $in_data["enforceprint"];
    
    echo "hello";
    
    $sql = "INSERT INTO `masterquestions` 
    (`intro`, `topic`, `diff`, `func_name`,`inone`, `outone`, `enforcefor`, `enforcewhile` ,`enforceprint`) 
    VALUES (\"$intro\", '$topic', '$diff', '$func_name', '$inone', '$outone','$enforcefor','$enforcewhile','$enforceprint')";

    $success = $conn->query($sql);
    $conn->close();

    return $success ? "Question successfully added!" : "Question not added.";
}

?>