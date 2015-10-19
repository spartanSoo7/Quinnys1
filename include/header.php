<html>
    <body>
        <header>
<!--
--Header was built by Kane Wardle
-->
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


                    if (strpos($url,'Level') !== false){//stock levels
                        include '../nav/stockLevels.html';
                    }
                    else if (strpos($url,'customerStock') !== false){//stock levels
                        include '../nav/stockLevels.html';
                    }
                    else if (strpos($url,'stock') !== false){   //stock
                        include '../nav/stockItems.html';
                    }
                    else if (strpos($url,'customer') !== false){    //customer
                        include '../nav/customer.html';
                    }
                    else if (strpos($url,'hire') !== false){        //hire
                        include '../nav/hire.html';
                    }
                    else if (strpos($url,'return') !== false){        //Return
                        include '../nav/return.html';
                    }
                    else{       //else all options tab
                        include '../nav/home.html';
                    }
                    ?>


        </header>
        <div id = "wrapper">