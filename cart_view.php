<?php

function money($n): string {
    return'$' . number_format((float)$n, 2);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shopping Cart</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 24px; }
        table { width: 100%; border-collapse: collapse; margin-top: 12px; }
        th, td { border: 1px solid #ddd; padding: 10px; }
        th { background: #f3f3f3; text-align: left; }
        .right { text-align: right; white-space: nowrap; }
        .box { width: 360px; border: 1px solid #ddd; padding: 12px; border-radius: 8px; margin-top: 16px;}
        .row { display: flex; justify-content: space-between; padding: 6px 0; }
        a { text-decoration: none; border: 1px solid #333; padding: 8px 12px; border-radius: 6px; color: #000;}
        button { padding: 14px; background: #fafafa 1px dashed #ccc; margin-top: 12px; }    
        .empty { padding: 14px; background: #fafafa; border: 1 px dashed #ccc; margin-top: 12px; }
</style>
 </head>
<body>

<h1>Shopping Cart</h1>
<p>
    <a href="../controller/product.controller.php> Continue Shopping</a>
</p>

<?php if (empty($rows)): ?>
        <div class=
        <strong>Your cart is empty.</strong>
</div>

<?php else: ?>
<table>
    <thead>
        <tr>
            <th style="width: 120px;">Product ID</th>
            <th>Product Name</th>
            <th style="width: 160px;">Quantity ordered</th>
            <th style="width: 140px;">Product Cost</th>
            <th style="width: 140px;">Product Total</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($rows as $products): ?>    <tr>
            <td><?= htmlspecialchars($products['id']) ?></td>
            <td><?= htmlspecialchars($products['name']) ?></td>
            <td><?= (int)$products['qty'] ?></td>
            <td class="right"><?= money($products['price']) ?></td>
            <td class="right"><?= money($products['lineTotal']) ?></td>
                </tr>>
               
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<div class="box">   
    <div class="row">
        <span>Total of items ordered</span>
        <span><?= (int)$totalItems ?></span>
    </div>
<div class="row">
        <span>Subtotal</span>
        <span><?= money($subtotal) ?></span>
</div>   
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

<form method="POST" action="">
 </div>
<?php endif; ?>

    </body>
    </html>