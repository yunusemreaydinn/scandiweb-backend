<?php

require_once 'Model.php';
include_once 'Book.php';
include_once 'DVD.php';
include_once 'Furniture.php';

class Controller extends Model
{
    private $model;
    private $product;

    public function __construct() {
        $this->product = json_decode(file_get_contents('php://input'));
    }

    public function getProducts()
    {
        $this->model = Model::getProducts();
        $res = json_encode($this->model);
        echo $res;
    }

    public function deleteProducts()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $skus = $this->product->skus ?? [];
        
            if (empty($skus)) {
                echo "SKU is required";
                exit();
            }

            $deleteCount = Model::massDelete($skus);

            if ($deleteCount > 0) {
                echo "$deleteCount product(s) deleted successfully.";
            } else {
                echo "Products can not be found.";
            }
        }

        return "Invalid request method.";
    }

    public function saveProduct()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $sku = $this->product->sku;

            if (empty($sku)) {
                echo "SKU is REQUIRED.";
            } else if (Model::skuExists($sku)) {
                exit();
            } else {
                $productTypes = [
                    'dvd' => DVD::class,
                    'book' => Book::class,
                    'furniture' => Furniture::class
                ];

                $type = $this->product->productType;

                if (!isset($productTypes[$type])) {
                    return json_encode(['error' => 'Invalid Product Type']);
                }

                $class = $productTypes[$type];
                $productClass = new $class($this->product->sku, $this->product->name, $this->product->price, $this->product->productType);
                $productClass->saveProduct($this->product);
            }
        }
    }
}