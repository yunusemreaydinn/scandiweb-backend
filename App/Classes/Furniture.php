<?php

include_once 'Model.php';

class Furniture extends Model {

    private $height;
    private $width;
    private $length;

    public function __construct($sku, $name, $price, $type){
        parent::__construct($sku, $name, $price, $type);
    }

    public function getHeight() {
        return $this->height;
    }
    public function setHeight($height) {
        $this->height = $height;
    }
    public function getWidth() {
        return $this->width;
    }
    public function setWidth($width) {
        $this->width = $width;
    }
    public function getLength() {
        return $this->length;
    }
    public function setLength($length) {
        $this->length = $length;
    }

    public function saveProduct($product) {

        $this->setHeight($product->height);
        $this->setWidth($product->width);
        $this->setLength($product->length);

        $sql = "INSERT INTO products(sku, name, price, type) VALUES (:sku, :name, :price, :type)";
        $saveProduct = $this->connection()->prepare($sql);
        $saveProduct->execute([
            ":sku" => $this->getSku(),
            ":name" => $this->getName(),
            ":price" => $this->getPrice(),
            ":type" => $this->getType()
        ]);

        $sqlFurniture = "INSERT INTO furniture(sku, height, width, length) VALUES(:sku, :height, :width, :length)";
        $saveFurniture = $this->connection()->prepare($sqlFurniture);
        $saveFurniture->execute([
            ":sku" =>  $this->getSku(),
            ":height" => $this->getHeight(),
            ":width" => $this->getWidth(),
            ":length" => $this->getLength(),
        ]);
    }
}