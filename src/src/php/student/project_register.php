<?php
    require '../connect.php';

    $id = $con->real_escape_string($_POST['id']);
    $project_id = $con->real_escape_string($_POST['project_id']);

    $sql = $con->query("INSERT INTO project_registration(project, student) VALUES('$project_id', '$id')");

    if($sql) {
        echo 'true';
    }else {
        echo "INSERT INTO project_registration(project, student) VALUES('$project_id', '$id')";
        echo $con->error;
    }
?>