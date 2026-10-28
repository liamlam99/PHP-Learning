<?php
$pageTitle = "Add new product - StockPilot";
// Handling new product submission and validate if input is valid
$productName = "";
$quantity = "";
$unitCost = "";
$errors = [];
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $productName = trim($_POST["productName"] ?? "");
  if ($productName === "") {
    $errors[] = "Product name is required.";
  }
  $quantity = trim($_POST["quantity"] ?? "");
  $validateQuantity = filter_var($quantity, FILTER_VALIDATE_INT);
  if ($quantity === "") {
    $errors[] = "Quantity is required.";
  } elseif ($validateQuantity === false || $validateQuantity < 0) {
    $errors[] = "Quantity must be a whole number of 0 or more.";
  }
  $unitCost = trim($_POST["unitCost"] ?? "");
  $validateUnitCost = filter_var($unitCost, FILTER_VALIDATE_FLOAT);
  if ($unitCost === "") {
    $errors[] = "Unit cost is required";
  } elseif ($validateUnitCost === false || $validateUnitCost < 0) {
    $errors[] = "Unit cost must be a number of 0 or more.";
  }
  if (count($errors) === 0) {
    $inventoryValue = $validateQuantity * $validateUnitCost;
    $newProduct = ["name" => $productName, "quantity" => $validateQuantity, "unitCost" => $validateUnitCost, "inventoryValue" => $inventoryValue];
  }
}
require __DIR__ . "/include/header.php";
?>

<body>
  <!-- Form to submit new product -->
  <h1 class="text-3xl font-bold"><?= htmlspecialchars($pageTitle, ENT_QUOTES, "UTF-8") ?></h1>
  <form method="post">
    <label for="productName">Product name</label>
    <input type="text" id="productName" name="productName" value="<?= htmlspecialchars($productName, ENT_QUOTES, "UTF-8") ?>">
    <label for="quantity">Quantity</label>
    <input type="number" id="quantity" name="quantity" value="<?= htmlspecialchars($quantity, ENT_QUOTES, "UTF-8") ?>">
    <label for="unitCost">Unit cost</label>
    <input type="number" step="0.01" id="unitCost" name="unitCost" value="<?= htmlspecialchars($unitCost, ENT_QUOTES, "UTF-8") ?>">
    <button type="submit">Submit</button>
  </form>
  <!-- Product information after review-->
  <?php if ($_SERVER["REQUEST_METHOD"] === "POST" && count($errors) === 0): ?>
    <h2>Product preview - not saved</h2>
    <p>
      Product:
      <?= htmlspecialchars($newProduct["name"], ENT_QUOTES, "UTF-8") ?>
    </p>
    <p>
      Quantity:
      <?= htmlspecialchars($newProduct["quantity"], ENT_QUOTES, "UTF-8") ?>
    </p>
    <p>
      Unit cost: $
      <?= htmlspecialchars(number_format($newProduct["unitCost"], 2), ENT_QUOTES, "UTF-8") ?>
    </p>
    <p>
      Inventory value: $
      <?= htmlspecialchars(number_format($newProduct["inventoryValue"], 2), ENT_QUOTES, "UTF-8") ?>
    </p>
  <?php else: ?>
    <ul>
      <?php foreach ($errors as $error): ?>
        <li><?= htmlspecialchars($error, ENT_QUOTES, "UTF-8") ?></li>
      <?php endforeach; ?>
    </ul>
  <?php endif; ?>




  <?php require __DIR__ . "/include/footer.php"; ?>