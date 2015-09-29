<html>
    <body>
        <header>
            <a href="../home/index.php" style="float: left;">
                <img border="0" alt="Quinnys logo" height = "90px" src="../img/logo.png">
            </a>

            <script>

            jQuery(document).ready(function(){
            if (jQuery(window).width() < 800) {
                $("h1").remove();
            }
            });
            jQuery(window).resize(function () {
            if (jQuery(window).width() < 900) {
                $("h1").remove();
            }
            });

                </script>
            <div id = "Title">
                <h1>Stock Management</h1>
            </div>

            <div id = "headerRight">
                <?php
                    if (session_status() == PHP_SESSION_NONE) {
                        session_start();
                    }
                    if (isset($_SESSION['username']))
                    {
                        echo "<a href='../login/logout.php' class = 'logOut'>Log out</a></br>";
                        echo "<p>Welcome: " . $_SESSION["username"] . "</p></br>";
                    }
                    else
                    {
                        echo "<a href = '../login/adminLogin.php'>Login</a></br>";
                        echo "<p>You are not logged  in </p>";
                    }
                    ?>
            </div>



            

                    <?php
                    $url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];


                    if (strpos($url,'home') !== false) {
                        include '../nav/home.html';
                    }
                    else if (strpos($url,'RestockItems') !== false){
                        include '../nav/stockRestock.html';
                    }
                    else if (strpos($url,'stock') !== false){
                        include '../nav/stockItems.html';
                    }
                    else if (strpos($url,'customer') !== false){
                        include '../nav/customer.html';
                    }
                    else if (strpos($url,'hire') !== false){
                        include '../nav/hire.html';
                    }
                    ?>






        </header>
        <div id = "wrapper">