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
                <h2>Proposals</h2> <button class="btn-1" id="add-proposal">New Proposal</button>
            </div>
            <div class="nav-1">
                <ul>
                    <li id="pending-proposal" class="btn-2 current">All Proposals</li>
                    <li id="proposal-registration" class="btn-2">Proposal Registration</li>
                </ul>
            </div>
            <div class="pagination">
                <ul>
                    <li><span class="pagination-btn" value="prev">&larr; Prev</span></li>
                    <li><span class="pagination-btn" value="1">1</span></li>
                    <li>...</li>
                    <li><span class="pagination-btn">13</span></li>
                    <li><span class="pagination-btn current">14</span></li>
                    <li><span class="pagination-btn">15</span></li>
                    <li>...</li>
                    <li><span class="pagination-btn">20</span></li>
                    <li><span class="pagination-btn" value="next">&rarr; Next</span></li>
                </ul>
            </div>
            <table id="proposal-status" class="table-1">
            </table>
        </div>
    </div>

    <div class="exit-background add-proposal hidden">
        <div class="form-container">
            <div class="wrap">
                <form class="proposal-form" method="POST" autocomplete="off">
                    <div class="header">
                        <h2>Propose a new proposal</h2>
                        <img class="exit-btn" src="../assets/exit-2.svg" alt="exit">
                    </div>
                    <span class="message"><img src="../assets/error.svg"><span></span></span>
                    <div class="input-field">
                        <label>Title</label>
                        <input type="text" name="title" placeholder="Title*">
                    </div>
                    <div class="input-field">
                        <label>Description</label>
                        <textarea  name="description" rows="5" cols="50" placeholder="Write your description here*"></textarea>
                    </div>

                    <div class="form-btn">
                        <input class="btn-1" type="submit" value="propose">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="exit-background students-table hidden">
        <div class="form-container">
            <div class="table-detail">
                <div class="header">
                    <h2>Students Register</h2>
                    <img class="exit-btn" src="../assets/exit-2.svg" alt="exit">
                </div>
                <div class="project-detail">
                    <div><label>Project ID: </label><span id="project-id"></span></div>
                    <div><label>Project Title: </label><span id="project-title"></span></div>
                </div>
                <table id="student-list" class="table-1">
                </table>
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
        var condition = "WHERE supervisor = '" + id + "'";
        var pagination_file = '../php/pagination_update.php';

        // Buttons to switch tables
        $('#pending-proposal').on('click', function() {
            condition = "WHERE supervisor = '" + id + "'";
            current_table = 1;
            current = 1;

            $('#pending-proposal').addClass('current');
            $('#proposal-registration').removeClass('current');

            update_proposalTable(current, max);
            update_pagination(current, max, table, condition, pagination_file);
        });

        $('#proposal-registration').on('click', function() {
            condition = "WHERE supervisor = '" + id + "' AND status = 'Approved'";
            current_table = 2;
            current = 1;

            $('#pending-proposal').removeClass('current');
            $('#proposal-registration').addClass('current');

            update_proposalRegistration(current, max);
            update_pagination(current, max, table, condition, pagination_file);
        });

        // Display students
        $(document).on('click', '.view-student', function() {
            var project_id = $(this).closest('tr').find('td:eq(0)').text();

            $("#project-id").html(project_id);
            $("#project-title").html($(this).closest('tr').find('td:eq(1)').text());
            
            $.ajax({
                url: '../php/supervisor/get_proposal_students.php',
                method: 'POST',
                data: {id:project_id},
                success: function(data) {
                    $('#student-list').html(data);
                }
            });
            $('.students-table').show();
        });

        // Approve Button
        $(document).on('click', '.approve', function() {
            var student_id = $(this).closest('tr').find('td:eq(0)').text();
            var project_id = $('#project-id').text();
            //alert("Project ID: " + project_id + ", Student ID: " + student_id);

            $.ajax({
                url: '../php/supervisor/update_proposal_student.php',
                method: 'POST',
                data: {student_id:student_id, project_id:project_id},
                success: function(data) {
                    $('.students-table').hide();

                    update_proposalRegistration(current, max);
                    update_pagination(current, max, table, condition, pagination_file);
                }
            });
        });

        // Update proposal table
        function update_proposalTable(current, max) {
            $.ajax({
                url: '../php/supervisor/get_supervisor_proposal.php',
                method: 'POST',
                data: {id:id, current:current, max:max},
                success: function(data) {
                    $('#proposal-status').html(data);
                }
            });
        }

        // Update Proposal Registration Table
        function update_proposalRegistration(current, max) {
            $.ajax({
                url: '../php/supervisor/get_supervisor_proposal_registration.php',
                method: 'POST',
                data: {id:id, current:current, max:max},
                success: function(data) {
                    $('#proposal-status').html(data);
                }
            }); 
        }

        // Update pagination
        function update_pagination(current, max, table, condition, file) {
            $.ajax({
                url: file,
                method: 'POST',
                data: {current:current, max:max, table:table, condition:condition},
                success: function(data) {
                    $('.pagination').html(data);
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

                update_pagination(current, max, table, condition, pagination_file);
                if(current_table == 1)
                    update_proposalTable(current, max);
                else
                    update_proposalRegistration(current, max);
        });

        $(document).ready(function() {
            update_proposalTable(current, max);
            update_pagination(current, max, table, condition, pagination_file);
        });

        $('.proposal-form').on('submit', function() {
            msg_element.addClass('error');
            msg_element.removeClass('success');

            var title = $('input[name=title]');
            var descrip = $('textarea[name=description]');

            if(title.val() == '' || descrip.val() == '') {
                msg_element.css('display', 'block');
                message.html('Please complete the form');
                return false;
            }

            msg_element.css('display', 'none');

            $.ajax({
                url: '../php/supervisor/create_proposal.php',
                method: 'POST',
                data: {title:title.val(), descrip:descrip.val(), id:id},
                success: function(data) {
                    if(data == 'true') {
                        msg_element.removeClass('error');
                        msg_element.addClass('success');
                        msg_element.css('display', 'block');
                        message.html('A proposal is created');
                        $('.proposal-form')[0].reset();
                        
                        // update table
                        condition = "WHERE supervisor = '" + id + "'";
                        current_table = 1;
                        current = 1;

                        $('#pending-proposal').addClass('current');
                        $('#proposal-registration').removeClass('current');

                        update_proposalTable(current, max);
                        update_pagination(current, max, table, condition, pagination_file);
                    }else {
                        msg_element.css('display', 'block');
                        message.html(data);
                    }
                }
            });

            return false;
        });
    </script>
</body>
</html>