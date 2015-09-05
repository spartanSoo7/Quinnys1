<?php
    include '../include/head.php';
    include '../include/header.php';
    require("../include/securitycheck.php");
?>

<h2>Hello</br>This is the home page</h2>

    <a href='../stockRestock/stockRestockItemsView.php'>
        <div id = "homeLink"
            onMouseOver="this.style.backgroundColor='rgb(1,168,226)'"
            onMouseOut="this.style.backgroundColor='#00BDFF'"
            style="background-color: #00BDFF;">
            Stock levels
        </div>
    </a>
    <a href='../stockItems/stockItemsView.php'>
        <div id = "homeLink"
            onMouseOver="this.style.backgroundColor='#03C73D'"
            onMouseOut="this.style.backgroundColor='#06E047'"
            style="background-color: #06E047;">
            Stock items
        </div>
    </a>
    <a href='../customer/customerView.php'>
        <div id = "homeLink"
             onMouseOver="this.style.backgroundColor='#E09F03'"
             onMouseOut="this.style.backgroundColor='#FFB401'"
             style="background-color: #FFB401;">
            Customers
        </div>
    </a>
    <a href='../stockType/stockTypeView.php'>
        <div id = "homeLink"
             onMouseOver="this.style.backgroundColor='#E23C02'"
             onMouseOut="this.style.backgroundColor='#FF4200'"
             style="background-color: #FF4200;">
            Stock types
        </div>
    </a>


<?php include '../include/footer.php';?>

<!--HTML 5 NUMBER validation isnt allowing decimals-->