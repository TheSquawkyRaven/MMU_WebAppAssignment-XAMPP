<?php

    $projectID = $_SESSION['projectID'];

    $plans = $con->query(
        "SELECT * FROM project_planning
        INNER JOIN project ON project_planning.project = project.id
        WHERE project.id = ".$projectID
    );

    if ($plans->num_rows == 0){
        echo "No Plans Yet";
    }
    else{

        /* echo
        "
        <thead>
            <tr>
                <th>No.</th>
                <th>Title</th>
                <th>Description</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>";

        $i = 1;

        while ($plan = $plans->fetch_assoc()){
            
            $projectID = $plan["ProjectID"];
            $title = $plan["Title"];
            $desc = $plan["Desc"];
            $super = $plan["SupervisorName"];
            $status = $plan["Status"];
    
            echo
            "<tr>
            <td>$i</td>
            <td>$title</td>
            <td>$desc</td>
            <td>$super</td>
            <td>$status</td>";
    
            echo "<td><button class='btn-1' type='submit' name='projectID' value='$projectID'>Select</button></td>";
            echo "</tr>";
            
            $i++;
        } */
    }

?>