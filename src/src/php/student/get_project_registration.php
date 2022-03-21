<?php
    require '../connect.php';

    $id = $con->real_escape_string($_POST['id']);
    $current = $con->real_escape_string($_POST['current']);
    $max = $con->real_escape_string($_POST['max']);
    $status = 'Approved';

    $current = ($current - 1) * $max;

    $search_project = $con->query("SELECT * FROM project WHERE student = '$id'");
    $search_register = $con->query("SELECT * FROM project_registration INNER JOIN project ON project_registration.project = project.id WHERE project_registration.student = '$id' AND project.student IS NULL ");

    if($search_project->num_rows > 0 || $search_register->num_rows > 0) {
        echo '<thead><tr><th>You have already assigned or registered a project</th></tr></thead>';
    }else {

    $sql = $con->query("SELECT project.id, project.title, project.description, supervisor.username, supervisor.name FROM project INNER JOIN supervisor ON project.supervisor = supervisor.id WHERE status = 'Approved' AND project.student IS NULL LIMIT $current, $max");

    $output = '';

    $output .= '
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Title</td>
                        <td>Username</td>
                        <td>Name</td>
                    </tr>
                </thead>
                ';
    $output .= '<tbody>';

    if($sql->num_rows > 0) {
        while($result = $sql->fetch_assoc()) {
            $proposal_id = $result['id'];
            $title = $result['title'];
            $username = $result['username'];
            $name = $result['name'];
            $d = $result['description'];

            $output .= '
                        <tr>
                            <td>'.$proposal_id.'</td>
                            <td>'.$title.'</td>
                            <td>'.$username.'</td>
                            <td>'.$name.'</td>
                            <td style="display:none;">'.$d.'</td>
                            <td><button class="btn-1 detail">Detail</button></td>
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