<?php 
    session_start(); 
    require '../php/connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Home</title>
    <link rel="stylesheet" href="../css/main.css" />
    <script src="../libraries/jquery-3.2.1.min.js"></script>
</head>
<body>
    <?php require '../include/supervisor-navbar.inc.php'; ?>

    
    <section>
        <div class="summary">
            <h2>Recent Proposals</h2>
            <table class="table-1">
                <!-- Test Data -->
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $user_id = $_SESSION['id'];

                        $sql = $con->query("SELECT * FROM project WHERE supervisor = '$user_id' ORDER BY id DESC LIMIT 0, 3");
                        if($sql->num_rows > 0) {
                            while($result = $sql->fetch_assoc()) {
                                $id = $result['id'];
                                $title = $result['title'];
                                $status = $result['status'];

                                echo '
                                    <tr>
                                        <td>'.$id.'</td>
                                        <td>'.$title.'</td>
                                        <td>'.$status.'</td>
                                    </tr>
                                    ';
                            }
                        }else {
                            echo '<tr><td></td></tr>
                                <tr>
                                    <td>No Data Found. <a href="proposal.php" class="btn-2">Go To Proposal</a></td>
                                </tr>
                                ';
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </section>

    <section>
        <div class="summary">
            <h2>Upcoming Meetings</h2>

            <table class="table-1">
                <table class="table-1">
                    <!-- Test Data -->
                    <thead>
                        <tr>
                            <th>Project Title</th>
                            <th>Date</th>
                            <th>Time</th>
                            <th>Event</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            // SELECT project.title, date, TIME_FORMAT(time, '%h %i %s %p') as time, project_meeting.description FROM project_meeting INNER JOIN project ON project_meeting.project = project.id WHERE project.supervisor = '1' AND date >= DATE(NOW()) ORDER BY date, time ASC LIMIT 0, 3
                            $sql = $con->query("SELECT project.title, date, TIME_FORMAT(time, '%h %i %s %p') as time, project_meeting.description FROM project_meeting INNER JOIN project ON project_meeting.project = project.id WHERE project.supervisor = '$user_id' AND date >= DATE(NOW()) ORDER BY date, time ASC LIMIT 0, 3");
                            if($sql->num_rows > 0) {
                                while($result = $sql->fetch_assoc()) {
                                    $title = $result['title'];
                                    $date = $result['date'];
                                    $time = $result['time'];
                                    $descrip = $result['description'];
    
                                    echo '
                                        <tr>
                                            <td>'.$title.'</td>
                                            <td>'.$date.'</td>
                                            <td>'.$time.'</td>
                                            <td>'.$descrip.'</td>
                                        </tr>
                                        ';
                                }
                            }else {
                                echo '<tr><td></td></tr>
                                    <tr>
                                        <td>No Data Found. <a href="meeting.php" class="btn-2">Go To Meeting</a></td>
                                    </tr>
                                    ';
                            } 
                        ?>
                    </tbody>
                </table>
            </table>
        </div>
    </section>
<!--
    <section>
        <div class="summary">
            <h2>Recent Projects</h2>
            <table class="table-1">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Student</th>
                        <th>Progress</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Face Recognisation System</td>
                        <td>Alvin</td>
                        <td><progress id="file" value="32" max="100"> 32% </progress></td>
                    </tr>
                    <tr>
                        <td>Face Recognisation System</td>
                        <td>Alex</td>
                        <td><progress id="file" value="50" max="100"> 32% </progress></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
                        -->
</body>
</html>