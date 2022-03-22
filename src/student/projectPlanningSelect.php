<?php 
    session_start(); 
    require '../php/connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home</title>
    <link rel="stylesheet" href="../css/main.css" />
    <script src="../libraries/jquery-3.2.1.min.js"></script>
</head>
<body>
    <?php require '../include/user-navbar.inc.php'; ?>

    <?php

        if (!array_key_exists("projectID", $_POST)){
            $projects = $con->query(
                "SELECT project.id AS `ProjectID`, `title` AS 'Title', `description` AS 'Desc', student.name AS 'StudentName', supervisor.name AS 'SupervisorName', `status` AS 'Status' FROM `project`
                INNER JOIN `student` ON student.id = project.student
                INNER JOIN `supervisor` ON supervisor.id = project.supervisor
                WHERE `student` = ".$_SESSION["id"]
            );

            if ($projects->num_rows == 1){
                $project = $projects->fetch_assoc();
                $projectSelected = 1;
            }
            else{
                $projectSelected = 0;
            }
        }

        if ($projectSelected == 1){
            header("Location: projectPlanning.php");
        }

    ?>

    <!--Project Container-->
    <div class='detail-container'>
        <div class='table-detail'>
            <div class='header'>
                <h2>Projects</h2>
            </div>
            <form name='planning-projectSelect' action='projectPlanning.php' class='planning-projectSelect' method='POST' autocomplete='off'>
            <table class='table-1'>
                <?php
                require_once('projectlist.php');
                ?>
            </form>
            </table>
        </div>
    </div>

</body>
</html>