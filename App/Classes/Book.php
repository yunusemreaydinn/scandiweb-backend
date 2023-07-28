<?php

include_once 'Database.php';
class Book extends Database {
    public function saveProduct($product) {
        $sql = "INSERT INTO products(sku, name, price) VALUES (:sku, :name, :price)";
        $saveProduct = $this->connection()->prepare($sql);
        $saveProduct->execute([
            ":sku" => $product->sku,
            ":name" => $product->name,
            ":price" => $product->price
        ]);
        $sqlBook = "INSERT INTO book(sku, weight) VALUES(:sku, :weight)";
        $saveBook = $this->connection()->prepare($sqlBook);
        $saveBook->execute([
            ":sku" =>  $product->sku,
            ":weight" => $product->weight
        ]);
    }
}