<?php

    $projects = $con->query(
        "SELECT project.title, project.description, supervisor.name, project.status, project.id FROM project
        INNER JOIN supervisor ON project.supervisor = supervisor.id
        WHERE project.status = 'Pending'");

    if ($projects->num_rows == 0){
        echo "No Pending Project Proposals";
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
                <th>Action</th>
            </tr>
        </thead>
        <tbody>";

        $i = 1;

        while ($project = $projects->fetch_assoc()){
            
            $title = $project["title"];
            $desc = $project["description"];
            $supervisorName = $project["name"];
            $status = $project["status"];
            $projectID = $project["id"];
    
            echo
            "<tr>
            <td>$i</td>
            <td>$title</td>
            <td>$desc</td>
            <td>$supervisorName</td>
            <td>$status</td>
            <td>
            <button class='btn-1' type='submit' name='projectMod' value='A$projectID'>Approve</button>
            <button class='btn-2' type='submit' name='projectMod' value='R$projectID'>Reject</button>
            </td>";
    
            echo "</tr>";
            
            $i++;
        }
    }



?>