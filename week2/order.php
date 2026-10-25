<?php

//Input
$productName = "Network Switch";
$quantity = (int) ($argv[1] ?? 12);
$requestedQuantity = (int) ($argv[2] ?? 4);
$isActive = ($argv[3] ?? "true") === "true";
$unitPrice = 75.5;
$lowStockThreshold = 5;
$bulkDiscountThreshold = 5;
$bulkDiscountPercent = 10;
$subtotal = 0;
$discountAmount = 0;
$remainingQuantity = $quantity;
$orderTotal = 0;

//Validate order
$message1 = "";
$message2 = "In stock\n";
if (!$isActive)
  $message1 = "Rejected: Product is inactive\n";
elseif ($requestedQuantity <= 0)
  $message1 = "Rejected: Quantity must be positive\n";
elseif ($requestedQuantity > $quantity)
  $message1 = "Rejected: Insufficient stock\n";
else {
  $message1 = "Approved\n";
  $subtotal = $unitPrice * $requestedQuantity;

  if ($requestedQuantity >= $bulkDiscountThreshold)
    $discountAmount = $bulkDiscountPercent * $subtotal / 100;

  $orderTotal = $subtotal - $discountAmount;
  $remainingQuantity = $quantity - $requestedQuantity;
}
//Update remaining stock


if ($remainingQuantity <= 0)
  $message2 = "Out of stock\n";
elseif ($remainingQuantity <= $lowStockThreshold)
  $message2 = "Low stock\n";


// Process approved order

print "Product: " . $productName . "\n";
print "Requested quantity: " . $requestedQuantity . "\n";
print "Result: " . $message1;
print "Subtotal: $" . number_format($subtotal, 2) . "\n";
print "Discount: $" . number_format($discountAmount, 2) . "\n";
print "Order total: $" . number_format($orderTotal, 2) . "\n";
print "Remaining stock: " . $remainingQuantity . "\n";
print "Stock status: " . $message2;
