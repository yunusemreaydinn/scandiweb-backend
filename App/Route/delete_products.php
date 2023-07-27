<?php

include '../Classes/Controller.php';

$controller = new Controller;

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo $controller->deleteProducts();
} else {
    echo "Invalid Request Method!";
}