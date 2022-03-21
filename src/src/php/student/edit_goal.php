<?php
    require '../connect.php';

    $task = $con->real_escape_string($_POST['task']);
    $category = $con->real_escape_string($_POST['category']);
	$status = $con->real_escape_string($_POST['status']);
	$start = $con->real_escape_string($_POST['start']);
	$end = $con->real_escape_string($_POST['end']);
    $id = $con->real_escape_string($_POST['id']);

    $sql = $con->query("UPDATE project_goal SET task = '$task', category = '$category', start = '$start', end = '$end', status = '$status' WHERE id = '$id'");

    if($sql) {
        //echo "UPDATE project_goal SET task = '$task', category = '$category', start = '$start', end = '$end', status = '$status' WHERE id = '$id'";
        echo 'true';
    }else {
        echo "UPDATE project_goal SET task = '$task', category = '$category', start = '$start', end = '$end', status = '$status' WHERE id = '$id'";
        echo $con->error;
    }
?>