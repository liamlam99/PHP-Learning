<?php

// $productName = "Network Cable";
// $startingQuantity = 10;
// $dailySales = 0;
// $unitPrice = 8.5;
// $lowStockThreshold = 2;
// $isActive = true;
// $remainingQuantity = $startingQuantity;
// $days = 0;
// $revenue = 0;
// $totalRevenue = 0;
// $totalUnitSold = 0;
// $status = "In stock\n";

// print "Product: " . $productName . "\n";
// if (!$isActive) {
//   print "Cannot Simulate: Product is inactive\n";
// } elseif ($startingQuantity < 0) {
//   print "Cannot simulate: Starting stock cannot be negative\n";
// } elseif ($dailySales <= 0) {
//   print "Cannot simulate: Daily sales must be positive\n";
// } else {
//   while ($remainingQuantity > 0) {
//     $days += 1;
//     if ($dailySales <= $remainingQuantity) {
//       $soldToday = $dailySales;
//     } else {
//       $soldToday = $remainingQuantity;
//     }
//     $remainingQuantity -= $soldToday;
//     if ($remainingQuantity <= 0) {
//       $status = "Out of stock";
//     } elseif ($remainingQuantity <= $lowStockThreshold) {
//       $status = "Low stock";
//     } else {
//       $status = "In stock";
//     }

//     $revenue = $soldToday * $unitPrice;
//     print "Day " . $days . " | Sold: " . $soldToday . " | Remaining: " . $remainingQuantity . " | Revenue: $" . number_format($revenue, 2) . " | Status: " . $status . "\n";

//     $totalRevenue += $revenue;
//     $totalUnitSold += $soldToday;
//   }
//   print "Days to sell out: " . $days . "\n";
//   print "Total units sold: " . $totalUnitSold . "\n";
//   print "Total revenue: $" . number_format($totalRevenue, 2) . "\n";
//   print "Final stock: " . $remainingQuantity . "\n";
// }

// $stock = 3;
// $days = 0;

// while ($stock > 0) { // change condition to > 0 because there still now sales happened when the stock is 0;
//   $days++; // added to incresing day if the sales happened;
//   $stock--;
// }

// echo "Days: " . $days . "\n";
// echo "Remaining: " . $stock . "\n";


$products = ["Network Switch", "Network Cable", "Router"];

foreach ($products as $product) {
  print "Product: " . $product . "\n";
}
