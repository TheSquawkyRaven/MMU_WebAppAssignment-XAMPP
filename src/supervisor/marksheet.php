<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Marksheet</title>
    <link rel="stylesheet" href="../css/main.css" />
    <script src="../libraries/jquery-3.2.1.min.js"></script>
</head>
<body>

    <?php require '../include/user-navbar.inc.php'; ?>

    <div class="detail-container">
        <div class="table-detail">
            <div class="header">
                <h2>Project Marksheet</h2>
            </div>
            <div class="nav-1">
                <ul>
                    <li id="current" class="btn-2 current">Current Project</li>
                    <li id="history" class="btn-2">History</li>
                </ul>
            </div>
            <div class="pagination">
            </div>
            <table id="project-list" class="table-1">
            </table>
        </div>
    </div>

    <div class="exit-background hidden">
        <div class="form-container">
            <div class="wrap">
                <form class="marksheet-form" method="POST" autocomplete="off">
                    <div class="header">
                        <h2>Marksheet</h2>
                        <img class="exit-btn" src="../assets/exit-2.svg" alt="exit">
                    </div>
                    <div class="project-detail">
                        <div><label>Project ID: </label><span id="project-id"></span></div>
                        <div><label>Project Title: </label><span id="project-title"></span></div>
                    </div>
                    <span class="message"><img src="../assets/error.svg"><span></span></span>
                    <div class="input-field">
                        <label>Technical writing</label>
                        <input type="number" name="mark1" min="0" max="100">
                    </div>
                    <div class="input-field">
                        <label>Analysis</label>
                        <input type="number" name="mark2" min="0" max="100">
                    </div>
                    <div class="input-field">
                        <label>Design</label>
                        <input type="number" name="mark3" min="0" max="100">
                    </div>
                    <div class="input-field">
                        <label>Implementation</label>
                        <input type="number" name="mark4" min="0" max="100">
                    </div>
                    <div class="input-field">
                        <label>Evaluation</label>
                        <input type="number" name="mark5" min="0" max="100">
                    </div>
                    <div class="input-field">
                        <label>Comment</label>
                        <textarea  name="comment" rows="5" cols="50" placeholder="Write your comment here*"></textarea>
                    </div>

                    <div class="form-btn">
                        <input class="btn-1" type="submit" value="mark">
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
        var status = "Approved";
        var condition = "WHERE supervisor = '" + id + "' AND student IS NOT NULL AND status = '" + status + "'";
        var pagination_file = '../php/pagination_update.php';

        function update_table(current, max) {
            $.ajax({
                url: '../php/supervisor/get_project_marksheet.php',
                method: 'POST',
                data: {id:id, current:current, max:max, status:status},
                success: function(data) {
                    $('#project-list').html(data);
                    $.getScript('../js/pagination.js', function() {
                        update_pagination(current, max, table, condition, pagination_file);
                    });
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

        var msg_element = $('.message');
        var message = $('.message span'); 

        $(document).on('click', '.mark', function() {
            msg_element.css('display', 'none');
            var project_id = $(this).closest('tr').find('td:eq(0)').text();

            $("#project-id").html(project_id);
            $("#project-title").html($(this).closest('tr').find('td:eq(1)').text());

            $('.exit-background').show();
        });

        // Current Project & History btn
        $('#current').on('click', function() {
            var project_id = $("#project-id").text();

            $('#history').removeClass('current');
            $('#current').addClass('current');
            status = "Approved";
            condition = "WHERE supervisor = '" + id + "' AND student IS NOT NULL AND status = '" + status + "'";
            update_table(current, max);
        });

        $('#history').on('click', function() {
            var project_id = $("#project-id").text();

            $('#history').addClass('current');
            $('#current').removeClass('current');
            status = "Archieved";
            condition = "WHERE supervisor = '" + id + "' AND student IS NOT NULL AND status = '" + status + "'";
            update_table(current, max);
        });

        // marksheet form submit
        $('.marksheet-form').on('submit', function() {
            msg_element.addClass('error');
            msg_element.removeClass('success');

            var mark1 = $('input[name=mark1]');
            var mark2 = $('input[name=mark2]');
            var mark3 = $('input[name=mark3]');
            var mark4 = $('input[name=mark4]');
            var mark5 = $('input[name=mark5]');
            var comment = $('textarea[name=comment]');

            var project_id = $("#project-id").text();
            
            if(mark1.val() == '' || mark2.val() == '' || mark3.val() == '' || mark4.val() == '' || mark5.val() == '' || comment.val() == '') {
                msg_element.css('display', 'block');
                message.html('Please complete the form');
                return false;
            }

            $.ajax({
                url: '../php/supervisor/add_marksheet.php',
                method: 'POST',
                data: {mark1:mark1.val(), mark2:mark2.val(), mark3:mark3.val(), mark4:mark4.val(), mark5:mark5.val(), comment:comment.val(), id:project_id},
                success: function(data) {
                    if(data == 'true') {
                        $('.marksheet-form')[0].reset();

                        $('.exit-background').hide();
                        update_table(current, max);
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