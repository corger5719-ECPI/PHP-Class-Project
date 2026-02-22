<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/../model/products_db.php';

    $result = get_all_products();
    $products = [];

   while ($row = mysqli_fetch_assoc($result)) {
    $products[] = $row;

    }
   //Load the view (view should loop through $products)
require __DIR__ . '/../view/display_products.php';

