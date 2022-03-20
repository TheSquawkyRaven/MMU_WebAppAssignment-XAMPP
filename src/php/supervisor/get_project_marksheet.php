<?php
    require '../connect.php';

    $id = $con->real_escape_string($_POST['id']);
    $current = $con->real_escape_string($_POST['current']);
    $max = $con->real_escape_string($_POST['max']);
    $status = $con->real_escape_string($_POST['status']);

    $current = ($current - 1) * $max;

    $sql = $con->query("SELECT project.id, title, status, student.username, student.name FROM project LEFT JOIN student ON project.student = student.id  WHERE supervisor = '$id' AND project.student IS NOT NULL AND status = '$status' LIMIT $current, $max");

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

            $btn = $status == 'Approved' ? '<td><button class="btn-1 mark">Mark</button></td>' : '';

            $output .= '
                        <tr>
                            <td>'.$proposal_id.'</td>
                            <td>'.$title.'</td>
                            <td>'.$username.'</td>
                            <td>'.$name.'</td>
                            '.$btn.'
                        </tr>
                        ';
        }

        $output .= '</tbody>';

        echo $output;
    }else {
        echo '<thead><tr><th>No Data Found</th></tr></thead>';
    }
?>