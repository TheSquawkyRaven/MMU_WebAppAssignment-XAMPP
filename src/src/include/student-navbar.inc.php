<div class="navbar">
        <div class="container">
            <a class="logo" href="index.php">FYP Planner</a>

                <nav class="desktop-nav">
                    <ul>
                        <li><a class="nav-btn" href="index.php">Home</a></li>
                        <li><a class="nav-btn" href="project.php">Project</a></li>
                        <li><a class="nav-btn" href="planning.php">Planning</a></li>
                        <li><a class="nav-btn" href="goalsetting.php">Goal Setting</a></li>
                        <li><a class="nav-btn" href="marksheet.php">Marksheet</a></li>           
                    </ul>
                </nav>

                <div class="right-menu desktop-nav">
                    <nav>
                        <ul>
                            <li><a href="profile.php"><img src="../assets/profile.svg" alt="user_profile"></a></li>
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
                    <li><a href="project.php">Project</a></li>
                    <li><a href="planning.php">Planning</a></li>
                    <li><a href="goalsetting.php">Goal Setting</a></li>
                    <li><a href="marksheet.php">Marksheet</a></li> 
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
        else if(pageName == 'project.php') currentIndex = 1;
        else if(pageName == 'planning.php') currentIndex = 2;
        else if(pageName == 'goalsetting.php') currentIndex = 3;
        else if(pageName == 'marksheet.php') currentIndex = 4;

        $('.desktop-nav ul li').each(function(i) {
                var index = $(this).index();

                if(currentIndex == index) {
                    $(this).addClass('current');
                }
        });
    </script>