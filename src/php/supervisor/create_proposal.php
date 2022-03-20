<?php
    require '../connect.php';

    $title = $con->real_escape_string($_POST['title']);
    $descrip = $con->real_escape_string($_POST['descrip']);
    $id = $con->real_escape_string($_POST['id']);

    $sql = $con->query("INSERT INTO project(title, description, status, supervisor) VALUES('$title', '$descrip', 'Pending', '$id')");

    if($sql) {
        echo 'true';
    }else {
        echo "INSERT INTO project(title, description, status, supervisor) VALUES('$title', '$descrip', 'Pending', '$id')";
        echo $con->error;
    }
?>