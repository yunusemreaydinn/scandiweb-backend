<?php  

include 'Database.php';

class Model extends Database {

    protected function getProducts() {
        $sql = "SELECT * FROM products";
        $fetch = $this->connection()->prepare($sql);
        $fetch->execute();
        $res = $fetch->fetchAll();
        return $res;
    }

    protected function massDelete($skus) {
        $product = implode(',', array_fill(0, count($skus), '?'));
        $sql = "DELETE FROM products WHERE sku IN ($product)";
        $delete = $this->connection()->prepare($sql);
        $delete->execute($skus);
        return $delete->rowCount();
    }

    protected function skuExists($sku) {
        $sql = "SELECT * FROM products WHERE sku = :sku";
        $check = $this->connection()->prepare($sql);
        $check->execute(['sku' => $sku]);
        $product = $check->fetch();
        if($product) { return true; }
        else { return false; }

    }

}