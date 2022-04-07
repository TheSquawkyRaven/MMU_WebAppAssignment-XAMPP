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

    <div class='detail-container'>
        <div class='table-detail'>
            <div class='header space-bottom'>
                <h2>Pending Project Proposals</h2>
            </div>
            <table class="table-1">

                <form action="php/updateProposal.php" method="POST">

                    <?php
                        include("php/pendingProposals.php");
                    ?>

                </form>

            </table>

        </div>
    </div>

</body>
</html>