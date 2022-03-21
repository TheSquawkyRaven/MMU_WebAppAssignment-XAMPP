<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Proposal</title>
    <link rel="stylesheet" href="../css/main.css" />
    <script src="../libraries/jquery-3.2.1.min.js"></script>
</head>
<body>

    <?php require '../include/supervisor-navbar.inc.php'; ?>

    <div class="detail-container">
        <div class="table-detail">
            <div class="header">
                <h2>Project Planning</h2>
            </div>
            <div class="pagination">
            </div>
            <table id="project-list" class="table-1">
                <!-- Test Data -->
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Student</th>
                        <th>Student ID</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Face Recognisation System</td>
                        <td>Alvin</td>
                        <td>1191112345</td>
                        <td><button class="btn-1 view-planning">View</button></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Face Recognisation System</td>
                        <td>Alvin</td>
                        <td>1191112345</td>
                        <td><button class="btn-1 view-planning">View</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <div class="exit-background hidden">
        <div class="form-container">
            <div class="table-detail">
                <div class="header">
                    <h2>Planning</h2>
                    <img class="exit-btn" src="../assets/exit-2.svg" alt="exit">
                </div>
                <div class="project-detail">
                    <div><label>Project ID: </label><span id="project-id"></span></div>
                    <div><label>Project Title: </label><span id="project-title"></span></div>
                </div>
                <table id="planning-list" class="table-1">
                </table>
            </div>
        </div>
    </div>
    <script src="../js/window_prompt.js"></script>
    <script>
        var id = <?php echo $_SESSION['id'] ?>;

        var current = 1;
        var max = 10;
        var table = "project";
        var condition = "WHERE supervisor = '" + id + "' AND student IS NOT NULL";
        var pagination_file = '../php/pagination_update.php';

        function update_table(current, max) {
            $.ajax({
                url: '../php/supervisor/get_project_planning.php',
                method: 'POST',
                data: {id:id, current:current, max:max},
                success: function(data) {
                    $('#project-list').html(data);
                }
            });
        }

        // Pagination button interaction
        $(document).on('click', '.pagination-btn', function() {
            if($(this).attr('value') == 'prev') {
                if(current != 1) current--;
            }else if($(this).attr('value') == 'next'){
                last = $('.pagination ul li:nth-last-child(2)').text();
                if(current != last) current++;
            }else {
                current = $(this).attr('value');
            }
        
            $.getScript('../js/pagination.js', function() {
                update_pagination(current, max, table, condition, pagination_file);
            });
            update_table(current, max)
        });

        $(document).ready(function() {
            update_table(current, max);
            $.getScript('../js/pagination.js', function() {
                update_pagination(current, max, table, condition, pagination_file);
            });
        });

        //

        // Approve Reject Btn
        $(document).on('click', '.approve', function() {
            var planning_id = $(this).closest('tr').find('td:eq(0)').attr('value');
            var project_id = $('#project-id').text();

            update_planning('Approved', planning_id, project_id);
        });

        $(document).on('click', '.reject', function() {
            var planning_id = $(this).closest('tr').find('td:eq(0)').attr('value');
            var project_id = $('#project-id').text();

            update_planning('Rejected', planning_id, project_id);
        });       

        // View Planning btn
        $(document).on('click', '.view', function() {
            var project_id = $(this).closest('tr').find('td:eq(0)').text();

            $("#project-id").html(project_id);
            $("#project-title").html($(this).closest('tr').find('td:eq(1)').text());

            display_planning(project_id);
            $('.exit-background').show();
        });

        // Update Project 
        function update_planning(type, planning_id, project_id) {
            $.ajax({
                url: '../php/supervisor/update_planning.php',
                method: 'POST',
                data: {planning_id:planning_id, type:type},
                success: function(data) {
                    display_planning(project_id);
                }
            });  
        }

        // Display Project Planing table
        function display_planning(project_id) {
            $.ajax({
                url: '../php/supervisor/get_project_planning_detail.php',
                method: 'POST',
                data: {project_id:project_id},
                success: function(data) {
                    $('#planning-list').html(data);
                }
            });
        }
    </script>
</body>
</html>