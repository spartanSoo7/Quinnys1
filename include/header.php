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
                <h1>Stock management</h1>
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
            <nav>
                <ul>
                    <li onMouseOver="this.style.backgroundColor='rgb(172, 131, 251)'; this.style.width='29%'"
                        onMouseOut="this.style.backgroundColor='rgb(182, 144, 255)'; this.style.width='14%'"
                        style="background-color: rgb(182, 144, 255);">
                        <a href='../home/index.php'>
                            Home
                        </a>
                    </li>
                    <li onMouseOver="this.style.backgroundColor='rgb(1,168,226)'; this.style.width='29%'"
                        onMouseOut="this.style.backgroundColor='#00BDFF'; this.style.width='14%'"
                        style="background-color: rgb(1, 168, 226); left: -30px">
                        <a href='../stockRestock/stockRestockItemsView.php'>
                            Restock
                        </a>
                    </li>
                    <li onMouseOver="this.style.backgroundColor='#03C73D'; this.style.width='29%'"
                        onMouseOut="this.style.backgroundColor='#06E047'; this.style.width='14%'"
                        style="background-color: #06E047; left: -60px">
                        <a href='../stockItems/stockItemsView.php'>
                            Stock Items
                        </a>
                    </li>
                    <li onMouseOver="this.style.backgroundColor='#E09F03'; this.style.width='29%'"
                        onMouseOut="this.style.backgroundColor='#FFB401'; this.style.width='14%'"
                        style="background-color: #FFB401; left: -90px">
                        <a href='../customer/customerView.php'>
                            Customers
                        </a>
                    </li>
                    <li onMouseOver="this.style.backgroundColor='#E23C02'; "
                        onMouseOut="this.style.backgroundColor='#FF4200';"
                        style="background-color: #FF4200; left: -120px; width: 29%;">
                        <a href='../stockType/stockTypeView.php'>
                            Stock Types
                        </a>
                    </li>
                </ul>
            </nav>

        </header>
        <div id = "wrapper">
            <main>
