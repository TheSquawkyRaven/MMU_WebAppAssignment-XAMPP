<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Project Registration</title>
    <link rel="stylesheet" href="../css/main.css" />
    <script src="../libraries/jquery-3.2.1.min.js"></script>
</head>
<body>

    <?php require '../include/user-navbar.inc.php'; ?>

    <div class="detail-container">
        <div class="table-detail">
            <div class="header">
                <h2>Project Registration</h2>
            </div>
            <div class="pagination">
            </div>
            <table id="project" class="table-1">
            </table>
        </div>
    </div>

    <div class="exit-background detail-form hidden">
        <div class="form-container">
            <div class="table-detail">
                <div class="header">
                    <h2>Project Details</h2>
                    <img class="exit-btn" src="../assets/exit-2.svg" alt="exit">
                </div>
                <div class="project-detail">
                    <div><label>Project ID: </label><span id="project-id"></span></div>
                    <div><label>Project Title: </label><span id="project-title"></span></div>
                    <div><label>Project Description: </label><span id="project-description"></span></div>
                </div>
                <center><button id="register-btn" class="btn-1">Register</button></center>
            </div>
        </div>
    </div>

    <script src="../js/window_prompt.js"></script>

    <script>
        var msg_element = $('.message');
        var message = $('.message span'); 
        var id = <?php echo $_SESSION['id'] ?>;

        var current_table = 1;
        var current = 1;
        var max = 10;
        var table = "project";
        var condition = "WHERE status = 'Approved' AND project.student IS NULL";
        var pagination_file = '../php/pagination_update.php';

        $(document).on('click', '.pagination-btn', function() {
            if($(this).attr('value') == 'prev') {
                if(current != 1) current--;
            }else if($(this).attr('value') == 'next'){
                last = $('.pagination ul li:nth-last-child(2)').text();
                if(current != last) current++;
            }else {
                current = $(this).attr('value');
            }

            update_table(current, max)
        });

        function update_table(current, max) {
            $.ajax({
                url: '../php/student/get_project_registration.php',
                method: 'POST',
                data: {id:id, current:current, max:max},
                success: function(data) {
                    $('#project').html(data);
                    $.getScript('../js/pagination.js', function() {
                        update_pagination(current, max, table, condition, pagination_file);
                    });
                }
            });
        }

        $(document).on('click', '.detail', function() {
            var project_id = $(this).closest('tr').find('td:eq(0)').text();
            var description = $(this).closest('tr').find('td:eq(4)').text();

            $("#project-id").html(project_id);
            $("#project-title").html($(this).closest('tr').find('td:eq(1)').text());
            $("#project-description").html(description);

            $('.detail-form').show();
        });

        //Register button
        $(document).on('click', '#register-btn', function() {
            var project_id = $("#project-id").text();

            $.ajax({
                url: '../php/student/project_register.php',
                method: 'POST',
                data: {project_id, id:id},
                success: function(data) {
                    if(data == 'true') {
                        update_table(current, max);
                        $('.detail-form').hide();
                    } else
                        alert(data);
                }
            });
        });

        $(document).ready(function () {
            update_table(current, max);
        });
    </script>