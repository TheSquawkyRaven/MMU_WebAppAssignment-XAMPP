<?php
    require '../connect.php';
    
    $id = $con->real_escape_string($_POST['id']);

    $mark1 = $con->real_escape_string($_POST['mark1']);
    $mark2 = $con->real_escape_string($_POST['mark2']);
    $mark3 = $con->real_escape_string($_POST['mark3']);
    $mark4 = $con->real_escape_string($_POST['mark4']);
    $mark5 = $con->real_escape_string($_POST['mark5']);
    $comment = $con->real_escape_string($_POST['comment']);

    $sql = $con->query("INSERT INTO project_marksheet(project, mark1, mark2, mark3, mark4, mark5, comment) VALUES('$id', '$mark1', '$mark2', '$mark3', '$mark4', '$mark5', '$comment')");

    if($sql) {
        $update = $con->query("UPDATE project SET status = 'Achieved' WHERE id = '$id'");
        if($update)
            echo 'true';
        else {
            echo "UPDATE project SET status = 'Archieved' WHERE id = '$id'";
            echo $con->error;
        }
    }else {
        echo "INSERT INTO project_marksheet(mark1, mark2, mark3, mark4, mark5, comment) VALUES('$mark1', '$mark2', '$mark3', '$mark4', '$mark5', '$comment')";
        echo $con->error;
    }
?>