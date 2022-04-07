<?php 
    session_start(); 
    require '../php/connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Project Planning</title>
    <link rel="stylesheet" href="../css/main.css" />
    <!-- <script src="../libraries/jquery-3.2.1.min.js"></script> -->

    <!-- External Calendar -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
</head>
<body>
    <?php require '../include/user-navbar.inc.php'; ?>

    <?php
        $projectSelected = 0;
        if (!array_key_exists("projectID", $_POST)){
            $projects = $con->query(
                "SELECT project.id AS `ProjectID`, `title` AS 'Title', `description` AS 'Desc', student.name AS 'StudentName', supervisor.name AS 'SupervisorName', `status` AS 'Status' FROM `project`
                INNER JOIN `student` ON student.id = project.student
                INNER JOIN `supervisor` ON supervisor.id = project.supervisor
                WHERE `student` = ".$_SESSION["id"]
            );

            if ($projects->num_rows == 1){
                $project = $projects->fetch_assoc();
                $projectID = $project["ProjectID"];
                $projectSelected = 1;
            }
            else{
                //Else redirect to select page
                $projectSelected = 0;
            }
        }
        else {
            $projectID = $_POST["projectID"];
            $projects = $con->query(
                "SELECT project.id AS `ProjectID`, `title` AS 'Title', `description` AS 'Desc', student.name AS 'StudentName', supervisor.name AS 'SupervisorName', `status` AS 'Status' FROM `project`
                INNER JOIN `student` ON student.id = project.student
                INNER JOIN `supervisor` ON supervisor.id = project.supervisor
                WHERE project.id = ".$projectID
            );
            
            if ($project->num_rows != 0){
                $project = $projects->fetch_assoc();
                $projectSelected = 1;
            }
        }
        
        if ($projectSelected == 1){
            $projectTitle = $project["Title"];
            $projectDesc = $project["Desc"];
            $projectSuper = $project["SupervisorName"];
            $projectStatus = $project["Status"];
            $projectSelected = 1;
            $_SESSION["projectID"] = $projectID;
        }
        else{
            header("Location: projectPlanningSelect.php");
        }

    ?>


    <div class='detail-container'>
        <div class='table-detail'>
            <div class='header space-bottom'>
                <h2><?php echo $projectTitle; ?></h2>
                <button class='btn-1 space-left' id='form-popup'>Plan This Project</button>
            </div>
            <div class='full space-bottom'>
                <div class='left'><h3><?php echo $projectSuper; ?></h3></div>
                <div class='right'><p>Status: <?php echo $projectStatus; ?></p></div>
            </div>
            <div class='space-bottom'>
                <h3>Description</h3>
                <p><?php echo $projectDesc; ?></p>
            </div>

            <table class="table-1">

                <?php
                    include("projectplanlist.php");
                ?>

            </table>

        </div>
    </div>

    <div class="exit-background form-popup hidden">
        <div class="form-container">
            <div class="wrap">
                <form name="planning-form" action="php/projectPlanning.php" class="planning-form" method="POST" autocomplete="off">
                    <div class="header">
                        <h2>Project Planning</h2>
                        <img class="exit-btn" src="../assets/exit-2.svg" alt="exit">
                    </div>
                    <div class="input-field">
                        <label>Title*<span id="title-err" class="err message"><img src="../assets/error.svg"></span></label>
                        <input type="text" name="title" placeholder="Title*">
                    </div>
                    <div class="input-field">
                        <label>Task*<span id="desc-err" class="err message"><img src="../assets/error.svg"></span></label>
                        <textarea name="description" rows="5" cols="50" placeholder="Write your description here*"></textarea>
                    </div>

                    <div class='input-field'>
                        <label>Period Range (MM/DD/YYYY)*<span id="period-err" class="err message"><img src="../assets/error.svg"></span></label>
                        <input type="text" name="period_range" value="<?php echo date('m/d/Y') ?> - <?php echo date('m/d/Y') ?>" />
                    </div>

                    <input type="hidden" name="studentID" value="<?php echo $_SESSION["id"]; ?>">
                    <input type="hidden" name="supervisorID" value="<?php echo $projectSuper; ?>">
                    <input type="hidden" name="projectID" value="<?php echo $projectID; ?>">

                    <div class="form-btn">
                        <input class="btn-1" type="submit" value="submit">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>

        $(function() {
            $('input[name="period_range"]').daterangepicker({
                showDropdowns: true,
                autoApply: true,
            }, function(start, end, label) {
                //console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
            });
        });


        $('#form-popup').on('click', function(){
            $('.err').hide();
            $('.form-popup').show();
        });
        $('.exit-btn').on('click', function(){
            $('.exit-background').hide();
        });
        $('.exit-background').on('click', function(e){
            var target = $(e.target);
            if(!target.is('.form-container')) return;
            else $('.exit-background').hide();
        });

        function validateForm(){
            let f = document.forms["planning-form"];
            let x = f["title"].value;
            let err = false;
            if (x == ''){
                $('#title-err').show();
                err = true;
            }
            else{
                $('#title-err').hide();
            }
            x = f["description"].value;
            if (x == ''){
                $('#desc-err').show();
                err = true;
            }
            else{
                $('#desc-err').hide();
            }
            x = f["period_range"].value;
            const split = x.split(" - ");
            if (split.length != 2){
                $('#period-err').show();
                err = true;
            }
            else{
                function IsDate(date){
                    try{
                        return (new Date(date) !== "Invalid Date") && !isNaN(new Date(date));
                    }catch (e){
                        console.log(e);
                    }
                    return false;
                }
                if (!IsDate(split[0]) || !IsDate(split[1])){
                    $('#period-err').show();
                    err = true;
                }
                else{
                    $('#period-err').hide();
                }
            }
            return !err;
        }

        $('.planning-form').on('submit', function(){
            let v = validateForm();
            return v;
        });

    </script>

</body>
</html>