<?php
    include '../include/head.php';
    require("../include/securitycheck.php");
    include '../include/header.php';
    include_once("../include/databaselogin.php");
?>

<div id = "backBtn">
    <a href="customerView.php" > Back </a>
</div>

<div id = "centerTitle">
    <h2>Customer Details:</h2>
</div>


<?php
    include 'customerDetails.php';
echo"<tr>";

                    if ($active == 0)
                    {
                        echo "  <td style= 'background-color: #59E059; text-align: center; border-right: 1px solid #333333;'>Active</br>
                                <a href=\"customerDeactivate.php?CUSTOMER_ID=$id\" style ='padding-bottom: 10px; margin: 5px; display: block;'> Disable? </a>
                            </td>";
                    }
                    else if ($active == 1)
                    {
                        echo "<td style = 'background-color: #FF6666; text-align: center; border-right: 1px solid #333333;'>NOT Active<br/>
                                <a href=\"customerActivate.php?CUSTOMER_ID=$id\" style ='padding-bottom: 10px; margin: 5px; display: block;'> Enable? </a>
                            </td>";
                    }

                        echo "  <td style='text-align: center;'>
                                    <a href=\"customerUpdate.php?CUSTOMER_ID=$id\" style ='padding-bottom: 10px; margin: 5px; display: block;'> Update </a>
                                </td></tr></table>
                ";


    include '../include/footer.php';
?>