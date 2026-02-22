
<?php
    require_once __DIR__. '/database_php';

    //Get all entries in the product table
    function get_all_products() {
    global $conn;

    
    $query = "SELECT * FROM products;

        $result = mysqli_query($conn, $query);

    
    return $result;