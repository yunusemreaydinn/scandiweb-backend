<?php 

include '../Classes/Controller.php';

$controller = new Controller();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    return $controller->saveProduct();
} else {
    return json_encode(['error' => 'Invalid request method']);
}