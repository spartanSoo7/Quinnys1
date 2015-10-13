<!--
--Page was built by Kane Wardle
-->
<?php
include '../include/head.php';
require("../include/securitycheck.php");
include '../include/header.php';
include_once("../include/databaselogin.php");
?>

    <div id = "backBtn">
        <a href="customerStockView.php" > Back </a>
    </div>

    <div id = "centerTitle">
        <h2>Customer Stock Level Details:</h2>
    </div>


<?php
    include 'customerStockDetails.php';
echo"<tr>
        <th style = 'background-color: #FF8944; text-align: center; border-right: 1px solid #333333; ";

    if ($CUSTOMER_ACTIVE == 1 && $active == 1)
    {
        echo "'>Stock & Customer are both Disabled";
    }
    else if($active == 1)
    {
        echo "'>Stock item is Disabled";
    }
    else if($CUSTOMER_ACTIVE == 1)
    {
        echo "'>Customer is Disabled";
    }
    else if ($HIRE_ACTIVE == 1)
    {
        echo " background-color: #FF6666;'>NOT Active<br/>
        <a href=customerStockActivate.php?HIRE_NUMBER=$HIRE_NUMBER style ='padding-bottom: 10px; margin: 5px; display: block;'> Enable? </a>";
    }
    else
    {
        echo "background-color: #59E059; '>Active
              <a href=customerStockDeactivate.php?HIRE_NUMBER=$HIRE_NUMBER  style ='padding-bottom: 10px; margin: 5px; display: block;'> Disable? </a>";
    }
?>

        </th>
        <td style='text-align: center;'>
            <a href=customerStockUpdate.php?HIRE_NUMBER=<?php echo $HIRE_NUMBER; ?> style ='padding-bottom: 10px; margin: 5px; display: block;'> Update </a>
        </td>
    </tr>
</table>
<?php

$conn->close();
include '../include/footer.php';
?>