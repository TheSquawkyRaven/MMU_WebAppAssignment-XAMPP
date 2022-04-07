<?php

    require("../../php/connect.php");

    $projectMod = $_POST["projectMod"];

    $projectModID = substr($projectMod, 1, strlen($projectMod) - 1);
    $approve = substr($projectMod, 0, 1);

    if ($approve == "A"){
        echo "Approve ".$projectModID;
        $update = "UPDATE project SET status = 'Approved' WHERE id = $projectModID";
        $con->query($update);
    }
    else if ($approve == "R"){
        echo "Reject ".$projectModID;
        $update = "UPDATE project SET status = 'Rejected' WHERE id = $projectModID";
        $con->query($update);
    }

    header("Location: ../index.php");

?>