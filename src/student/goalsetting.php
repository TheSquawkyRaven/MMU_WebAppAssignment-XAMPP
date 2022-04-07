<?php 
    session_start(); 
    require '../php/connect.php';

    $id =  $_SESSION['id'];
    $sql = $con->query("SELECT id FROM project WHERE student = '$id'");
    $project_id = 0;

    if($sql->num_rows > 0) {
        $result = $sql->fetch_assoc();
        $project_id = $result['id'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Goal Setting</title>
    <link rel="stylesheet" href="../css/main.css" />
    <link rel="stylesheet" href="../css/marksheet.css" />
    <script src="../libraries/jquery-3.2.1.min.js"></script>
</head>
<body>

    <?php require '../include/user-navbar.inc.php'; ?>

    <div class="detail-container">
        <div class="table-detail">
            <div class="header">
                <h2>Goal Setting</h2> <button class="btn-1" id="new-goal">New Goal</button>
            </div>
            <div class="pagination">
            </div>
            <table id="goal-setting" class="table-1">
            </table>
        </div>
    </div>

    <div class="exit-background add-proposal hidden">
        <div class="form-container">
            <div class="wrap">
                <form class="proposal-form" method="POST" autocomplete="off">
                    <div class="header">
                        <h2>Set a new goal</h2>
                        <img class="exit-btn" src="../assets/exit-2.svg" alt="exit">
                    </div>
                    <span class="message"><img src="../assets/error.svg"><span></span></span>
                    <div class="input-field">
                        <label>Name your task</label>
                        <input type="text" name="task" placeholder="task*">
                    </div>
                    <div class="input-field">
						<label>Category</label>
                        <input type="text" name="task" placeholder="category*">
                    </div>
                    <div class="input-field">
                        <label>Status</label>
                        <input type="radio" name="type" value="notstarted" checked />Not Started
						<input type="radio" name="type" value="inprogress" />In Progress
						<input type="radio" name="type" value="completed" />Completed
                    </div>
					<div class="input-field">
                        <label>Start Date</label>
                        <input type="date" name="date" class="hilightable required"/></p>
                    </div>
					<div class="input-field">
                        <label>End Date</label>
                        <input type="date" name="date" class="hilightable required"/></p>
                    </div>
                    <div class="form-btn">
                        <input class="btn-1" type="submit" value="propose">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="exit-background goal-form hidden">
        <div class="form-container">
            <div class="wrap">
                <form class="goal" method="POST" autocomplete="off">
                    <div class="header">
                        <h2>Create a new goal</h2>
                        <img class="exit-btn" src="../assets/exit-2.svg" alt="exit">
                    </div>
                    <span class="message"><img src="../assets/error.svg"><span></span></span>
                    <div class="input-field">
                        <label>Task</label>
                        <textarea  name="task" rows="5" cols="50" placeholder="Write your task here*"></textarea>
                    </div>
                    <div class="input-field">
                        <label>Category</label>
                        <input type="text" name="category" placeholder="Title*">
                    </div>
                    <div class="input-field">
                        <label>Start Date</label>
                        <input type="date" name="start">
                    </div>
                    <div class="input-field">
                        <label>End Date</label>
                        <input type="date" name="end">
                    </div>
                        <label style="font-weight: 600;">Status</label>
                    <div class="radio-field">
                        <label>Not Started</label><input type="radio" name="status" value="Not Started">
                        <label>In Progress</label><input type="radio" name="status" value="In Progress"> 
                        <label>Completed</label><input type="radio" name="status" value="Completed"> 
                    </div>

                    <div class="form-btn">
                        <input class="btn-1" type="submit" value="Create">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="exit-background edit-form hidden">
        <div class="form-container">
            <div class="wrap">
                <form class="edit-goal" method="POST" autocomplete="off">
                    <div class="header">
                        <h2>Edit a goal</h2>
                        <img class="exit-btn" src="../assets/exit-2.svg" alt="exit">
                    </div>
                    <div class="project-detail">
                        <div><label>Goal ID: </label><span id="goal-id"></span></div>
                    </div>
                    <span class="message"><img src="../assets/error.svg"><span></span></span>
                    <div class="input-field">
                        <label>Task</label>
                        <textarea  name="task" rows="5" cols="50" placeholder="Write your task here*"></textarea>
                    </div>
                    <div class="input-field">
                        <label>Category</label>
                        <input type="text" name="category" placeholder="Title*">
                    </div>
                    <div class="input-field">
                        <label>Start Date</label>
                        <input type="date" name="start">
                    </div>
                    <div class="input-field">
                        <label>End Date</label>
                        <input type="date" name="end">
                    </div>
                        <label style="font-weight: 600;">Status</label>
                    <div class="radio-field">
                        <label>Not Started</label><input type="radio" name="status2" value="Not Started">
                        <label>In Progress</label><input type="radio" name="status2" value="In Progress"> 
                        <label>Completed</label><input type="radio" name="status2" value="Completed"> 
                    </div>

                    <div class="form-btn">
                        <input class="btn-1" type="submit" value="Create">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="../js/window_prompt.js"></script>

    <script>
        var msg_element = $('.message');
        var message = $('.message span'); 
        var id = <?php echo $_SESSION['id'] ?>;
        var project_id = <?php  echo $project_id ?>;

        var current_table = 1;
        var current = 1;
        var max = 10;
        var table = "project_goal";
        var condition = "WHERE project = '" + project_id + "'";
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
                url: '../php/student/get_goal.php',
                method: 'POST',
                data: {id:id, project_id:project_id, current:current, max:max},
                success: function(data) {
                    $('#goal-setting').html(data);
                    $.getScript('../js/pagination.js', function() {
                        update_pagination(current, max, table, condition, pagination_file);
                    });
                }
            });
        }

        var msg_element = $('.message');
        var message = $('.message span'); 

        $('#new-goal').on('click', function() {
            msg_element.css('display', 'none');
            $('.goal-form').show();
        });

        $(document).ready(function() {
            update_table(current, max);
        });

        $('.goal').on('submit', function() {
            msg_element.addClass('error');
            msg_element.removeClass('success');

            var task = $('textarea[name=task]');
            var category = $('input[name=category]');
            var start = $('input[name=start]');
            var end = $('input[name=end]');
            var status = $('input[name=status]:checked');

            if(task.val() == '' || category.val() == '' || start.val() == '' || end.val() == ''|| status.val() == null) {
                msg_element.css('display', 'block');
                message.html('Please complete the form');
                return false;
            }

            msg_element.css('display', 'none');

            $.ajax({
                url: '../php/student/create_goal.php',
                method: 'POST',
                data: {id:project_id, task:task.val(), category:category.val(), start:start.val(), end:end.val(), status:status.val()},
                success: function(data) {
                    if(data == 'true') {
                        msg_element.removeClass('error');
                        msg_element.addClass('success');
                        msg_element.css('display', 'block');
                        message.html('A new goal is created');
                        $('.goal')[0].reset();

                        update_table(current, max);
                    }else {
                        msg_element.css('display', 'block');
                        message.html(data);
                    }
                }
            });

            return false;
        });

        // edit-btn
        $(document).on('click', '.edit', function() {
            msg_element.css('display', 'none');
            $('#goal-id').html($(this).closest('tr').find('td:eq(0)').text());

            var task = $(this).closest('tr').find('td:eq(1)').text();
            var category = $(this).closest('tr').find('td:eq(2)').text();
            var start = $(this).closest('tr').find('td:eq(3)').text();
            var end = $(this).closest('tr').find('td:eq(4)').text();
            var status = $(this).closest('tr').find('td:eq(5)').text();

            $('.edit-goal textarea[name=task]').val(task);
            $('.edit-goal input[name=category]').val(category);
            $('.edit-goal input[name=start]').val(start);
            $('.edit-goal input[name=end]').val(end);
            $('.edit-goal input[name=status]').val(status);

            var radio =  $(".edit-goal input:radio[name=status]");
            
            if(status == 'Not Started') {
                //alert("1");
                $(".edit-goal input:radio[name=status2][value='Not Started']").prop("checked", true);
            }else if(status == 'In Progress') {
                //alert("2");
                $(".edit-goal input:radio[name=status2][value='In Progress']").prop("checked", true);
            }else if(status == 'Completed') {
                //alert("3");
                $(".edit-goal input:radio[name=status2][value='Completed']").prop("checked", true);
            }
            $('.edit-form').show();
        });

        $('.edit-goal').on('submit', function() {
            msg_element.addClass('error');
            msg_element.removeClass('success');

            var task = $('.edit-goal textarea[name=task]');
            var category = $('.edit-goal input[name=category]');
            var start = $('.edit-goal input[name=start]');
            var end = $('.edit-goal input[name=end]');
            var status = $('.edit-goal input[name=status2]:checked');
            var goal_id = $('#goal-id').text();

            if(task.val() == '' || category.val() == '' || start.val() == '' || end.val() == ''|| status.val() == null) {
                msg_element.css('display', 'block');
                message.html('Please complete the form');
                return false;
            }
            //alert($('input[name=status2]:checked').val());
            msg_element.css('display', 'none');

            $.ajax({
                url: '../php/student/edit_goal.php',
                method: 'POST',
                data: {id:goal_id, task:task.val(), category:category.val(), start:start.val(), end:end.val(), status:status.val()},
                success: function(data) {
                    //alert(data);
                    if(data == 'true') {
                        update_table(current, max);
                        $('.edit-form').hide();
                    }else {
                        msg_element.css('display', 'block');
                        message.html(data);
                    }
                }
            });

            return false;   
        });
    </script>