<?php

//NETWORK SWITCH
$productName1 = "Network Switch";
$startingQuantity1 = 15;
$receivedQuantity1 = 5;
$soldQuantity1 = 8;
$unitCost1 = 45;
$sellingPrice1 = 75.5;
$salesRevenue1 = $sellingPrice1  * $soldQuantity1;
$costOfGoodsSold1 = $unitCost1 * $soldQuantity1;
$remainingQuantity1 = $startingQuantity1 + $receivedQuantity1 - $soldQuantity1;
$remainingInventoryValue1 = $remainingQuantity1 * $unitCost1;
//NETWORK CABLE
$productName2 = "Network Cable";
$startingQuantity2 = 30;
$receivedQuantity2 = 10;
$soldQuantity2 = 12;
$unitCost2 = 3;
$sellingPrice2 = 8.5;

$salesRevenue2 = $sellingPrice2 * $soldQuantity2;
$costOfGoodsSold2 = $unitCost2 * $soldQuantity2;
$remainingQuantity2 = $startingQuantity2 + $receivedQuantity2 - $soldQuantity2;
$remainingInventoryValue2 = $remainingQuantity2 * $unitCost2;
//TOTAL SALES
$discountPercent = 10;
$taxPercent = 0;


$combinedRevenue = $salesRevenue1 + $salesRevenue2; // combined sales revenue should be total of both sold unit
$discountAmount = $combinedRevenue * $discountPercent / 100; // Need to divided by 100;
$revenueAfterDiscount = $combinedRevenue - $discountAmount;
$taxAmount = $revenueAfterDiscount * $taxPercent / 100; // should be revernueafterdiscount not combined revenue
$customerTotal = $revenueAfterDiscount + $taxAmount;

$totalCostOfGoodsSold = $costOfGoodsSold1 + $costOfGoodsSold2;
$grossProfit = $revenueAfterDiscount - $totalCostOfGoodsSold;
$totalRemainingInventoryValue = $remainingInventoryValue1 + $remainingInventoryValue2;


//REPORT
echo "=== StockPilot Daily Report \n";
echo "Product: " . $productName1 . "\n";
echo "Remaining quantity: " . $remainingQuantity1 . "\n";
echo "Sales revenue before discount: $" . number_format($salesRevenue1, 2) . "\n";
echo "Cost of goods sold: $" . number_format($costOfGoodsSold1, 2) . "\n";
echo "Remaining Inventory Value: $" . number_format($remainingInventoryValue1, 2) . "\n";
echo "\n";
echo "Product: " . $productName2 . "\n";
echo "Remaining quantity: " . $remainingQuantity2 . "\n";
echo "Sales revenue before discount: $" . number_format($salesRevenue2, 2) . "\n";
echo "Cost of goods sold: $" . number_format($costOfGoodsSold2, 2) . "\n";
echo "Remaining Inventory Value: $" . number_format($remainingInventoryValue2, 2) . "\n";
echo "\n";
echo "=== Sales Summary === \n";
echo "Combined Revenue: $" . number_format($combinedRevenue, 2) . "\n";
echo "Discount (" . $discountPercent . "%) : $" . number_format($discountAmount, 2) . "\n";
echo "Revenue after discount: $" . number_format($revenueAfterDiscount, 2) . "\n";
echo "Tax (" . $taxPercent . "%): $" . number_format($taxAmount, 2) . "\n";
echo "Customer total: $" . number_format($customerTotal, 2) . "\n";
echo "Total cost of goods sold: $" . number_format($totalCostOfGoodsSold, 2) . "\n";
echo "Gross profit: $" . number_format($grossProfit, 2) . "\n";
echo "Total remaining inventory value: $" . number_format($totalRemainingInventoryValue, 2) . "\n";
echo 'Product: $productName1 \n';
echo 10 + 5;
