<?php
require_once __DIR__ .
  "/products.php";
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
