
<?php
    require_once __DIR__. '/database.php';

    //Get all entries in the product table
    function get_all_products() {
    global $conn;

    
   $sql = "SELECT * FROM products";
   $result = mysqli_query($conn, $sql);
      
   if(!$result) {
        die("Database query failed: " . mysqli_error($conn));
        }
            return $result;

    }
