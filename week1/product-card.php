<?php
$productName = "Network Switch";
$quantity = 12;
$unitPrice = 75.5;

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>StockPilot</title>
</head>

<body>
  <h1>StockPilot</h1>
  <p><?= "Product: " . $productName ?></p>
  <p><?= "Quantity: " . $quantity ?></p>
  <p><?= "Unit price: $" . $unitPrice ?></p>
</body>

</html>