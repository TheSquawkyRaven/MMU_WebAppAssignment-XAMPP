<?php

    $projectID = $_SESSION['projectID'];

    $plans = $con->query(
        "SELECT project_planning.title, project_planning.description, project_planning.fromdate, project_planning.todate, project_planning.status 
        FROM project_planning
        INNER JOIN project ON project_planning.project = project.id
        WHERE project.id = ".$projectID
    );

    if ($plans->num_rows == 0){
        echo "No Plans Yet";
    }
    else{

        echo
        "
        <thead>
            <tr>
                <th>No.</th>
                <th>Title</th>
                <th>Description</th>
                <th>From</th>
                <th>To</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>";

        $i = 1;

        while ($plan = $plans->fetch_assoc()){
            
            $titlePlan = $plan["title"];
            $descPlan = $plan["description"];
            $fromDatePlan = $plan["fromdate"];
            $toDatePlan = $plan["todate"];
            $statusPlan = $plan["status"];
    
            echo
            "<tr>
            <td>$i</td>
            <td>$titlePlan</td>
            <td>$descPlan</td>
            <td>$fromDatePlan</td>
            <td>$toDatePlan</td>
            <td>$statusPlan</td>";
    
            echo "</tr>";
            
            $i++;
        }
    }

?>