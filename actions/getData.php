<?php
$result = require_once './includes/dbGetData.php';
?>
<div class="csv-container">
    <table>
        <thead>
        <tr>
            <th>GTIN-Number</th>
            <th>Description</th>
            <th>Brand</th>
            <th>Color</th>
            <th>Price</th>
            <th>Price with tax</th>
        </tr>
        </thead>
<?php
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        ?>
                    <tr class="data">
                        <td>
                            <?php echo $row['id']; ?>
                        </td>
                        <td>
                            <?php echo $row['description']; ?>
                        </td>
                        <td>
                            <?php echo $row['brand']; ?>
                        </td>
                        <td>
                            <?php echo $row['color']; ?>
                        </td>
                        <td>
                            <?php echo '€'.number_format($row['price'], 2); ?>
                        </td>
                        <td>
                            <?php
                                $btwprice = ($row['price'] / 100 * $_ENV['TAX_COST'])  + $row['price'];
                                echo '€'.number_format($btwprice, 2);
                            ?>
                        </td>
                    </tr>
        <?php
    }
} else {
    echo "0 results";
}
$conn->close();
?>