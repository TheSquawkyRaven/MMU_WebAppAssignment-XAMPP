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
    <?php require '../include/user-navbar.inc.php'; ?>

    <button class="btn-1" id="form-popup">Plan Project</button>

    <div class="exit-background form-popup hidden">
        <div class="form-container">
            <div class="wrap">
                <form name="planning-form" action="php/projectPlanning.php" class="planning-form" method="POST" autocomplete="off">
                    <div class="header">
                        <h2>Project Planning</h2>
                        <img class="exit-btn" src="../assets/exit-2.svg" alt="exit">
                    </div>
                    <div class="input-field">
                        <label>Title*<span id="title-err" class="err message"><img src="../assets/error.svg"></span></label>
                        <input type="text" name="title" placeholder="Title*">
                    </div>
                    <div class="input-field">
                        <label>Description*<span id="desc-err" class="err message"><img src="../assets/error.svg"></span></label>
                        <textarea name="description" rows="5" cols="50" placeholder="Write your description here*"></textarea>
                    </div>

                    <input type="hidden" name="studentID" value="<?php echo($_SESSION["id"]); ?>">
                    <input type="hidden" name="supervisorID" value="<?php //TODO!! ?>">

                    <div class="form-btn">
                        <input class="btn-1" type="submit" value="propose">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $('#form-popup').on('click', function(){
            $('.err').hide();
            $('.form-popup').show();
        });
        $('.exit-btn').on('click', function(){
            $('.exit-background').hide();
        });
        $('.exit-background').on('click', function(e){
            var target = $(e.target);
            if(!target.is('.form-container')) return;
            else $('.exit-background').hide();
        });

        function validateForm(){
            let f = document.forms["planning-form"];
            let x = f["title"].value;
            let err = false;
            if (x == ''){
                $('#title-err').show();
                err = true;
            }
            x = f["description"].value;
            if (x == ''){
                $('#desc-err').show();
                err = true;
            }
            return !err;
        }

        $('.planning-form').on('submit', function(){
            return validateForm();
        });

    </script>

</body>
</html>