<?php
    require '../connect.php';

    $id = $con->real_escape_string($_POST['id']);
    $current = $con->real_escape_string($_POST['current']);
    $max = $con->real_escape_string($_POST['max']);

    $current = ($current - 1) * $max;

    $sql = $con->query("SELECT * FROM project WHERE supervisor = '$id' AND status = 'Approved' AND student IS NULL LIMIT $current, $max");

    $output = '';

    $output .= '
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Title</td>
                        <td>Status</td>
                        <td>No. Student</td>
                    </tr>
                </thead>
                ';
    $output .= '<tbody>';

    if($sql->num_rows > 0) {
        while($result = $sql->fetch_assoc()) {
            $proposal_id = $result['id'];
            $title = $result['title'];
            $status = $result['status'];
            
            $student = $con->query("SELECT * FROM project_registration WHERE project = '$proposal_id'");

            $output .= '
                        <tr>
                        <td>'.$proposal_id.'</td>
                        <td>'.$title.'</td>
                        <td>'.$status.'</td>
                        <td>'.$student->num_rows.'</td>
                        <td><button class="btn-1 view-student">View</button></td>
                        </tr>
                        ';
        }

        $output .= '</tbody>';

        echo $output;
    }else {
        echo '<thead><tr><th>No Data Found</th></tr></thead>';
    }
?>