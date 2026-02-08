<?php
// cart.php (Shopping Cart Page) - FULL WORKING STARTER (no MySQL needed)

session_start();

// Load products array
require_once __DIR__ . '/includes/products_data.php';
$products = getProducts();

// Make sure cart exists
if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Helpers
function getCartQty(string $productId): int {
    $qty = $_SESSION['cart'][$productId] ?? 0;
    return is_numeric($qty) ? max(0, (int)$qty) : 0;
}

function setCartQty(string $productId, int $qty): void {
    $_SESSION['cart'][$productId] = max(0, $qty);
}

// Handle actions (inc/dec/remove/checkout/set)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $productId = $_POST['product_id'] ?? '';

    if ($action === 'checkout') {
        // Clear the cart and return to catalog
        $_SESSION['cart'] = [];
        header('Location: index.php');
        exit;
    }

    // For product-based actions, ensure product exists
    if (isset($products[$productId])) {
        $currentQty = getCartQty($productId);

        switch ($action) {
            case 'inc':
                setCartQty($productId, $currentQty + 1);
                break;

            case 'dec':
                setCartQty($productId, $currentQty - 1);
                break;

            case 'remove':
                setCartQty($productId, 0);
                break;

            case 'set':
                $newQty = $_POST['qty'] ?? 0;
                $newQty = is_numeric($newQty) ? (int)$newQty : 0;
                setCartQty($productId, $newQty);
                break;
        }
    }

    // Prevent resubmission
    header('Location: cart.php');
    exit;
}

// Build list of cart items (qty >= 1) + totals
$cartItems = [];
$subtotal = 0.0;
$totalItemsOrdered = 0;

foreach ($_SESSION['cart'] as $id => $qty) {
    $qty = is_numeric($qty) ? (int)$qty : 0;
    if ($qty < 1) continue;
    if (!isset($products[$id])) continue;

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

// Calculate totals per project rules
$taxRate = 0.05;
$shippingRate = 0.10;

$tax = $subtotal * $taxRate;
$shipping = $subtotal * $shippingRate;
$orderTotal = $subtotal + $tax + $shipping;

// Helper for money formatting
function money(float $amount): string {
    return '$' . number_format($amount, 2);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Natural Hair Care Salon - Cart</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 24px; }
        header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; }
        .nav a { text-decoration: none; padding: 8px 12px; border: 1px solid #333; border-radius: 6px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 16px; }
        th, td { border: 1px solid #ddd; padding: 10px; vertical-align: top; }
        th { background: #f3f3f3; text-align: left; }
        .actions { display: flex; gap: 6px; flex-wrap: wrap; }
        button { padding: 6px 10px; cursor: pointer; }
        .qtybox { width: 70px; padding: 6px; }
        .totals { width: 360px; border: 1px solid #ddd; padding: 12px; border-radius: 8px; }
        .totals-row { display: flex; justify-content: space-between; padding: 6px 0; }
        .totals-row strong { font-weight: 700; }
        .muted { color: #666; font-size: 0.95em; }
        .right { text-align: right; white-space: nowrap; }
        .empty { padding: 14px; background: #fafafa; border: 1px dashed #ccc; }
        .footer-actions { display: flex; gap: 10px; align-items: center; margin-top: 10px; }
    </style>
</head>
<body>

<header>
    <div>
        <h1 style="margin:0;">Shopping Cart</h1>
        <div class="muted">Only items with quantity ≥ 1 are shown</div>
    </div>
    <div class="nav">
        <a href="index.php">Continue Shopping</a>
    </div>
</header>

<?php if (count($cartItems) === 0): ?>
    <div class="empty">
        <strong>Your cart is empty.</strong>
        <div class="muted" style="margin-top:6px;">Go back to the catalog to add items.</div>
    </div>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th style="width: 90px;">Product ID</th>
                <th>Product Name</th>
                <th style="width: 150px;">Quantity</th>
                <th style="width: 140px;">Cost (Each)</th>
                <th style="width: 140px;">Product Total</th>
                <th style="width: 240px;">Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($cartItems as $item): ?>
            <tr>
                <td><?= htmlspecialchars($item['id']) ?></td>
                <td><?= htmlspecialchars($item['name']) ?></td>
                <td>
                    <?= (int)$item['qty'] ?>
                    <form method="POST" style="margin-top:8px; display:flex; gap:6px; align-items:center;">
                        <input type="hidden" name="product_id" value="<?= htmlspecialchars($item['id']) ?>">
                        <input type="hidden" name="action" value="set">
                        <input class="qtybox" type="number" name="qty" min="0" value="<?= (int)$item['qty'] ?>">
                        <button type="submit">Set</button>
                    </form>
                </td>
                <td class="right"><?= money($item['price']) ?></td>
                <td class="right"><?= money($item['lineTotal']) ?></td>
                <td>
                    <div class="actions">
                        <form method="POST" style="margin:0;">
                            <input type="hidden" name="product_id" value="<?= htmlspecialchars($item['id']) ?>">
                            <input type="hidden" name="action" value="dec">
                            <button type="submit">-</button>
                        </form>

                        <form method="POST" style="margin:0;">
                            <input type="hidden" name="product_id" value="<?= htmlspecialchars($item['id']) ?>">
                            <input type="hidden" name="action" value="inc">
                            <button type="submit">+</button>
                        </form>

                        <form method="POST" style="margin:0;">
                            <input type="hidden" name="product_id" value="<?= htmlspecialchars($item['id']) ?>">
                            <input type="hidden" name="action" value="remove">
                            <button type="submit">Remove</button>
                        </form>
                    </div>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <div style="display:flex; gap:16px; flex-wrap:wrap; align-items:flex-start;">
        <div class="totals">
            <div class="totals-row">
                <span>Total items ordered</span>
                <span><?= (int)$totalItemsOrdered ?></span>
            </div>
            <div class="totals-row">
                <span>Subtotal</span>
                <span><?= money($subtotal) ?></span>
            </div>
            <div class="totals-row">
                <span>Tax (5%)</span>
                <span><?= money($tax) ?></span>
            </div>
            <div class="totals-row">
                <span>Shipping &amp; Handling (10%)</span>
                <span><?= money($shipping) ?></span>
            </div>
            <hr>
            <div class="totals-row">
                <strong>Order Total</strong>
                <strong><?= money($orderTotal) ?></strong>
            </div>

            <div class="footer-actions">
                <form method="POST" style="margin:0;">
                    <input type="hidden" name="action" value="checkout">
                    <button type="submit">Check Out</button>
                </form>
                <span class="muted">Clears cart and returns to catalog</span>
            </div>
        </div>
    </div>
<?php endif; ?>

</body>
</html>
