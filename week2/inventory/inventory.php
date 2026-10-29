<?php
$pageTitle = "StockPilot Inventory";
require_once __DIR__ . "/products.php";
require_once __DIR__ . "/functions.php";
$lowStockThreshold = 5;

$summary = buildInventorySummary($products, $lowStockThreshold);

//Stockclass by color;

?>
<?php require __DIR__ . "/include/header.php"; ?>

<body class="min-h-screen bg-slate-100 text-slate-800">
  <?php require __DIR__ . "/navbar.php" ?>

  <main class="mx-auto max-w-7xl px-6 py-10">
    <h1 class="text-3xl font-bold"><?= htmlspecialchars($pageTitle, ENT_QUOTES, "UTF-8") ?></h1>
    <!-- SUMMARY OF STORAGE INVENTORY -->
    <section class="my-6 grid grid-cols-1 gap-4 sm:grid-cols-3"
      aria-label="Active inventory summary">

      <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
        <h2 class="text-sm font-medium text-slate-500">
          Active products
        </h2>

        <p class="mt-2 text-3xl font-bold text-slate-900">
          <?= $summary["activeCount"] ?>
        </p>
      </div>
      <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
        <h2 class="text-sm font-medium text-slate-500">
          Active units
        </h2>

        <p class="mt-2 text-3xl font-bold text-slate-900">
          <?= $summary["totalUnits"] ?>
        </p>
      </div>
      <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">
        <h2 class="text-sm font-medium text-slate-500">
          Active inventory value
        </h2>

        <p class="mt-2 text-3xl font-bold text-slate-900">
          $<?= number_format($summary["inventoryValue"], 2) ?>
        </p>
      </div>


    </section>
    <div class="overflow-x-auto rounded-xl border border-slate-200 bg-white shadow-sm">
      <table class="w-full text-left text-sm">
        <!-- Column headings -->
        <thead class="bg-slate-50 text-xs uppercase text-slate-500">
          <tr>
            <th scope="col" class="px-4 py-3">ID</th>
            <th scope="col" class="px-4 py-3">Product</th>
            <th scope="col" class="px-4 py-3">Quantity</th>
            <th scope="col" class="px-4 py-3">Unit cost</th>
            <th scope="col" class="px-4 py-3">Selling price</th>

            <th scope="col" class="px-4 py-3">Inventory Value</th>
            <th scope="col" class="px-4 py-3">Stock status</th>
            <th scope="col" class="px-4 py-3">Listing</th>
          </tr>

        </thead>

        <!-- Product rows -->
        <tbody class="divide-y divide-slate-200">
          <?php if (count($products) === 0): ?>
            <tr class="hover:bg-slate-50">
              <td colspan="8" class="px-4 py-10 text-center text-slate-500">No product available.</td>
            </tr>
          <?php else: ?>
            <?php
            foreach ($products as $product): ?>
              <?php
              $inventoryValue = calculateInventoryValue($product["quantity"], $product["unitCost"]);
              $stockStatus = getStockStatus($product["quantity"], $lowStockThreshold);
              if ($product["isActive"]) {
                $listing = "Active";
              } else {
                $listing = "Inactive";
              }
              //DEFINE STOCK BY COLOR CODE
              if ($stockStatus === "Low stock") {
                $stockClass = "bg-amber-100 text-amber-800";
              } elseif ($stockStatus === "In stock") {
                $stockClass = "bg-emerald-100 text-emerald-800";
              } else {
                $stockClass = "bg-red-100 text-red-800";
              }

              ?>

              <tr class="hover:bg-slate-50">
                <td class="px-4 py-4"><?= $product["id"] ?> </td>
                <td class="px-4 py-4"><?= htmlspecialchars($product["name"], ENT_QUOTES, "UTF-8") ?> </td>
                <td class="px-4 py-4"><?= $product["quantity"] ?> </td>
                <td class="px-4 py-4">$<?= number_format($product["unitCost"], 2) ?> </td>
                <td class="px-4 py-4">$<?= number_format($product["sellingPrice"], 2) ?> </td>
                <td class="px-4 py-4">$<?= number_format($inventoryValue, 2) ?> </td>
                <td class="px-4 py-4">
                  <span class="inline-flex whitespace-nowrap rounded-full px-2.5 py-1 text-xs font-medium <?= $stockClass ?>">
                    <?= $stockStatus ?>
                  </span>
                </td>
                <td class="px-4 py-4"><?= $listing ?> </td>
              </tr>
            <?php endforeach ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>


  </main>


  <?php require __DIR__ . "/include/footer.php"; ?>