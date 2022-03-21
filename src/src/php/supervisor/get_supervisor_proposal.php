<?php
    require '../connect.php';

    $id = $con->real_escape_string($_POST['id']);
    $current = $con->real_escape_string($_POST['current']);
    $max = $con->real_escape_string($_POST['max']);

    $current = ($current - 1) * $max;

    $sql = $con->query("SELECT project.id, title, status, student.username FROM project LEFT JOIN student ON project.student = student.id WHERE supervisor = '$id' LIMIT $current, $max");

    $output = '';

    $output .= '
                <thead>
                    <tr>
                        <td>ID</td>
                        <td>Title</td>
                        <td>Status</td>
                        <td>Student</td>
                    </tr>
                </thead>
                ';
    $output .= '<tbody>';

    if($sql->num_rows > 0) {
        while($result = $sql->fetch_assoc()) {
            $proposal_id = $result['id'];
            $title = $result['title'];
            $status = $result['status'];
            $student = $result['username'] == NULL ? 'None' : $result['username'];

            $output .= '
                        <tr>
                            <td>'.$proposal_id.'</td>
                            <td>'.$title.'</td>
                            <td>'.$status.'</td>
                            <td>'.$student.'</td>
                        </tr>
                        ';
        }

        $output .= '</tbody>';

        echo $output;
    }else {
        echo '<thead><tr><th>No Data Found</th></tr></thead>';
    }
?>