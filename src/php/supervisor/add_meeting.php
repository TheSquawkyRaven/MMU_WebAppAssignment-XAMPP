<?php
    require '../connect.php';

    $id = $con->real_escape_string($_POST['id']);
    $date = $con->real_escape_string($_POST['date']);
    $time = $con->real_escape_string($_POST['time']);
    $descrip = $con->real_escape_string($_POST['descrip']);

    $sql = $con->query("INSERT INTO project_meeting(project, date, time, description) VALUES('$id', '$date', '$time', '$descrip')");

    if($sql) {
        echo 'true';
    }else {
        echo "INSERT INTO project_meeting(project, date, time, description) VALUES('$id', '$date', '$time', '$descrip')";
        echo $con->error;
    }
?>