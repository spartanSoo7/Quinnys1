<html>
    <body>
        <header>
            <a href="../home/index.php" style="float: left;">
                <img border="0" alt="Quinnys logo" height = "90px" src="../img/logo.png">
            </a>
            <div id = "Title">
                <h1>Stock management</h1>
            </div>

            <div id = headerRight>
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
        </header>
        <div id = "wrapper">
            <main>