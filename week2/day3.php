<?php

$products = [
  ["name" => "Network Switch", "quantity" => 12, "unitPrice" => 75.5, "isActive" => true],
  ["name" => "Network Cable", "quantity" => 5, "unitPrice" => 8.5, "isActive" => true],
  ["name" => "Router", "quantity" => 4, "unitPrice" => 120, "isActive" => false]
];

$totalValue = 0;
$totalUnits = 0;

function calculateInventoryValue($quantity, $unitPrice)
{
  return $quantity * $unitPrice;
};

function getStockStatus($quantity, $lowStockThreshold)
{
  if ($quantity <= 0) {
    return "Out of stock";
  } elseif ($quantity <= $lowStockThreshold) {
    return "Low stock";
  } else {
    return "In stock";
  }
}

function summarizeActiveInventory($products)
{
  $productCount = 0;
  $totalUnits = 0;
  $totalValue = 0;
  foreach ($products as $product) {
    if ($product["isActive"]) {
      $productCount += 1;
      $totalUnits += $product["quantity"];
      $totalValue += calculateInventoryValue($product["quantity"], $product["unitPrice"]);
    }
  }
  return ["productCount" => $productCount, "totalUnits" => $totalUnits, "totalValue" => $totalValue];
}

// $activeProduct = summarizeActiveInventory($products);
// print "Active Product: " . $activeProduct["productCount"] . "\n";
// print "Total units: " . $activeProduct["totalUnits"] . "\n";
// print "Total value: " . number_format($activeProduct["totalValue"], 2) . "\n";


// foreach ($products as $product) {
//   $status = getStockStatus($product["quantity"], 5);
//   $inventoryValue = calculateInventoryValue($product["quantity"], $product["unitPrice"]);
//   print $product["name"] . " | Quantity: " . $product["quantity"] . " | Value: $" . number_format($inventoryValue, 2) . " | Status: " . $status . "\n";
//   $totalUnits += $product["quantity"];
//   $totalValue += $inventoryValue;
// }



// print "Total units: " . $totalUnits . "\n";
// print "Total inventory value: $" . number_format($totalValue, 2) . "\n";


function countInventoryUnits($products)
{
  $total = 0;

  foreach ($products as $product) {
    $total += $product["quantity"];
  }
  return $total;
}
print countInventoryUnits($products) . "\n";
print countInventoryUnits([]) . "\n";
