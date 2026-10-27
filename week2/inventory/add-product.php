<?php
$pageTitle = "Add new product -StockPilot";
require __DIR__ . "/include/header.php";
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $productName = $_POST["productName"] ?? "";
  $quantity = $_POST["quantity"] ?? "";
  $unitCost = $_POST["unitCost"] ?? "";
}
?>

<body>
  <h1 class="text-3xl font-bold"><?= htmlspecialchars($pageTitle, ENT_QUOTES, "UTF-8") ?></h1>
  <form method="post">
    <label for="productName">Product name</label>
    <input type="text" id="productName" name="productName">
    <label for="quantity">Quantity</label>
    <input type="number" id="quantity" name="quantity">
    <label for="unitCost">Unit cost</label>
    <input type="number" step="0.01" id="unitCost" name="unitCost">
    <button type="submit">Submit</button>
  </form>

  <?php
  if ($_SERVER["REQUEST_METHOD"] === "POST"): ?>
    <p>
      Product:
      <?= htmlspecialchars($productName, ENT_QUOTES, "UTF-8") ?>
    </p>
    <p>
      Quantity:
      <?= htmlspecialchars($quantity, ENT_QUOTES, "UTF-8") ?>
    </p>
    <p>
      Unit cost:
      <?= htmlspecialchars($unitCost, ENT_QUOTES, "UTF-8") ?>
    </p>
  <?php endif; ?>


  <?php require __DIR__ . "/include/footer.php"; ?>