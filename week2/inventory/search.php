<?php
require __DIR__ . "/products.php";
$pageTitle = "Search - StockPilot";
$search = trim($_GET["search"] ?? "");
$matchingProducts = [];
//Seach by name

$listing = $_GET["listing"] ?? "all";
foreach ($products as $product) {
  $matchSearch = $search === "" || stripos($product["name"], $search) !== false;
  if ($listing === "active") {
    $matchListing = $product["isActive"];
  } elseif ($listing === "inactive") {
    $matchListing = !$product["isActive"];
  } else {
    $matchListing = true;
  }
  if ($matchSearch && $matchListing) {
    $matchingProducts[] = $product;
  }
}

//HEDEAR 
require __DIR__ . "/include/header.php";

?>


<body class="min-h-screen bg-slate-100 text-slate-800">
  <main class="mx-auto w-full max-w-4xl px-4 py-8 sm:px-6">

    <h1 class="text-3xl font-bold"><?= htmlspecialchars($pageTitle, ENT_QUOTES, "UTF-8") ?></h1>

    <form method="get" class="mt-6 grid grid-cols-1 items-end gap-4 rounded-xl border border-slate-200 bg-white p-5 shadow-sm sm:grid-cols-[1fr_180px_auto]">
      <div>
        <label for="search" class="mb-2 block text-sm font-medium">
          Search products
        </label>
        <input type="text" id="search" name="search" value="<?= htmlspecialchars($search, ENT_QUOTES, "UTF-8") ?>" class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-base focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
      </div>

      <div>
        <label for="search" class="mb-2 block text-sm font-medium">
          Listing status
        </label>
        <select name="listing" id="listing" class="h-11 w-full rounded-lg border border-slate-300 bg-white px-3 text-base focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
          <option value="all">All products</option>
          <option value="active" <?= $listing === "active" ? "selected" : "" ?>>Active only</option>
          <option value="inactive" <?= $listing === "inactive" ? "selected" : "" ?>>Inactive only</option>
        </select>

      </div>

      <button type="submit" class="h-11 rounded-lg bg-blue-600 px-5 text-sm font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300">Search</button>
    </form>
    <p class="mt-6 text-sm text-slate-600">Matching products: <?= count($matchingProducts) ?></p>
    <?php if (count($matchingProducts) === 0): ?>
      <p class="	mt-3 rounded-xl border border-dashed border-slate-300 bg-white p-8 text-center text-slate-500">No matching products</p>
    <?php else: ?>

      <ul class="	mt-3 divide-y divide-slate-200 overflow-hidden rounded-xl border border-slate-200 bg-white">
        <?php foreach ($matchingProducts as $matchingProduct): ?>
          <li class="	px-5 py-4 text-sm"><?= htmlspecialchars($matchingProduct["name"], ENT_QUOTES, "UTF-8") . " | Quantity: " . htmlspecialchars($matchingProduct["quantity"], ENT_QUOTES, "UTF-8") ?></li>
        <?php endforeach; ?>
      </ul>
    <?php endif; ?>


  </main>
  <?php
  //FOOTER
  require __DIR__ . "/include/footer.php";
  ?>