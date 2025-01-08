<?php
require_once("../config/dbcon.php");
$low_stocks = [];

$queryLow = "SELECT ps.*, p.product_name, s.size_name 
             FROM product_size_variation ps 
             INNER JOIN product p ON p.product_id = ps.product_id 
             INNER JOIN sizes s ON s.size_id = ps.size_id 
             WHERE ps.quantity_in_stock < 10";
$stmtLow = $conn->prepare($queryLow);
$stmtLow->execute();
$resultLow = $stmtLow->get_result();

while ($dataLow = $resultLow->fetch_assoc()) {
    $low_stocks[] = [
        'product_name' => $dataLow['product_name'],
        'size_name' => $dataLow['size_name'],
        'quantity_in_stock' => $dataLow['quantity_in_stock']
    ];
}

echo json_encode($low_stocks);
?>
