<?php

include '../Classes/Controller.php';

$controller = new Controller;

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    return $controller->deleteProducts();
} else {
    return "Invalid Request Method!";
}