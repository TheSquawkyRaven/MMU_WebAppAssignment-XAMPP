<?php
    require '../connect.php';

    $id = $_POST['planning_id'];
    $type = $_POST['type'];

    $sql = $con->query("UPDATE project_planning SET status = '$type' WHERE id = '$id'");
?>