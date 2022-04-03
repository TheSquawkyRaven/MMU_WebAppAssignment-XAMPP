<?php
    require '../connect.php';

    $project_id = $_POST['project_id'];

    $sql = $con->query(
        "SELECT project_planning.id, project_planning.title, project_planning.description, project_planning.fromdate, project_planning.todate, project_planning.status
        FROM project_planning WHERE project = '$project_id'
    ");

    $output = '';

    $output .= '
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
                ';
    $output .= '<tbody>';

    if($sql->num_rows > 0) {
        $i = 1;
        while($result = $sql->fetch_assoc()) {
            $id = $result['id'];
            $title = $result['title'];
            $desc = $result['description'];
            $fromDate = $result['fromdate'];
            $toDate = $result['todate'];
            $status = $result['status'];
            $output2 = '';

            if($status == 'Pending')
                $output2 = '<td><button class="btn-1 approve">Approve</button></td>
                            <td><button class="btn-2 reject">Reject</button></td>';
            else if($status == 'Approved') $output2 = '<td>&#10003;</td>';
            else if($status == 'Rejected') $output2 = '<td>&#10005;</td>';

            $output .= '
                        <tr>
                            <td value="'.$id.'">'.$i.'</td>
                            <td>'.$title.'</td>
                            <td>'.$desc.'</td>
                            <td>'.$fromDate.'</td>
                            <td>'.$toDate.'</td>
                            <td>'.$status.'</td>
                            '.$output2.'
                        </tr>
                        ';
            $i++;
        }

        $output .= '</tbody>';

        echo $output;
    }else {
        echo '<thead><tr><th>No Data Found</th></tr></thead>';
    }
?>