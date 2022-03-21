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
    <?php require '../include/student-navbar.inc.php'; ?>

	<section>
        <div class="summary">
            <h2>Project Assignment</h2>

            <table class="table-1">
                <table class="table-1">
                    <!-- Test Data -->
                    <thead>
                        <tr>
                            <th>Project Title</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </table>
        </div>
    </section>
    
    <section>
        <div class="summary">
            <h2>Recent Planning</h2>
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
                </tbody>
            </table>
        </div>
    </section>

    <section>
        <div class="summary">
            <h2>Goal Setting</h2>

            <table class="table-1">
                <table class="table-1">
                    <!-- Test Data -->
                    <thead>
                        <tr>
                            <th>Task Name</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Start Date</th>
							<th>End Date</th>
                        </tr>
                    </thead>
                    <tbody>
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