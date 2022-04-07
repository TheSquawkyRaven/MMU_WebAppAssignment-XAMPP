<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Welcome to FYP Planner</title>
    <link rel="stylesheet" href="css/main.css" />
</head>
<body>
    <?php
        include("menubar.php");
    ?>

    <section class="banner">
        <div class="container">
            <h1>Organise Your FYP Project Proposal Here</h1>
            <a href="signup.php" class="btn-1">GET STARTED</a>
        </div>
    </section>

    <?php
        include("php/connect.php");
        include("Admin/adminModerator.php");
        include("Admin/adminStudent.php");
        include("Admin/adminSupervisor.php");
    ?>

</body>
</html>