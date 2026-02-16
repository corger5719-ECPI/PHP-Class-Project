<?php
$host = "localhost";
$user = "root";
$pass = "";          // XAMPP usually blank
$db   = "natural Root Hair Studio"; // change to your DB name

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}
?>

<?php
// catalog.php
session_start();
require_once __DIR__ . "/includes/db_connect.php";

// Pull products from DB
$sql = "SELECT ProductID, ProductCode, ProductName, Description, Price
        FROM products
        WHERE Active = 1
        ORDER BY ProductName";

$result = mysqli_query($conn, $sql);

if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Catalog</title>
    <style>
        .card { border:1px solid #ccc; padding:12px; margin:10px 0; }
        .price { font-weight:bold; }
    </style>
</head>
<body>

<h1>Product Catalog</h1>

<?php if (mysqli_num_rows($result) == 0): ?>
    <p>No products found.</p>
<?php else: ?>
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <div class="card">
            <h3><?php echo htmlspecialchars($row["ProductName"]); ?></h3>
            <p><?php echo htmlspecialchars($row["Description"]); ?></p>
            <p class="price">$<?php echo number_format((float)$row["Price"], 2); ?></p>

            <!-- Optional: Add-to-cart button -->
            <form method="post" action="cart.php">
                <input type="hidden" name="action" value="add">
                <input type="hidden" name="product_id" value="<?php echo (int)$row["ProductID"]; ?>">
                <input type="submit" value="Add to Cart">
            </form>
        </div>
    <?php endwhile; ?>
<?php endif; ?>

</body>
</html>
