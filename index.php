<?php include 'App/autoload.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    $obj = new Controller();
    $obj->getProducts();
    ?>

    <!-- <form action="App/View/add_product.php" method="post">
        <label for="productType">Product Type:</label><br>
        <select id="productType" name="productType">
            <option value="dvd">DVD</option>
            <option value="book">Book</option>
            <option value="furniture">Furniture</option>
        </select><br>

        <input type="submit" value="Save Product">


    </form> -->


</body>

</html>