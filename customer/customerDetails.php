<?php
$CUSTOMER_ID = $_GET['CUSTOMER_ID'];


$sql = "SELECT
          CUSTOMER_ID,
          CUSTOMER_EMAIL,
          CUSTOMER_NAME,
          CUSTOMER_PHONE1,
          CUSTOMER_PHONE2,
          CUSTOMER_POSTAL_ADDRESS,
          CUSTOMER_PHYSICAL_ADDRESS,
          CUSTOMER_CONTACT_NAME
        FROM CUSTOMER_TABLE WHERE CUSTOMER_ID = '$CUSTOMER_ID' ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while ($row = $result->fetch_assoc()) {
        ?>


        <table class = "detailsTable">
        <tr>
            <th>
                Name /Description:
            </th>
            <td>
                <?php echo $row["CUSTOMER_NAME"] ?>
            </td>
        </tr>
        <tr>
            <th>
                Email Address:
            </th>
            <td>
                <?php echo $row["CUSTOMER_EMAIL"] ?>
            </td>
        </tr>
        <tr>
            <th>
                Primary Phone Number:
            </th>
            <td>
                <?php echo $row["CUSTOMER_PHONE1"] ?>
            </td>
        </tr>
        <tr>
            <th>
                Secondary Phone Number:
            </th>
            <td>
                <?php echo $row["CUSTOMER_PHONE2"] ?>
            </td>
        </tr>
        <tr>
            <th>
                Postal Address:
            </th>
            <td>
                <?php echo $row["CUSTOMER_POSTAL_ADDRESS"] ?>
            </td>
        </tr>
        <tr>
            <th>
                Physical Address:
            </th>
            <td>
                <?php echo $row["CUSTOMER_PHYSICAL_ADDRESS"] ?>
            </td>
        </tr>
        <tr>
            <th>
                Contact Name:
            </th>
            <td>
                <?php echo $row["CUSTOMER_CONTACT_NAME"] ?>
            </td>
        </tr>
        </table>
        <?php
    }
}
$conn->close();
?>