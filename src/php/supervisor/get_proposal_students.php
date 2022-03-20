<?php
    require '../connect.php';

    $id = $_POST['id'];

    $sql = $con->query("SELECT student.id, name, username FROM student, project_registration WHERE student.id = project_registration.student AND project_registration.project = '$id'");

    $output = '';
    $output .= '
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Student Name</th>
                        <th>Student Username</th>
                    </tr>
                </thead>   
                ';
    $output .= '<tbody>';
    if($sql->num_rows > 0) {
        while($result = $sql->fetch_assoc()) {
            $student_id = $result['id'];
            $name = $result['name'];
            $username = $result['username'];
    
            $output .= '
                        <tr>
                            <td>'.$student_id.'</td>
                            <td>'.$name.'</td>
                            <td>'.$username.'</td>
                            <td><button class="btn-1 approve">Approve</button></td>
                        </tr>
                        ';
        }
        $output .= '</tbody>';

        echo $output;
    }else {
        echo '<thead><tr><th>No Data Found</th></tr></thead>';
    }
?>