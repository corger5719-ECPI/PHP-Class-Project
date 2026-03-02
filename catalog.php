<?php


// 1) Load products array
require_once __DIR__ . '/../includes/products_data.php';
$products = getProducts();

// 2) Make sure cart exists
if (!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

//  safely get quantity from cart
function getCartQty(string $productId): int {
    $qty = $_SESSION['cart'][$productId] ?? 0;
    return is_numeric($qty) ? max(0, (int)$qty) : 0;
}

// set cart qty (never below 0)
function setCartQty(string $productId, int $qty): void {
    $_SESSION['cart'][$productId] = max(0, $qty);
}

// 3) Handle actions (Add / Remove / Increase / Decrease / Set Qty)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';
    $productId = $_POST['product_id'] ?? '';

    // Only allow actions for valid products
    if (isset($products[$productId])) {
        $currentQty = getCartQty($productId);

        switch ($action) {
            case 'add':
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
                // typed quantity from input
                $newQty = $_POST['qty'] ?? 0;
                $newQty = is_numeric($newQty) ? (int)$newQty : 0;
                setCartQty($productId, $newQty);
                break;
        }
    }

    // Prevent form resubmission on refresh
    header('Location: /sdc310_classproject/controller/cart_controller.php');
    exit;
}

// Count items in cart (sum of quantities)
$cartItemCount = 0;
foreach ($_SESSION['cart'] as $id => $qty) {
    $cartItemCount += (is_numeric($qty) ? max(0, (int)$qty) : 0);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title>Natural Hair Care Salon - Catalog</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 24px; }
        header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; }
        .nav a { text-decoration: none; padding: 8px 12px; border: 1px solid #333; border-radius: 6px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 10px; vertical-align: top; }
        th { background: #f3f3f3; text-align: left; }
        .actions { display: flex; gap: 6px; flex-wrap: wrap; }
        button { padding: 6px 10px; cursor: pointer; }
        .qtybox { width: 70px; padding: 6px; }
        .price { white-space: nowrap; }
        .muted { color: #666; font-size: 0.95em; }
    </style>
</head>
<body>

<header>
    <div>
        <h1 style="margin:0;">Natural Hair Care Salon</h1>
        <div class="muted">Catalog Page (array-based products, session cart)</div>
    </div>
    <div class="nav">
        <a href="../controller/cart_controller.php">View Cart</a>
    </div>
</header>

<table>
    <thead>
        <tr>
            <th style="width: 90px;">Product ID</th>
            <th style="width: 180px;">Product Name</th>
            <th>Description</th>
            <th style="width: 120px;">Cost</th>
            <th style="width: 170px;">Qty in Cart</th>
            <th style="width: 260px;">Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($products as $id => $p): ?>
        <?php $qtyInCart = getCartQty($id); ?>
        <tr>
            <td><?= htmlspecialchars($id) ?></td>
            <td><?= htmlspecialchars($p['name']) ?></td>
            <td><?= htmlspecialchars($p['description']) ?></td>
            <td> $<?= number_format((float)$p['price'], 2) ?></td>
            <td><?= $qtyInCart ?></td>
            <td>
                     <form method="post" action="../controller/cart_controller.php">   
                        <input type="hidden" name="action" value="add">
                         <input type="hidden" name="product_id" value="<?= htmlspecialchars($id) ?>">
                        
                        <button type="submit">Add</button>
                    </form>
    </td>
    </tr>
<?php endforeach; ?>
    </tbody>
