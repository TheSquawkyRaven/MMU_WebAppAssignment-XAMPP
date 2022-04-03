<?php
    require '../connect.php';

    $id = $con->real_escape_string($_POST['id']);
    $project_id = $con->real_escape_string($_POST['project_id']);
    $current = $con->real_escape_string($_POST['current']);
    $max = $con->real_escape_string($_POST['max']);
    $status = 'Approved';

    $current = ($current - 1) * $max;

    $search_project = $con->query("SELECT * FROM project WHERE student = '$id'");

    if($search_project->num_rows <= 0) {
        //echo "SELECT * FROM project WHERE student = '$id'";
        //echo "SELECT * FROM project_registration INNER JOIN project ON project_registration.project = project.id WHERE project_registration.student = '$id' AND project.student IS NULL ";
        echo '<thead><tr><th>You don\'t have active project right now</th></tr></thead>';
    }else {

    $sql = $con->query("SELECT * FROM project_goal WHERE project = '$project_id' LIMIT $current, $max");

    $output = '';

    $output .= '
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Task</td>
                        <td>Category</td>
                        <td>Start</td>
                        <td>End</td>
                        <td>Status</td>
                    </tr>
                </thead>
                ';
    $output .= '<tbody>';

    if($sql->num_rows > 0) {
        while($result = $sql->fetch_assoc()) {
            $proposal_id = $result['id'];
            $task = $result['task'];
            $category = $result['category'];
            $start = $result['start'];
            $end = $result['end'];
            $status = $result['status'];

            $output .= '
                        <tr>
                            <td>'.$proposal_id.'</td>
                            <td>'.$task.'</td>
                            <td>'.$category.'</td>
                            <td>'.$start.'</td>
                            <td>'.$end.'</td>
                            <td>'.$status.'</td>
                            <td><button class="btn-1 edit">Edit</button></td>
                        </tr>
                        ';
        }

        $output .= '</tbody>';

        echo $output;
    }else {
        echo '<thead><tr><th>No Data Found</th></tr></thead>';
    }
    } // if($search->num_rows > 0) 
?>