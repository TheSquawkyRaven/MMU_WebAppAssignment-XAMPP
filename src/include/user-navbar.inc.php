<?php
    if (!isset($_SESSION)){
        session_start();
    }
    if ($_SESSION == null){
        session_start();
    }
    $type = $_SESSION['type'];
    

    $supervisor_nav = [
        "proposal.php" => "Proposal",
        "project.php" => "Project",
        "meeting.php" => "Meeting",
        "marksheet.php" => "Marksheet",
    ];

    $student_nav = [
        "projectPlanningSelect.php" => "Project Planning",
        "projectRegistration.php" => "Project Registration",
        "goalsetting.php" => "Goal Setting",
        "marksheet.php" => "Marksheet"
    ];

    $moderator_nav = [

    ];

    if ($type == "supervisor"){
        $nav = $supervisor_nav;
    }
    elseif ($type == "student"){
        $nav = $student_nav;
    } 
    elseif ($type == "moderator"){
        $nav = $moderator_nav;
    }

?>
<div class="navbar">
        <div class="container">
            <a class="logo" href="index.php">FYP Planner</a>

                <nav class="desktop-nav">
                    <ul>
                        <li><a class="nav-btn" href="index.php">Home</a></li>
                        <?php
                            foreach ($nav as $link => $title){
                                echo("<li><a class='nav-btn' href='".$link."'>".$title."</a></li>");
                            }
                        ?>
                    </ul>
                </nav>

                <div class="right-menu desktop-nav">
                    <nav>
                        <ul>
                            <li><a href="profile.php"><img src="../assets/profile.svg" alt="user_profile"><?php echo($_SESSION['name']); ?></a></li>
                            <li><a href="../php/logout.php"><img src="../assets/logout.svg" alt="user_profile"></a></li>
                        </ul>
                    </nav>
                </div>
        </div>

        <img id="mobile-menu" class="mobile-menu" src="../assets/menu.svg"> 
        <div class="mobile-nav">
            <nav>
                <img id="mobile-exit" src="../assets/exit.svg">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <?php
                        foreach ($nav as $link => $title){
                            echo("<li><a class='nav-btn' href='".$link."'>".$title."</a></li>");
                        }
                    ?>
                    <li><a href="profile.php">Profile</a></li>
                    <li><a href="../php/logout.php">Logout</a></li>
                </ul>
            </nav>
        </div>
    </div>
    <script src="../js/open_nav.js"></script>
    <script>
        // Highlight current page
        var href = document.location.href;
        var pageName = href.substr(href.lastIndexOf('/') + 1);
        var currentIndex = 999;

        if(pageName == 'index.php' || pageName == '') currentIndex = 0;
        currentIndex = <?php
            $i = 1;
            $found = 0;
            foreach ($nav as $link => $title){
                if ($found == 0 && str_contains($link, str_replace(".php", "", basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING'])))){
                    echo $i;
                    $found = 1;
                }
                $i++;
            }
            $i--;
        ?>

        $('.desktop-nav ul li').each(function(i) {
                var index = $(this).index();
                //alert("Current: " + currentIndex + ", Index: " + index);
                if(currentIndex == index) {
                    $(this).addClass('current');
                }
        });
    </script>