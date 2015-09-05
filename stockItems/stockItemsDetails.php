<?php
$STOCK_ID = $_GET['STOCK_ID'];

//MYSQLI
$sql = "SELECT i.*, t.* FROM STOCK_ITEMS_TABLE i
          inner join STOCK_TYPE_TABLE t on i.STOCK_TYPE_ID = t.STOCK_TYPE_ID WHERE STOCK_ID = '$STOCK_ID' ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        ?>


        <table class = "detailsTable">
            <tr>
                <th>
                    Name:
                </th>
                <td>
                    <?php echo $row["STOCK_NAME"] ?>
                </td>
            </tr>
            <tr>
                <th>
                    Stock Type:
                </th>
                <td>
                    <?php echo $row["STOCK_TYPE_NAME"] ?>
                </td>
            </tr>
            <tr>
                <th>
                    Hire Cost:
                </th>
                <td>
                    <?php echo $row["HIRE_COST"] ?>
                </td>
            </tr>
            <tr>
                <th>
                    Replacement Cost:
                </th>
                <td>
                    <?php echo $row["REPLACE_COST"] ?>
                </td>
            </tr>
            <tr>
                <th>
                    Size:
                </th>
                <td>
                    <?php echo $row["SIZE"] ?>
                </td>
            </tr>
            <tr>
                <th>
                    Primary Colour:
                </th>
                <td>
                    <?php echo $row["COLOUR1"] ?>
                </td>
            </tr>
            <tr>
                <th>
                    Secondary Colour:
                </th>
                <td>
                    <?php echo $row["COLOUR2"] ?>
                </td>
            </tr>
            <tr>
                <th>
                    Tertiary Colour:
                </th>
                <td>
                    <?php echo $row["COLOUR3"] ?>
                </td>
            </tr>
        </table>
        <?php
    }
}
$conn->close();
?>