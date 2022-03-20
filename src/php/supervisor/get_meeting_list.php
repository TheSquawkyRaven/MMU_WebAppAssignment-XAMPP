<?php
    require '../connect.php';

    $id = $con->real_escape_string($_POST['project_id']);
    $condition = $con->real_escape_string($_POST['condition']);

    $sql = $con->query("SELECT date, TIME_FORMAT(time, ".'"%h:%i %p"'.") "."as time, description FROM `project_meeting` WHERE project = '$id' AND date $condition DATE(NOW()) ORDER BY date, time ASC");
    echo "SELECT date, TIME_FORMAT(time, "."%h %i %s %p".") "."as time, description FROM `project_meeting` WHERE project = '$id' AND date $condition DATE(NOW()) ORDER BY date, time ASC";
    $output = '';

    $output .= '
                <thead>
                    <tr>
                        <td>Date</td>
                        <td>Time</td>
                        <td>Description</td>
                    </tr>
                </thead>
                ';
    $output .= '<tbody>';

    if($sql->num_rows > 0) {
        while($result = $sql->fetch_assoc()) {
            $date = $result['date'];
            $time = $result['time'];
            $description = $result['description'];

            $output .= '
                        <tr>
                            <td>'.$date.'</td>
                            <td>'.$time.'</td>
                            <td>'.$description.'</td>
                        </tr>
                        ';
        }

        $output .= '</tbody>';

        echo $output;
    }else {
        echo '<thead><tr><th>No Data Found</th></tr></thead>';
    }
?>