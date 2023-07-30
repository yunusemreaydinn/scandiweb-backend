<?php

include_once 'Database.php';

class Model extends Database
{
    protected function getProducts()
    {
        $sql = "SELECT 
        products.sku, 
        products.name,
        products.price,
        products.type,
        book.weight AS weight,
        dvd.size AS size,
        furniture.height AS height,
        furniture.width AS width,
        furniture.length AS length
        FROM products
        LEFT JOIN book ON products.sku = book.sku
        LEFT JOIN dvd ON products.sku = dvd.sku
        LEFT JOIN furniture ON products.sku = furniture.sku 
        ORDER BY id ASC";
        $fetch = $this->connection()->prepare($sql);
        $fetch->execute();
        $res = $fetch->fetchAll();
        return $res;
    }

    protected function massDelete($skus)
    {
        $product = implode(',', array_fill(0, count($skus), '?'));
        $delete = "DELETE FROM products WHERE sku IN ($product)";
        $stmt = $this->connection()->prepare($delete);
        $stmt->execute($skus);
        return $stmt->rowCount();
    }

    protected function skuExists($sku)
    {
        $sql = "SELECT * FROM products WHERE sku = :sku";
        $check = $this->connection()->prepare($sql);
        $check->execute(['sku' => $sku]);
        $product = $check->fetch();
        if ($product) {
            return true;
        } else {
            return false;
        }
    }

}