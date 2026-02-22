<?php
//Connect to Database
$hostname = "localhost";
$username = "ecpi_user";
$password = "Password1";
$dbname = "sdc310_classproject";
$conn = mysqli_connect($hostname, $username, $password, $dbname);

session_start();

// Load products array
require_once __DIR__ . '/includes/products_data.php';
$products = getProducts();

// Ensure cart exists
if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Helpers
function getCartQty(string $productId): int {
    $qty = $_SESSION['cart'][$productId] ?? 0;
    $qty = is_numeric($qty) ? (int)$qty : 0;
    return max(0, $qty);
}

function setCartQty(string $productId, int $qty): void {
    $_SESSION['cart'][$productId] = max(0, $qty);
}

function money(float $amount): string {
    return '$' . number_format($amount, 2);
}

// Handle checkout
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'checkout') {
        // Clear cart and return to catalog page
        $_SESSION['cart'] = [];
        header('Location: index.php');
        exit;
    }
}

// Build cart items (only qty >= 1)
$cartItems = [];
$subtotal = 0.0;
$totalItemsOrdered = 0;

foreach ($_SESSION['cart'] as $id => $qty) {
    $qty = is_numeric($qty) ? (int)$qty : 0;

    if ($qty < 1) continue;               // only show qty >= 1
    if (!isset($products[$id])) continue; // skip invalid product IDs

    $price = (float)$products[$id]['price'];
    $lineTotal = $price * $qty;

    $cartItems[] = [
        'id' => $id,
        'name' => $products[$id]['name'],
        'qty' => $qty,
        'price' => $price,
        'lineTotal' => $lineTotal
    ];

    $subtotal += $lineTotal;
    $totalItemsOrdered += $qty;
}

// Totals per requirements
$taxRate = 0.05;
$shippingRate = 0.10;

$tax = $subtotal * $taxRate;
$shipping = $subtotal * $shippingRate;
$orderTotal = $subtotal + $tax + $shipping;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shopping Cart</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 24px; }
        header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; }
        a.button { text-decoration: none; padding: 8px 12px; border: 1px solid #333; border-radius: 6px; color: #000; }
        table { width: 100%; border-collapse: collapse; margin-top: 12px; }
        th, td { border: 1px solid #ddd; padding: 10px; }
        th { background: #f3f3f3; text-align: left; }
        .right { text-align: right; white-space: nowrap; }
        .totals { width: 360px; margin-top: 16px; border: 1px solid #ddd; padding: 12px; border-radius: 8px; }
        .row { display: flex; justify-content: space-between; padding: 6px 0; }
        .empty { padding: 14px; background: #fafafa; border: 1px dashed #ccc; }
        button { padding: 8px 12px; cursor: pointer; }
    </style>
</head>
<body>

<header>
    <h1 style="margin:0;">Shopping Cart</h1>
    <!-- Continue shopping link -->
    <a class="button" href="index.php">Continue Shopping</a>
</header>

<?php if (count($cartItems) === 0): ?>
    <div class="empty">
        <strong>Your cart is empty.</strong>
        <div style="margin-top:6px;">Return to the catalog page to add products.</div>
    </div>
<?php else: ?>
    <!-- Cart table: required attributes -->
    <table>
        <thead>
            <tr>
                <th style="width:100px;">Product ID</th>
                <th>Product Name</th>
                <th style="width:160px;">Quantity ordered</th>
                <th style="width:140px;">Product Cost</th>
                <th style="width:140px;">Product Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cartItems as $item): ?>
                <tr>
                    <td><?= htmlspecialchars($item['id']) ?></td>
                    <td><?= htmlspecialchars($item['name']) ?></td>
                    <td><?= (int)$item['qty'] ?></td>
                    <td class="right"><?= money($item['price']) ?></td>
                    <td class="right"><?= money($item['lineTotal']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- Totals section: required totals -->
    <div class="totals">
        <div class="row">
            <span>Total of items ordered</span>
            <span><?= (int)$totalItemsOrdered ?></span>
        </div>
        <div class="row">
            <span>Subtotal</span>
            <span><?= money($subtotal) ?></span>
        </div>
        <div class="row">
            <span>Tax (5%)</span>
            <span><?= money($tax) ?></span>
        </div>
        <div class="row">
            <span>Shipping &amp; Handling (10%)</span>
            <span><?= money($shipping) ?></span>
        </div>
        <hr>
        <div class="row">
            <strong>Order Total</strong>
            <strong><?= money($orderTotal) ?></strong>
        </div>

        <!-- Checkout button: clears cart and returns to catalog -->
        <form method="POST" style="margin-top:12px;">
            <input type="hidden" name="action" value="checkout">
            <button type="submit">Check Out</button>
        </form>
    </div>
<?php endif; ?>

</body>
</html>
