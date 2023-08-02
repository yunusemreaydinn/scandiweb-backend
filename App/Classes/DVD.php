<?php

include_once 'Model.php';

class DVD extends Model {

    private $size;

    public function __construct($sku, $name, $price, $type){
        parent::__construct($sku, $name, $price, $type);
    }

    public function getSize() {
        return $this->size;
    }
    public function setSize($size) {
        $this->size = $size;
    }

    public function saveProduct($product) {

        $this->setSize($product->size);

        $sql = "INSERT INTO products(sku, name, price, type) VALUES (:sku, :name, :price, :type)";
        $saveProduct = $this->connection()->prepare($sql);
        $saveProduct->execute([
            ":sku" => $this->getSku(),
            ":name" => $this->getName(),
            ":price" => $this->getPrice(),
            ":type" => $this->getType()
        ]);

        $sqlDVD = "INSERT INTO dvd(sku, size) VALUES(:sku, :size)";
        $saveDVD = $this->connection()->prepare($sqlDVD);
        $saveDVD->execute([
            ":sku" =>  $this->getSku(),
            ":size" => $this->getSize()
        ]);
    }
}