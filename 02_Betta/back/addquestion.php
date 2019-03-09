<?php

require_once("db.php");

function add_question($in_data)
{
    $db = new DB();
    $conn = $db->get_connection();

    $intro = $in_data["intro"];
    $topic = $in_data["topic"];
    $diff = $in_data["diff"];
    $func_name = $in_data["func_name"];
    $paramname = $in_data["paramname"];
    $paramtype = $in_data["paramtype"];
    $inone = $in_data["inone"];
    $intwo = $in_data["intwo"];
    $outone = $in_data["outone"];
    $outtwo = $in_data["outtwo"];

    $sql = "INSERT INTO `masterquestions` 
    (`intro`, `topic`, `diff`, `func_name`, `paramname`, `paramtype`, `inone`, `outone`, `intwo`, `outtwo`) 
    VALUES (\"$intro\", '$topic', '$diff', '$func_name', '$paramname', '$paramtype', '$inone', '$outone', '$intwo', '$outtwo')";

    $success = $conn->query($sql);
    $conn->close();

    return $success ? "Question successfully added!" : "Question not added.";
}

?>