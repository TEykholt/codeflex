<?php
//Load CSV in read mode
$configs = require_once ('config.php');
$CSVfp = fopen("content/Programming_Test_2_1.csv", "r");
if ($CSVfp !== FALSE) {
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
                    //Remove header from CSV
                    $data = fgetcsv($CSVfp, 1000, ",");
            //Loop through csv file
            while (! feof($CSVfp)) {
                $data = fgetcsv($CSVfp, 1000, ",");
                if (! empty($data)) {
                    ?>
                    <tr class="data">
                        <td>
                            <?php echo $data[0]; ?>
                        </td>
                        <td>
                            <?php echo $data[1]; ?>
                        </td>
                        <td>
                            <?php echo $data[2]; ?>
                        </td>
                        <td>
                            <?php echo $data[3]; ?>
                        </td>
                        <td>
                            <?php echo '€'.number_format($data[4], 2); ?>
                        </td>
                        <td>
                            <?php
                                $btwprice = ($data[4] / 100 * $configs['tax_cost'])  + $data[4];
                                echo '€'.number_format($btwprice, 2);
                            ?>
                        </td>
                    </tr>
                <?php }?>
                <?php
            }
            ?>
        </table>
    </div>
<?php
}
    fclose($CSVfp);