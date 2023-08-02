<?php

include_once 'Model.php';
class Book extends Model {

    private $weight;

    public function __construct($sku, $name, $price, $type){
        parent::__construct($sku, $name, $price, $type);
    }

    public function getWeight() {
        return $this->weight;
    }
    public function setWeight($weight) {
        $this->weight = $weight;
    }

    public function saveProduct($product) {
        
        $this->setWeight($product->weight);

        $sql = "INSERT INTO products(sku, name, price, type) VALUES (:sku, :name, :price, :type)";
        $saveProduct = $this->connection()->prepare($sql);
        $saveProduct->execute([
            ":sku" => $this->getSku(),
            ":name" => $this->getName(),
            ":price" => $this->getPrice(),
            ":type" => $this->getType()
        ]);

        $sqlBook = "INSERT INTO book(sku, weight) VALUES(:sku, :weight)";
        $saveBook = $this->connection()->prepare($sqlBook);
        $saveBook->execute([
            ":sku" =>  $this->getSku(),
            ":weight" => $this->getWeight()
        ]);
    }
}