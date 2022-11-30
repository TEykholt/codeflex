<?php
$conn = require 'includes/dbConnect.php';

$per_page_record = $_ENV['RECORDS_PER_PAGE'];
if (isset($_GET["page"])) {
    $page = $_GET["page"];
} else {
    $page = 1;
}

$start_from = ($page - 1) * $per_page_record;
$query = null;
// generating orderby and sort url for table header
function sortorder($fieldname){
    $sorturl = "?order_by=".$fieldname."&sort=";
    $sorttype = "asc";
    if(isset($_GET['order_by']) && $_GET['order_by'] == $fieldname){
        if(isset($_GET['sort']) && $_GET['sort'] == "asc"){
            $sorttype = "desc";
        }
    }
    $sorturl .= $sorttype;
    return $sorturl;
}

if (isset($_POST["id"], $_POST["description"], $_POST["brand"])) {
    $query = "SELECT * FROM parts WHERE id LIKE '%$_POST[id]%' AND description LIKE '%$_POST[description]%' AND brand LIKE '%$_POST[brand]%' ";
}
else{
    if(isset($_GET['order_by']) && isset($_GET['sort'])){
        $orderby = ' order by '.$_GET['order_by'].' '.$_GET['sort'];
        $query = "SELECT * FROM parts ".$orderby." LIMIT $start_from, $per_page_record ";
    }
    else{
        $query = "SELECT * FROM parts LIMIT $start_from, $per_page_record ";
    }


}

$query = "SELECT * FROM parts LIMIT $start_from, $per_page_record";
$result = $conn->query($query);
?>
<div class="csv-container">
    <table>
        <thead>
        <tr>
            <th><a href="<?php echo sortorder('id'); ?>" class="sort">GTIN-Number</a></th>
            <th><a href="<?php echo sortorder('description'); ?>" class="sort">Description</a></th>
            <th><a href="<?php echo sortorder('brand'); ?>" class="sort">Brand</a></th>
            <th><a href="<?php echo sortorder('color'); ?>" class="sort">Color</a></th>
            <th><a href="<?php echo sortorder('price'); ?>" class="sort">Price</a></th>
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
    }?>

    <div class="pagination">
          <?php
            $query = "SELECT COUNT(*) FROM parts";
            $result = $conn->query($query);

            $row = $result->fetch_assoc();
            $total_records = $row['COUNT(*)'];

            // Number of pages required.
            $total_pages = ceil($total_records / $per_page_record);
            $pagLink = "";

            if($page>=2){
                echo "<a href='index.php?page=".($page-1)."'>  Prev </a>";
            }

            for ($i=1; $i<=$total_pages; $i++) {
              if ($i == $page) {
                  $pagLink .= "<a class = 'active' href='index.php?page=" .$i."'>".$i." </a>";
              }
              else  {
                  $pagLink .= "<a href='index.php?page=".$i."'> ".$i." </a>";
              }
            };
            echo $pagLink;

            if($page<$total_pages){
                echo "<a href='index.php?page=".($page+1)."'>  Next </a>";
            }

          ?>
    </div>
</div>
<?php
    $conn->close();

?>
