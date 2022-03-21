<?php

    $projects = $con->query(
    "SELECT `title` AS 'Title', `description` AS 'Desc', student.name AS 'StudentName', supervisor.name AS 'SupervisorName', `status` AS 'Status' FROM `project`
    INNER JOIN `student` ON student.id = project.student
    INNER JOIN `supervisor` ON supervisor.id = project.supervisor
    WHERE `student` = ".$_SESSION["id"]
    );

    if ($projects->num_rows == 0){
        echo "No Data Found";
    }
    else{
        echo
        "
        <thead>
            <tr>
                <th>No.</th>
                <th>Title</th>
                <th>Description</th>
                <th>Supervisor</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>";

        $i = 1;

        while ($project = $projects->fetch_assoc()){

            $title = $project["Title"];
            $desc = $proejct["Desc"];
            $super = $project["SupervisorName"];
            $status = $project["Status"];

            echo
            "<tr>
            <td>$i</td>
            <td>$title</td>
            <td>$desc</td>
            <td>$super</td>
            <td>$status</td>
            <tr>";
            echo "<tr>";
            
            $i++;
        }

        echo
        "</tbody>
        ";
    }

?>