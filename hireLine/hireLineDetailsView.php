<?php
include '../include/head.php';
require("../include/securitycheck.php");
include '../include/header.php';
include_once("../include/databaselogin.php");
?>

    <div id = "backBtn">
        <a href="hireLineView.php" > Back </a>
    </div>

    <div id = "centerTitle">
        <h2>Hire lines Details:</h2>
    </div>


<?php
    include 'hireLineDetails.php';
echo"<tr>
        <th style = 'background-color: #FF8944; text-align: center; border-right: 1px solid #333333; width: 60%; ";

    if ($CUSTOMER_ACTIVE == 1 && $active == 1)
    {
        echo "'>Stock & Customer are both Disabled after this order has taken place
             <a href=../stockItems/stockItemsActivate.php?STOCK_ID=$STOCK_ID style ='padding-bottom: 10px; margin: 5px; display: block;'> Enable Stock? </a>
             <a href=../customer/customerActivate.php?CUSTOMER_ID=$CUSTOMER_ID style ='padding-bottom: 10px; margin: 5px; display: block;'> Enable Customer? </a>";

    }
    else if($active == 1)
    {
        echo "'>Stock item has been Disabled since this order
        <a href=../stockItems/stockItemsActivate.php?STOCK_ID=$STOCK_ID style ='padding-bottom: 10px; margin: 5px; display: block;'> Enable Stock? </a>";
    }
    else if($CUSTOMER_ACTIVE == 1)
    {
        echo "'>Customer has been Disabled since this order</br>
             <a href=../customer/customerActivate.php?CUSTOMER_ID=$CUSTOMER_ID style ='padding-bottom: 10px; margin: 5px; display: block;'> Enable Customer? </a>";
    }
    else if ($HIRE_ACTIVE == 1)
    {
        echo " background-color: #FF6666;'>These customer stock levels have been disabled<br/>
        <a href=../customerStock/customerStockActivate.php?HIRE_NUMBER=$HIRE_NUMBER style ='padding-bottom: 10px; margin: 5px; display: block;'> Enable? </a>";
    }
    else{
        echo "background-color: #59E059;'>Stock/ Customer / both are still enabled";
    }
?>

        </th>
        <td style='text-align: center;'>
            <a href=hireLineUpdate.php?HIRE_LINE_NUMBER=<?php echo $HIRE_LINE_NUMBER; ?> style ='padding-bottom: 10px; margin: 5px; display: block;'>Update</a>
        </td>
    </tr>
</table>
<?php

$conn->close();
include '../include/footer.php';
?>