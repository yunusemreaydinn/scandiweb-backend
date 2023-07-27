<?php 

include '../Classes/Controller.php';

$controller = new Controller();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    return $controller->saveProduct();
} else {
    echo json_encode(['error' => 'Invalid request method']);
}