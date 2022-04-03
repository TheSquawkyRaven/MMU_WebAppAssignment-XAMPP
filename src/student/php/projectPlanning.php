<?php

    function GetSQLDateFormat($str){
        //Since the calendar is american, month first, then day, then year
        $year = substr($str, 6, 4);
        $month = substr($str, 0, 2);
        $day = substr($str, 3, 2);
        $date = $year."-".$month."-".$day;
        return $date;
    }

    session_start();
    require '../../php/connect.php';

    $title = $_POST["title"];
    $desc = $_POST["description"];
    $period = $_POST["period_range"];
    $studentID = $_POST["studentID"];
    $supervisorID = $_POST["supervisorID"];
    $projectID = $_POST["projectID"];

    $dates = explode(' - ', $period);
    $fromDate = GetSQLDateFormat($dates[0]);
    $toDate = GetSQLDateFormat($dates[1]);

    $insert = "INSERT INTO `project_planning`(`fromdate`, `todate`, `title`, `description`, `project`, `status`) VALUES ('$fromDate','$toDate', '$title','$desc','$projectID','Pending')";
    $con->query($insert);

    header("Location: ../projectPlanning.php");

?>