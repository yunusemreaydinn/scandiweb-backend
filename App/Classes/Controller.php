<?php

require_once 'Model.php';
include_once 'Book.php';
include_once 'DVD.php';
include_once 'Furniture.php';

class Controller extends Model
{
    public function getProducts()
    {
        $model = new Model;
        $res = json_encode($model->getProducts());
        echo $res;
    }

    public function deleteProducts()
    {
        var_dump($_POST);
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $skus = $_POST['sku'] ?? [];

            if (empty($sku)) {
                return "SKU is required";
            }

            $model = new Model;
            $deleteCount = $model->massDelete($skus);

            if ($deleteCount > 0) {
                return "$deleteCount product(s) deleted successfully.";
            } else {
                return "Products can not be found.";
            }
        }

        return "Invalid request method.";
    }

    public function saveProduct()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $product = json_decode(file_get_contents('php://input'));
            $sku = $product->sku;
            $model = new Model;

            if (empty($sku)) {
                return "SKU is REQUIRED.";
            } else if ($model->skuExists($sku)) {
                return "SKU is already exists.";
            } else {
                $productTypes = [
                    'dvd' => DVD::class,
                    'book' => Book::class,
                    'furniture' => Furniture::class
                ];

                $type = $product->productType;

                if (!isset($productTypes[$type])) {
                    return json_encode(['error' => 'Invalid Product Type']);
                }

                $class = $productTypes[$type];
                $productClass = new $class;
                $productClass->saveProduct($product);
            }
        }
    }
}