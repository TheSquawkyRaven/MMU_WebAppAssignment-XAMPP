<?php
    require '../connect.php';

    $student_id = $_POST['student_id'];
    $project_id = $_POST['project_id'];

    $sql = $con->query("UPDATE project SET student = '$student_id' WHERE id = '$project_id'");
?>