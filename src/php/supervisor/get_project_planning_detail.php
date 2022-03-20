<?php
    require '../connect.php';

    $project_id = $_POST['project_id'];

    $sql = $con->query("SELECT * FROM project_planning WHERE project = '$project_id'");

    $output = '';

    $output .= '
                <thead>
                    <tr>
                        <td>Weeks</td>
                        <td>Descriptions</td>
                    </tr>
                </thead>
                ';
    $output .= '<tbody>';

    if($sql->num_rows > 0) {
        while($result = $sql->fetch_assoc()) {
            $id = $result['id'];
            $week = $result['week'];
            $descrip = $result['description'];
            $status = $result['status'];
            $output2 = '';

            if($status == 'Pending')
                $output2 = '<td><button class="btn-1 approve">Approve</button></td>
                            <td><button class="btn-2 reject">Reject</button></td>';
            else if($status == 'Approved') $output2 = '<td>&#10003;</td>';
            else if($status == 'Rejected') $output2 = '<td>&#10005;</td>';

            $output .= '
                        <tr>
                            <td value="'.$id.'">'.$week.'</td>
                            <td>'.$descrip.'</td>
                            '.$output2.'
                        </tr>
                        ';
        }

        $output .= '</tbody>';

        echo $output;
    }else {
        echo '<thead><tr><th>No Data Found</th></tr></thead>';
    }
?>