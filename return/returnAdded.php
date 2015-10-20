<!--
--Page was built by Kane Wardle
-->
<?php
require("../include/securitycheck.php");
include '../include/head.php';
include_once("../include/databaselogin.php");

//$HIRE_LINE_NUMBER = $_POST['HIRE_LINE_NUMBER'];
$RETURNED_QUANTITY = $_POST['RETURNED_QUANTITY'];
$CUSTOMER_ID = $_POST['CUSTOMER_ID'];
$STOCK_ID = $_POST['STOCK_ID'];

//if there is damaged stock
$DAMAGED_QUANTITY = $_POST['DAMAGED_QUANTITY'];
$DAMAGED_DESC = $conn->real_escape_string($_POST['DAMAGED_DESC']);


/*echo "<br>Returned amount: " .$RETURNED_QUANTITY;
echo "<br>Customer id: " .$CUSTOMER_ID;
echo "<br>Stock id: " .$STOCK_ID;*/



//to use further down, while updating stock levels at quinnys
$STOCK_IN;
$STOCK_OUT;
$STOCK_NAME;
$HIRE_NUMBER;
$TOTAL_QUANTITY_IN;


//query to get quinnys current stock lvls
$sqlTotAtCust = "SELECT `STOCK_IN`, `REPLACE_COST`, `STOCK_TOTAL`, `STOCK_NAME`, `STOCK_OUT` FROM `stock_items_table`
                    WHERE STOCK_ID = '$STOCK_ID' ";

//run query
$result = $conn->query($sqlTotAtCust);

if ($result->num_rows > 0) {
    // output data of each row

    while ($row = $result->fetch_assoc())
    {
        //set value to be used futher down
        $STOCK_IN = $row["STOCK_IN"];
        $STOCK_OUT = $row["STOCK_OUT"];
        $STOCK_NAME = $row["STOCK_NAME"];
        $REPLACE_COST = $row["REPLACE_COST"];
        $STOCK_TOTAL = $row["STOCK_TOTAL"];

       /* echo "<br><br>Stock in at quinnys: " .$STOCK_IN;
        echo "<br>Stock out at quinnys: " .$STOCK_OUT;
        echo "<br>Stock total: " .$STOCK_TOTAL;
        echo "<br>Stock name: " .$STOCK_NAME;
        echo "<br>Stock replacement cost: " .$REPLACE_COST;*/
    }
}
else{
    include '../include/header.php';
    include '../include/Error.php';
    echo "<h3 style = 'color: white; text-align: center;'>Error getting Stock totals at the Quinnys</h3>";
    Die();
}


//For errors
//get customer name
$sqlTotAtCust = "SELECT `CUSTOMER_NAME` FROM `customer_table` WHERE CUSTOMER_ID = '$CUSTOMER_ID' ";

//run query
$result = $conn->query($sqlTotAtCust);


if ($result->num_rows > 0) {
    // output data of each row

    while ($row = $result->fetch_assoc()) {
        //echo "hire number: " .$row["HIRE_NUMBER"];
        $CUSTOMER_NAME = $row["CUSTOMER_NAME"];

    }
}
else{
    include '../include/header.php';
    include '../include/Error.php';
    echo "<h3 style = 'color: white; text-align: center;'>Error getting Customer Name</h3>";
    Die();
}
//end of getting customer name


//check to see if a row in the total_at_customer_table exists
$sqlTotAtCust = "SELECT `HIRE_NUMBER`, `TOTAL_QUANTITY_IN` FROM `total_at_customer_table`
                    WHERE STOCK_ID = '$STOCK_ID' AND CUSTOMER_ID = '$CUSTOMER_ID' ";

//run query
$result = $conn->query($sqlTotAtCust);


if ($result->num_rows > 0) {
    // output data of each row

    while ($row = $result->fetch_assoc()) {
        //echo "hire number: " .$row["HIRE_NUMBER"];
        $HIRE_NUMBER = $row["HIRE_NUMBER"];
        $TOTAL_QUANTITY_IN = $row["TOTAL_QUANTITY_IN"];  //for later when updating this record
        //we have confirmed that this customer has stock totals for this stock

        /*echo "<br><br>The hire number is: " .$HIRE_NUMBER;
        echo "<br>The total quantity in at customer is: " .$TOTAL_QUANTITY_IN;*/

        //next we have to make sure the customers stock total doesnt go into the negative
        if($RETURNED_QUANTITY > $TOTAL_QUANTITY_IN)
        {
            include '../include/header.php';
            include '../include/Error.php';
            echo "<h3 style = 'color: white; text-align: center;'>The  customer: " .$CUSTOMER_NAME. " only has: " .$TOTAL_QUANTITY_IN. " on at their premises. You are trying to return: " .$RETURNED_QUANTITY. "</h3>";
            Die();
        }

    }
}
else{
    //there is no record of this stock at this customer, so the records will not be created
    include '../include/header.php';
    include '../include/Error.php';
    echo "<h3 style = 'color: white; text-align: center;'>No record found for customer: " .$CUSTOMER_NAME. " for the stock: " .$STOCK_NAME. "</h3>";
    Die();
}
//if got to this point, the customer do have this stock on there premises to return and have enough stock to return



//dont save anything if the user is trying to save more damaged stock then they are returning or not returning any damaged stock
if($DAMAGED_QUANTITY <= $RETURNED_QUANTITY || $DAMAGED_QUANTITY == 0)
{

    //create the return line
    // prepare and bind
    $stmt = $conn->prepare("INSERT INTO retured_table (
      HIRE_NUMBER,
      RETURNED_QUANTITY
    )
    VALUES (?,?) ");



    if ( false===$stmt )
    {
        //if not a valid/ready statement object
        include '../include/header.php';
        include '../include/Error.php';
        die('prepare() failed: ');
    }

    $stmt->bind_param("ii", $HIRE_NUM, $RETURN_QUAN);


    // set parameters and execute
    $HIRE_NUM = $HIRE_NUMBER;
    $RETURN_QUAN = $RETURNED_QUANTITY;

    $stmt->execute();

    //find return id
    $returnID = $conn->insert_id;

    //for error checking
    /*echo "<br><br>the return key is: " .$returnID;
    echo "<br>the damaged amout is: " .$DAMAGED_QUANTITY;
    echo "<br>the damaged decription is: " .$DAMAGED_DESC;*/


    //need total cost
    $totalCost = $DAMAGED_QUANTITY * $REPLACE_COST;

    //echo "<br>the total cost is: " .$totalCost;

    //if damage quanity is one or more
    if($DAMAGED_QUANTITY >= 1)
    {
        //save new damaged line

        // prepare and bind
        $stmt = $conn->prepare("INSERT INTO damaged_table (
            STOCK_ID,
            RETURN_ID,
            CUSTOMER_ID,
            DAMAGE_TYPE,
            DAMAGED_QUANTITY,
            DAMAGED_TOTAL_COST,
            DAMAGED_DESC
        )
        VALUES (?,?,?,?,?,?,?) ");

        if ( false===$stmt )
        {
            //if not a valid/ready statement object
            include '../include/header.php';
            include '../include/Error.php';
            die('prepare() failed: ');
        }

        $stmt->bind_param("iiisids", $stockID, $returnedID, $custId, $damType, $damQuan, $damTotalCost, $damDesc);


        // set parameters and execute
        $stockID = $STOCK_ID;
        $returnedID = $returnID;
        $custId = $CUSTOMER_ID;
        $damType = "CUST";
        $damQuan = $DAMAGED_QUANTITY;
        $damTotalCost = $totalCost;
        $damDesc = $DAMAGED_DESC;

        $stmt->execute();

    }



//get current customer stock level from above, that we have already found


//calc new total at customer after the total return amount as been saved
    $newTotalCust = $TOTAL_QUANTITY_IN - $RETURNED_QUANTITY;

// prepare and bind
    $stmt = $conn->prepare("UPDATE total_at_customer_table SET
    TOTAL_QUANTITY_IN = ?
WHERE HIRE_NUMBER = '$HIRE_NUMBER' ");

    if ( false===$stmt )
    {
        //if not a valid/ready statement object
        include '../include/header.php';
        include '../include/Error.php';
        die('prepare() failed: ' . htmlspecialchars($mysqli->error));
    }

    $stmt->bind_param("i", $totalIn);

    if ( false===$stmt )
    {
        //if can't bind the parameters.
        include '../include/header.php';
        include '../include/Error.php';
        die('bind_param() failed: ' . htmlspecialchars($stmt->error));
    }

// set parameters and execute
    $totalIn = $newTotalCust;


    $stmt->execute();


    /*
     * the total at the customer is now set, now the total stock for quinnys needs to be updated
     */


    /*
     * change stock table including removing damaged stock
     */

//what to change stock totals to
//get total stock in (from further up) - $HIRE_QUANTITY
//get total stock out (from further up) + $HIRE_QUANTITY

    $newTotalStockIn = ($STOCK_IN  + $RETURNED_QUANTITY) - $DAMAGED_QUANTITY;
    $newTotalStockOut = $STOCK_OUT - $RETURNED_QUANTITY;
    $newTotalStockTotal = $STOCK_TOTAL - $DAMAGED_QUANTITY;

    /*echo "<br><br>quantity coming in: " .$RETURNED_QUANTITY. "<br><br>
        <br>original stock in at quinnys: " .$STOCK_IN.
        "<br>origional total in at quinnys: " .$STOCK_TOTAL.
        "<br>original Stock out at quinnys: " . $STOCK_OUT.
        "<br><br>new stock in at quinnys:: " .$newTotalStockIn. "
        <br> new Stock out at quinnys: " .$newTotalStockOut. "
        <br>new stock total at quinnys " .$newTotalStockTotal;*/

// prepare and bind
    $stmt = $conn->prepare("UPDATE stock_items_table SET
    STOCK_OUT = ?,
    STOCK_IN = ?,
    STOCK_TOTAL = ?
WHERE STOCK_ID = '$STOCK_ID' ");

    if ( false===$stmt )
    {
        //if not a valid/ready statement object
        include '../include/header.php';
        include '../include/Error.php';
        die('prepare() failed: ' . htmlspecialchars($mysqli->error));
    }

    $stmt->bind_param("iii", $out, $in, $total);

    if ( false===$stmt )
    {
        //if can't bind the parameters.
        include '../include/header.php';
        include '../include/Error.php';
        die('bind_param() failed: ' . htmlspecialchars($stmt->error));
    }

// set parameters and execute
    $out = $newTotalStockOut;
    $in = $newTotalStockIn;
    $total = $newTotalStockTotal;

    $stmt->execute();

    if ( false===$stmt )
    {
        //if execute() failed
        include '../include/header.php';
        include '../include/Error.php';
        die('execute() failed: ' . htmlspecialchars($stmt->error));
    }

    /*
     * Quinnys stock levels are now updated
     */




}
else
{
    include '../include/header.php';
    include '../include/Error.php';
    echo "<h3 style = 'color: white; text-align: center;'>You cannot remove more damaged stock than what the customer is returning on this page, NOTHING has been saved/ processed</h3>";
    Die();
}




//$stmt->close();
$conn->close();

//header("refresh:0; url=hireLineView.php");
?>