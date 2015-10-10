<?php
    include '../include/head.php';
    include '../include/header.php';
    require("../include/securitycheck.php");
?>

<h1 style="text-align: center; ">All options</h1>

<div class = "homeLine">
    <h2>
        Stock Levels
    </h2>


    <a href='../stockItems/stockItemsStockLevels.php'>
        <div id = "homeLink"
             onMouseOver="this.style.backgroundColor='#03C73D'"
             onMouseOut="this.style.backgroundColor='#06E047'"
             style="background-color: #06E047;  font-size: 22px;">
            Total Levels and Restock
        </div>
    </a>

    <a href='../stockRestock/stockRestockView.php'>
        <div id = "homeLink"
             onMouseOver="this.style.backgroundColor='rgb(1,168,226)';"
             onMouseOut="this.style.backgroundColor='#00BDFF';"
             style="background-color: #00BDFF; font-size: 20px;">
            View/ Update Restock Records
        </div>
    </a>

    <a href='../customerStock/customerStockView.php'>
        <div id = "homeLink"
             onMouseOver="this.style.backgroundColor='#E09F03'"
             onMouseOut="this.style.backgroundColor='#FFB401'"
             style="background-color: #FFB401; font-size: 22px;">
            Customer Stock Levels
        </div>
    </a>

</div>

    <div class = "homeLine">
        <h2>
            Hiring Out Stock
        </h2>
        <a href='../hireLine/hireLineAdd.php'>
            <div id = "homeLink"
                 onMouseOver="this.style.backgroundColor='#03C73D'"
                 onMouseOut="this.style.backgroundColor='#06E047'"
                 style="background-color: #06E047;">
                New Hire
            </div>
        </a>

        <a href='../hireLine/hireLineView.php'>
            <div id = "homeLink"
                 onMouseOver="this.style.backgroundColor='rgb(1,168,226)';"
                 onMouseOut="this.style.backgroundColor='#00BDFF';"
                 style="background-color: #00BDFF; font-size: 20px;">
                View/ Update/ Delete Hiring Records
            </div>
        </a>
        <p style="width: 100%; float: left; ">*Delete hire record is under hire details</p>
    </div>

    <div class = "homeLine">
        <h2>
            Returning Stock
        </h2>

        <a href='#'>
            <div id = "homeLink"
                 onMouseOver="this.style.backgroundColor='#03C73D'"
                 onMouseOut="this.style.backgroundColor='#06E047'"
                 style="background-color: #06E047;">
                New Return
            </div>
        </a>

        <a href='#'>
            <div id = "homeLink"
                 onMouseOver="this.style.backgroundColor='rgb(1,168,226)';"
                 onMouseOut="this.style.backgroundColor='#00BDFF';"
                 style="background-color: #00BDFF; font-size: 22px;">
                View Returning Records
            </div>
        </a>

    </div>

<div class = "homeLine">
    <h2>
        Damaged Stock
    </h2>

    <a href='#'>
        <div id = "homeLink"
             onMouseOver="this.style.backgroundColor='#03C73D'"
             onMouseOut="this.style.backgroundColor='#06E047'"
             style="background-color: #06E047;  font-size: 20px;">
            Remove Damaged Stock
        </div>
    </a>

    <a href='#'>
        <div id = "homeLink"
             onMouseOver="this.style.backgroundColor='rgb(1,168,226)';"
             onMouseOut="this.style.backgroundColor='#00BDFF';"
             style="background-color: #00BDFF; font-size: 22px;">
            View Damaged Records
        </div>
    </a>

</div>

<div class = "homeLine">
    <h2>
        Billing
    </h2>

    <a href='../hireLine/hireLineViewDate.php'>
        <div id = "homeLink"
             onMouseOver="this.style.backgroundColor='#03C73D'"
             onMouseOut="this.style.backgroundColor='#06E047'"
             style="background-color: #06E047;  font-size: 22px;">
            Bill a Customer
        </div>
    </a>



</div>

<div class = "homeLine">
    <h2>
        Customers
    </h2>
    <a href='../customer/customerAdd.php'>
        <div id = "homeLink"
             onMouseOver="this.style.backgroundColor='#03C73D'"
             onMouseOut="this.style.backgroundColor='#06E047'"
             style="background-color: #06E047;">
            New Customer
        </div>
    </a>

    <a href='../customer/customerView.php'>
        <div id = "homeLink"
             onMouseOver="this.style.backgroundColor='rgb(1,168,226)';"
             onMouseOut="this.style.backgroundColor='#00BDFF';"
             style="background-color: #00BDFF; font-size: 20px;">
            View/ Update/ Enable/ Disable Customers
        </div>
    </a>

    <a href='../customerStock/customerStockView.php'>
        <div id = "homeLink"
             onMouseOver="this.style.backgroundColor='#E09F03'"
             onMouseOut="this.style.backgroundColor='#FFB401'"
             style="background-color: #FFB401; font-size: 22px;">
            Customer Stock Levels
        </div>
    </a>

</div>

<div class = "homeLine">
    <h2>
        Stock
    </h2>
    <a href='../stockItems/stockItemsAdd.php'>
        <div id = "homeLink"
             onMouseOver="this.style.backgroundColor='#03C73D'"
             onMouseOut="this.style.backgroundColor='#06E047'"
             style="background-color: #06E047;">
            New Stock Item
        </div>
    </a>

    <a href='../stockItems/stockItemsView.php'>
        <div id = "homeLink"
             onMouseOver="this.style.backgroundColor='rgb(1,168,226)';"
             onMouseOut="this.style.backgroundColor='#00BDFF';"
             style="background-color: #00BDFF; font-size: 20px;">
            View/ Update/ Enable/ Disable Stock
        </div>
    </a>

    <a href='../stockType/stockTypeAdd.php'>
        <div id = "homeLink"
             onMouseOver="this.style.backgroundColor='#E09F03'"
             onMouseOut="this.style.backgroundColor='#FFB401'"
             style="background-color: #FFB401; ">
            Add Stock Type
        </div>
    </a>

    <a href='../stockType/stockTypeView.php'>
        <div id = "homeLink"
             onMouseOver="this.style.backgroundColor='rgb(239, 104, 40)'"
             onMouseOut="this.style.backgroundColor='rgb(255, 112, 44)'"
             style="background-color: rgb(255, 112, 44); font-size: 20px;">
            View/ Update/ Enable/ Disable Stock Types
        </div>
    </a>

    <a href='../stockItems/stockItemsStockLevels.php'>
        <div id = "homeLink"
             onMouseOver="this.style.backgroundColor='rgb(172, 131, 251)'"
             onMouseOut="this.style.backgroundColor='rgb(182, 144, 255)'"
             style="background-color: rgb(182, 144, 255);  font-size: 22px;">
            Total Levels and Restock
        </div>
    </a>

</div>
<!--


    <a href='../stockRestock/stockRestockView.php'>
        <div id = "homeLink"
            onMouseOver="this.style.backgroundColor='rgb(1,168,226)';"
            onMouseOut="this.style.backgroundColor='#00BDFF';"
            style="background-color: rgb(1, 168, 226); font-size: 22px;">
            Total Stock levels/ Restock
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
    <a href='../customerStock/customerStockView.php'>
        <div id = "homeLink"
         onMouseOver="this.style.backgroundColor='rgb(245, 90, 153)'"
         onMouseOut="this.style.backgroundColor='rgb(247, 108, 164)'"
         style="background-color: rgb(247, 108, 164); font-size: 21px; ">
            Customer Stock Levels
        </div>
    </a>
    <a href='../hireLine/hireLineView.php'>
        <div id = "homeLink"
            onMouseOver="this.style.backgroundColor='rgb(245, 90, 153)'"
            onMouseOut="this.style.backgroundColor='rgb(247, 108, 164)'"
         style="background-color: rgb(247, 108, 164); font-size: 21px; ">
        Hire lines
        </div>
    </a>
    <a href='../hireLine/hireLineViewDate.php'>
        <div id = "homeLink"
             onMouseOver="this.style.backgroundColor='rgb(245, 90, 153)'"
             onMouseOut="this.style.backgroundColor='rgb(247, 108, 164)'"
             style="background-color: rgb(247, 108, 164); font-size: 21px; ">
             Billing
        </div>
    </a>-->


<?php include '../include/footer.php';?>

<!--HTML 5 NUMBER validation isnt allowing decimals-->