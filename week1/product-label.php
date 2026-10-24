<?php
//Product 1
$productName1 = "Network Switch";
$quantity1 = 2;
$unitPrice1 = 75.5;
$subtotal1 = $quantity1 * $unitPrice1;
//Product 2
$productName2 = "Network Cable";
$quantity2 = 5;
$unitPrice2 = 8.5;
$subtotal2 = $quantity2 * $unitPrice2;

//Grand total
$subtotal = $subtotal1 + $subtotal2;
$discountPercent = 10;
$discountAmount = $subtotal * $discountPercent / 100;
$subtotalAfterDiscount = $subtotal - $discountAmount;
$taxPercent = 8;
$taxAmount = $subtotalAfterDiscount * $taxPercent / 100;
$grandTotal = $subtotalAfterDiscount + $taxAmount;

echo $productName1 . " | " . "Quantity: " . $quantity1 . " | " . "Line total: $" . number_format($subtotal1, 2) . "\n";

echo $productName2 . " | " . "Quantity: " . $quantity2 . " | " . "Line total: $" . number_format($subtotal2, 2) . "\n";

echo "Subtotal: $" . number_format($subtotal, 2) . "\n";
echo "Discount (" . $discountPercent . "%): $" . number_format($discountAmount, 2) . "\n";
echo "Subtotal after discount: $" . number_format($subtotalAfterDiscount, 2) . "\n";
echo "Tax (" . $taxPercent . "%): $" . number_format($taxAmount, 2) . "\n";
echo "Grand total: $" . number_format($grandTotal, 2) . "\n";
