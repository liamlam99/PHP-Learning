<?php

$productName = "Network Switch";
$quantity = 12;
$lowStockThreshold = 5;
$unitPrice = 75.5;
$isActive = false;

print "Product: " . $productName . "\n";
print "Quantity: " . $quantity . "\n";
print "Unit price: $" . number_format($unitPrice, 2) . "\n";

if ($quantity <= 0)
  print "Stock status: Out of stock\n";
elseif ($quantity <= $lowStockThreshold)
  print "Stock status: Low stock\n";
else
  print "Stock status: In stock\n";

if ($isActive === true)
  print "Listing status: Active\n";
else
  print "Listing status: Inactive\n";

if (($quantity > 0) && ($isActive === true))
  print "Order availability: Available\n";
else
  print "Order availability: Unavailable\n";
