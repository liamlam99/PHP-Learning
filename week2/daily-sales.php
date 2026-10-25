<?php

$productName = "Network Cable";
$startingQuantity = 7;
$dailySales = 3;
$days = 5;
$unitPrice = 8.5;
$remainingQuantity = $startingQuantity;
$revenue = 0;
$totalUnitSold = 0;


print "Product: " . $productName . "\n";
for ($day = 1; $day <= $days; $day++) {
  if ($dailySales <= $remainingQuantity) {
    $soldToday = $dailySales;
  } else {
    $soldToday = $remainingQuantity;
  }
  $remainingQuantity -= $soldToday;
  $revenue = $unitPrice * $soldToday;
  $totalUnitSold += $soldToday;
  print "Day " . $day . " | Sold: " . $soldToday . " | Remaining Quantity: " . $remainingQuantity . " | Revenue: $" . number_format($revenue, 2) . "\n";
}
$totalRevenue = $totalUnitSold * $unitPrice;
print "Total units sold: " . $totalUnitSold . "\n";
print
  "Total revenue: $" . number_format($totalRevenue, 2) . "\n";
