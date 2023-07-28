<?php

include_once 'Database.php';

class Model extends Database
{

    protected function getProducts()
    {
        $sql2 = "SELECT 
        products.sku, 
        products.name, 
        products.price,
        book.weight AS weight,
        dvd.size AS size, 
        furniture.height AS height,
        furniture.width AS width,
        furniture.length AS length
        FROM products
        LEFT JOIN book ON products.sku = book.sku
        LEFT JOIN dvd ON products.sku = dvd.sku
        LEFT JOIN furniture ON products.sku = furniture.sku; ";
        $sql = "SELECT * FROM products";
        $fetch = $this->connection()->prepare($sql2);
        $fetch->execute();
        $res = $fetch->fetchAll();
        return $res;
    }

    protected function massDelete($skus)
    {
        $product = implode(',', array_fill(0, count($skus), '?'));
        $sql = "DELETE FROM products WHERE sku IN ($product)";
        $delete = $this->connection()->prepare($sql);
        $delete->execute($skus);
        return $delete->rowCount();
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