<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Meeting</title>
    <link rel="stylesheet" href="../css/main.css" />
    <script src="../libraries/jquery-3.2.1.min.js"></script>
</head>
<body>

    <?php require '../include/user-navbar.inc.php'; ?>

    <div class="detail-container">
        <div class="table-detail">
            <div class="header">
                <h2>Project Meeting</h2>
            </div>
            <div class="pagination">
            </div>
            <table id="project-list" class="table-1">
            </table>
        </div>
    </div>

    <div class="exit-background hidden meeting-list">
        <div class="form-container">
            <div class="table-detail">
                <div class="header">
                    <h2>Meeting</h2>
                    <img class="exit-btn" src="../assets/exit-2.svg" alt="exit">
                </div>
                <div class="project-detail">
                    <div><label>Project ID: </label><span id="project-id"></span></div>
                    <div><label>Project Title: </label><span id="project-title"></span></div>
                </div>
                <div class="nav-1">
                    <ul>
                        <li id="upcoming" class="btn-2 current">Upcoming Meetings</li>
                        <li id="history" class="btn-2">Meeting History</li>
                    </ul>
                </div>
                <table id="meeting-list" class="table-1">
                </table>
            </div>
        </div>
    </div>

    <div class="exit-background hidden add-meeting-container">
        <div class="form-container">
            <div class="wrap">
                <form class="add-meeting-form" method="POST" autocomplete="off">
                    <div class="header">
                        <h2>Create a new meeting</h2>
                        <img class="exit-btn" src="../assets/exit-2.svg" alt="exit">
                    </div>
                    <div class="project-detail">
                        <div><label>Project ID: </label><span id="project-id"></span></div>
                        <div><label>Project Title: </label><span id="project-title"></span></div>
                    </div>
                    <span class="message"><img src="../assets/error.svg"><span></span></span>
                    <div class="input-field">
                        <label>Date</label>
                        <input type="date" name="date">
                    </div>
                    <div class="input-field">
                        <label>Time</label>
                        <input type="time" name="time">
                    </div>
                    <div class="input-field">
                        <label>Description</label>
                        <textarea  name="description" rows="5" cols="50" placeholder="Describe your meeting here*"></textarea>
                    </div>

                    <div class="form-btn">
                        <input class="btn-1" type="submit" value="add">
                    </div>
                </form>
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
                url: '../php/supervisor/get_project_meeting.php',
                method: 'POST',
                data: {id:id, current:current, max:max},
                success: function(data) {
                    $('#project-list').html(data);
                    $.getScript('../js/pagination.js', function() {
                        update_pagination(current, max, table, condition, pagination_file);
                    });
                }
            });
        }

        function update_meeting_list(project_id, condition) {
            $.ajax({
                url: '../php/supervisor/get_meeting_list.php',
                method: 'POST',
                data: {project_id:project_id, condition:condition},
                success: function(data) {
                    $('#meeting-list').html(data);
                }
            });   
        }

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

        // View Meeting btn
        $(document).on('click', '.view', function() {
            var project_id = $(this).closest('tr').find('td:eq(0)').text();

            $("#project-id").html(project_id);
            $("#project-title").html($(this).closest('tr').find('td:eq(1)').text());

            update_meeting_list(project_id, '>=');
            $('#history').removeClass('current');
            $('#upcoming').addClass('current');

            $('.meeting-list').show();
        });

        // Upcoming & History btn
        $('#upcoming').on('click', function() {
            var project_id = $("#project-id").text();

            $('#history').removeClass('current');
            $('#upcoming').addClass('current');
            update_meeting_list(project_id, '>=');
        });

        $('#history').on('click', function() {
            var project_id = $("#project-id").text();

            $('#history').addClass('current');
            $('#upcoming').removeClass('current');
            update_meeting_list(project_id, '<');
        });

        var msg_element = $('.message');
        var message = $('.message span'); 

        // add meeting btn
        $(document).on('click', '.add', function() {
            var project_id = $(this).closest('tr').find('td:eq(0)').text();

            $(".add-meeting-container #project-id").html(project_id);
            $(".add-meeting-container #project-title").html($(this).closest('tr').find('td:eq(1)').text());

            msg_element.css('display', 'none');
            $('.add-meeting-container').show();
        });

        // add meeting form submit
        $('.add-meeting-form').on('submit', function() {
            msg_element.addClass('error');
            msg_element.removeClass('success');

            var date = $('input[name=date]');
            var time = $('input[name=time]');
            var descrip = $('textarea[name=description]');
            var project_id = $(".add-meeting-container #project-id").text();
            
            if(date.val() == '' || time.val() == '' || descrip.val() == '') {
                msg_element.css('display', 'block');
                message.html('Please complete the form');
                return false;
            }

            //msg_element.css('display', 'none');
            //alert("Date: " + date.val() + ", Time: " + time.val());

            $.ajax({
                url: '../php/supervisor/add_meeting.php',
                method: 'POST',
                data: {date:date.val(), time:time.val(), descrip:descrip.val(), id:project_id},
                success: function(data) {
                    if(data == 'true') {
                        msg_element.removeClass('error');
                        msg_element.addClass('success');
                        msg_element.css('display', 'block');
                        message.html('A new meeting is created');
                        $('.add-meeting-form')[0].reset();
                    }else {
                        msg_element.css('display', 'block');
                        message.html(data);
                    }
                }
            });

            return false;
        });

        $(document).ready(function() {
            update_table(current, max);
        });
    </script>
</body>
</html>