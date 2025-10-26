<?php
// fetch_price.php
include 'adminconnection.php';
header('Content-Type: application/json');

$obj = new Admin();
$conn = $obj->connection();

$itemName = isset($_POST['itemName']) ? trim($_POST['itemName']) : '';
$prodCategory = isset($_POST['prodCategory']) ? trim($_POST['prodCategory']) : '';

$query = $obj->prodExist($prodCategory, $itemName);

if ($query && mysqli_num_rows($query) > 0) {
    $price = mysqli_fetch_row($query);
    echo json_encode(['success' => true, 'price' => $price[4]]);
} else {
    echo json_encode(['success' => false, 'message' => 'Product not found', 'price' => null]);
}
?>
