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

<body class="min-h-screen bg-slate-100 text-slate-800">
  <?php require __DIR__ . "/navbar.php" ?>
  <main class="mx-auto w-full max-w-2xl px-4 py-10 sm:px-6">
    <h1 class="text-3xl font-bold tracking-tight"><?= htmlspecialchars($pageTitle, ENT_QUOTES, "UTF-8") ?></h1>
    <form method="post" class="mt-6 space-y-5 rounded-xl border border-slate-200 bg-white p-6 shadow-sm">
      <div>
        <label for="productName" class="mb-2 block text-sm font-medium">
          Product name
        </label>

        <input
          type="text"
          id="productName"
          name="productName"
          value="<?= htmlspecialchars($productName, ENT_QUOTES, "UTF-8") ?>"
          class="h-11 w-full rounded-lg border border-slate-300 px-3 text-base focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
      </div>
      <div>
        <label for="quantity" class="mb-2 block text-sm font-medium">
          Quantity:
        </label>

        <input
          type="text"
          id="quantity"
          name="quantity"
          value="<?= htmlspecialchars($quantity, ENT_QUOTES, "UTF-8") ?>"
          class="h-11 w-full rounded-lg border border-slate-300 px-3 text-base focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
      </div>
      <div>
        <label for="productName" class="mb-2 block text-sm font-medium">
          Unit cost: $
        </label>

        <input
          type="text"
          id="unitCost"
          name="unitCost"
          value="<?= htmlspecialchars($unitCost, ENT_QUOTES, "UTF-8") ?>"
          class="h-11 w-full rounded-lg border border-slate-300 px-3 text-base focus:border-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-200">
      </div>

      <button type="submit" class="h-11 w-full rounded-lg bg-blue-600 px-5 text-sm font-semibold text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300">Submit</button>
    </form>
    <h2 class="text-lg font-semibold text-emerald-900">Product preview - not saved</h2>
    <section class="mt-6 space-y-3 rounded-xl border border-emerald-200 bg-emerald-50 p-6">
      <?php if ($_SERVER["REQUEST_METHOD"] === "POST" && count($errors) === 0): ?>

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
        <ul class="mt-6 list-inside list-disc space-y-1 rounded-xl border border-red-200 bg-red-50 p-5 text-sm text-red-800">
          <?php foreach ($errors as $error): ?>
            <li><?= htmlspecialchars($error, ENT_QUOTES, "UTF-8") ?></li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>

    </section>


  </main>




  <?php require __DIR__ . "/include/footer.php"; ?>