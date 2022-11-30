<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<form  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="id">Id:</label><br>
    <input  type="text" id="id" name="id" ><br>
    <label for="description">Description:</label><br>
    <input  type="text" id="description" name="description"><br>
    <label for="brand">Brand:</label><br>
    <input  type="text" id="brand" name="brand" ><br>
    <input  type="submit" name="submit1" value="Search">
</form>

<form  method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="currency">Currency:</label><br>
    <select id="currency" name="currency">
        <option value="EUR">Euro</option>
        <option value="USD">US Dollars</option>
        <option value="AUD">Australian Dollars</option>
        <option value="GBP">British pounds</option>
        <option value="RSD">Serbian Dinars
        <option value="JPY">Japanese Yens</option>
        <input  type="submit" name="submit1" value="Change">
    </select>
</form>
    <?php
        include 'actions/getData.php';
    ?>
</body>
</html>