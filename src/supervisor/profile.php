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
                <h2>User Profile</h2>
            </div>
            <div class="user-profile">
                <!-- Test Data -->
                <label>Name: </label><span><?php session_start(); echo($_SESSION["name"]); ?></span>
            </div>
        </div>
    </div>
    <script src="../js/window_prompt.js"></script>
</body>
</html>