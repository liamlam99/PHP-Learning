<?php

$products = [];

$products1 = [
  ["id" => 101, "name" => "Network Switch", "quantity" => 12, "unitCost" => 45, "sellingPrice" => 75.5, "isActive" => true],
  ["id" => 102, "name" => "Network Cable", "quantity" => 5, "unitCost" => 3, "sellingPrice" => 8.5, "isActive" => true],
  ["id" => 103, "name" => "Router", "quantity" => 4, "unitCost" => 80, "sellingPrice" => 120, "isActive" => false],
  ["id" => 104, "name" => "Power Adapter", "quantity" => 4, "unitCost" => 7, "sellingPrice" => 15, "isActive" => true],
  ["id" => 105, "name" => "Monitoring Sensor", "quantity" => 2, "unitCost" => 25, "sellingPrice" => 40, "isActive" => true],
];

$lowStockThreshold = 5;

// Inventory Value 
function calculateInventoryValue($quantity, $unitCost)
{
  return $quantity * $unitCost;
}
// Revenue
function calcuatePotenialRevenue($quantity, $sellingPrice)
{
  return $quantity * $sellingPrice;
}
//Stock Status
function getStockStatus($quantity, $lowStockThreshold)
{
  if ($quantity <= 0)
    return "Out of stock";
  elseif ($quantity <= $lowStockThreshold)
    return "Low stock";
  else
    return "In stock";
}
// Display products
function displayProduct($product, $lowStockThreshold)
{
  $activeStatus = "Active";
  if ($product["isActive"] === false) {
    $activeStatus = "Inactive";
  }
  $productValue = number_format(calculateInventoryValue($product["quantity"], $product["unitCost"]), 2);
  $productPotentialRevenue = number_format(calcuatePotenialRevenue($product["quantity"], $product["sellingPrice"]), 2);
  $stockStatus = getStockStatus($product["quantity"], $lowStockThreshold);
  print $product["id"] . " | " . $product["name"] . " | Quantity: " . $product["quantity"] . " | " . $activeStatus . " | " . $stockStatus . " | Value: $" . $productValue . " | Potential revenue: $" . $productPotentialRevenue . "\n";
}
//Find Product by ID
function findProductById($products, $id)
{
  foreach ($products as $product) {
    if ($product["id"] === $id) {
      return $product;
    }
  }
  return null;
}

$foundProduct = findProductById($products, 107);
if ($foundProduct !== null) {
  displayProduct($foundProduct, $lowStockThreshold);
} else {
  echo "Product not found!\n";
}


//Display product
foreach ($products as $product) {
  displayProduct($product, $lowStockThreshold);
}


// Build Product Summary
function buildInventorySummary($products, $lowStockThreshold)
{
  $activeCount = 0;
  $totalUnits = 0;
  $inventoryValue = 0;
  $potentialRevenue = 0;
  $potentialGrossProfit = 0;
  $lowStockNames = [];
  $outOfStockNames = [];
  foreach ($products as $product) {
    if ($product["isActive"]) {
      $activeCount += 1;
      $totalUnits += $product["quantity"];
      $inventoryValue += calculateInventoryValue($product["quantity"], $product["unitCost"]);
      $potentialRevenue += calcuatePotenialRevenue($product["quantity"], $product["sellingPrice"]);
      $status = getStockStatus($product["quantity"], $lowStockThreshold);
      if ($status === "Low stock") {
        $lowStockNames[] = $product["name"];
      } elseif ($status === "Out of stock") {
        $outOfStockNames[] = $product["name"];
      }
    }
  }
  $potentialGrossProfit = $potentialRevenue - $inventoryValue;
  return ["activeCount" => $activeCount, "totalUnits" => $totalUnits, "inventoryValue" => $inventoryValue, "potentialRevenue" => $potentialRevenue, "potentialGrossProfit" => $potentialGrossProfit, "lowStockNames" => $lowStockNames, "outOfStockNames" => $outOfStockNames];
}
$productSummary = buildInventorySummary($products, $lowStockThreshold);

function displaySummary($productSummary)
{
  //Printing inventory summary
  print "=== Active Inventory Summary ===\n";
  print "Active products: " . $productSummary["activeCount"] . "\n";
  print "Total units: " . $productSummary["totalUnits"] . "\n";
  print "Inventory value: $" . number_format($productSummary["inventoryValue"], 2) . "\n";
  print "Potential revenue: $" . number_format($productSummary["potentialRevenue"], 2) . "\n";
  print "Potential gross profit: $" . number_format($productSummary["potentialGrossProfit"], 2) . "\n";
  print "\nLow-stock products\n";
  if ($productSummary["lowStockNames"]) {
    foreach ($productSummary["lowStockNames"] as $lowProduct) {
      print "- " .  $lowProduct . " \n";
    }
  } else {
    print "None\n";
  }
  print "\nOut-of-stock products\n";
  if ($productSummary["outOfStockNames"]) {
    foreach ($productSummary["outOfStockNames"] as $outProduct) {
      print "- " .  $outProduct . " \n";
    }
  } else {
    print "None\n";
  }
}

displaySummary($productSummary);
