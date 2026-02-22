<?php
    require_once('../controller/product.controller.php');
    
?>
<!DOCTYPE html>
<html>
    <head>
    <title>Natural Root Hair Catalog <br> Owner - Cora Germany</br></title>
        <style>

        table {
            border-collapse: collapse;
            width: 70%
        }
        th, td { 
            border: 1 px solid black,
            padding 8px,
            text-align center; /* centers text under headings */
}
th {
    background-color: limegreen;
}

</style>
      </head>

<body>
<h2>Product Catalog</h2>
<table>
<tr>
<th>Product #</th>
<th>Product Id</th>
<th>Product Name</th>
<th>Description</th>
<th>Product Cost</th>
</tr>

<?php foreach ($product as $row): ?>
<tr>
<td><?= htmlspecialchars($row['ProductNo']) ?></td>
<td><?= htmlspecialchars($row['ProductID']) ?></td>
<td><?= htmlspecialchars($row['ProductName']) ?></td>
<td><?= htmlspecialchars($row['ProductDescription']) ?></td>
<td><?= htmlspecialchars($row['ProductCost']) ?></td>
</tr>
<?php endforeach; ?>

</table>

</body>
</html>