<?php

include_once 'Database.php';

class Furniture extends Database {
    public function saveProduct($product) {
        $sql = "INSERT INTO products(sku, name, price) VALUES (:sku, :name, :price)";
        $saveProduct = $this->connection()->prepare($sql);
        $saveProduct->execute([
            ":sku" => $product->sku,
            ":name" => $product->name,
            ":price" => $product->price
        ]);
        $sqlFurniture = "INSERT INTO furniture(sku, height, width, length) VALUES(:sku, :height, :width, :length)";
        $saveFurniture = $this->connection()->prepare($sqlFurniture);
        $saveFurniture->execute([
            ":sku" =>  $product->sku,
            ":height" => $product->height,
            ":width" => $product->width,
            ":length" => $product->length,
        ]);
    }
}