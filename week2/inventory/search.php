<?php
require __DIR__ . "/products.php";
$pageTitle = "Search - StockPilot";
$search = trim($_GET["search"] ?? "");
$matchingProducts = [];
//Seach by name
foreach ($products as $product) {
  if ($search === "") {
    $matchingProducts[] = $product;
  } elseif (stripos($product["name"], $search) !== false) {
    $matchingProducts[] = $product;
  }
}



//HEDEAR 
require __DIR__ . "/include/header.php";

?>


<body>
  <h1 class="text-3xl font-bold"><?= htmlspecialchars($pageTitle, ENT_QUOTES, "UTF-8") ?></h1>
  <form method="get">
    <label for="search">Search products</label>
    <input type="text" id="search" name="search" value="<?= htmlspecialchars($search, ENT_QUOTES, "UTF-8") ?>">
    <button type="submit">Search</button>
  </form>

  <?php if (count($matchingProducts) === 0): ?>
    <p>No matching products</p>
  <?php else: ?>
    <ul>
      <?php foreach ($matchingProducts as $matchingProduct): ?>

        <li><?= htmlspecialchars($matchingProduct["name"], ENT_QUOTES, "UTF-8") . " | Quantity: " . htmlspecialchars($matchingProduct["quantity"], ENT_QUOTES, "UTF-8") ?></li>

      <?php endforeach; ?>
    </ul>
  <?php endif; ?>

  <?php
  //FOOTER
  require __DIR__ . "/include/footer.php";
  ?>