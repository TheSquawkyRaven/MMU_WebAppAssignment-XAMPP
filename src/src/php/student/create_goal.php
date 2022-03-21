<?php
    require '../connect.php';

    $task = $con->real_escape_string($_POST['task']);
    $category = $con->real_escape_string($_POST['category']);
	$status = $con->real_escape_string($_POST['status']);
	$start = $con->real_escape_string($_POST['start']);
	$end = $con->real_escape_string($_POST['end']);
    $id = $con->real_escape_string($_POST['id']);

    $sql = $con->query("INSERT INTO project_goal(project, task, category, start, end, status) VALUES('$id', '$task', '$category', '$start', '$end', '$status')");

    if($sql) {
        echo 'true';
    }else {
        echo "INSERT INTO project_goal(project, task, category, start, end, status) VALUES('$id', '$task', '$category', '$start', '$end', '$status')";
        echo $con->error;
    }
?>