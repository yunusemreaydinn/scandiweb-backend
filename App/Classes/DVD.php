<?php

include_once 'Database.php';

class DVD extends Database {
    public function saveProduct($product) {
        $sql = "INSERT INTO products(sku, name, price) VALUES (:sku, :name, :price)";
        $saveProduct = $this->connection()->prepare($sql);
        $saveProduct->execute([
            ":sku" => $product->sku,
            ":name" => $product->name,
            ":price" => $product->price
        ]);
        $sqlDVD = "INSERT INTO dvd(sku, size) VALUES(:sku, :size)";
        $saveDVD = $this->connection()->prepare($sqlDVD);
        $saveDVD->execute([
            ":sku" =>  $product->sku,
            ":size" => $product->size
        ]);
    }
}