<?php
/**
 * Author: Charley Corneil
 * Date: 10/23/25
 * File: test_payable.php
 * Description: Client that tests all classes in the Payable hierarchy.
 *    - Demonstrates polymorphism via Payable[]
 *    - Prints string representation of each object via toString(): void
 *    - Displays static counts for Employee and Invoice
 */

declare(strict_types=1);

// Per spec, use autoloading
require_once __DIR__ . '/autoloading.php';  // spl_autoload_register + camelCaseToUnderscore  :contentReference[oaicite:11]{index=11}

// ---- Create sample domain objects ----

// Persons
$p1 = new Person("Ada", "Lovelace");
$p2 = new Person("Alan", "Turing");
$p3 = new Person("Grace", "Hopper");
$p4 = new Person("Katherine", "Johnson");

// Employees (all implement Payable)  // polymorphism requirement  :contentReference[oaicite:12]{index=12}
$salEmp      = new SalariedEmployee($p1, "111-11-1111", 1500.00);
$hourEmp     = new HourlyEmployee($p2, "222-22-2222", 22.50, 42);
$commEmp     = new CommissionEmployee($p3, "333-33-3333", 8000, 0.06);
$baseCommEmp = new BasePlusCommissionEmployee($p4, "444-44-4444", 12000, 0.05, 500.00);

// Invoices (also Payable)
$inv1 = new Invoice("A-100", "USB-C Cables (10-pack)", 3, 12.95);
$inv2 = new Invoice("B-250", "24\" Monitor", 2, 139.99);

// ---- Polymorphic processing of Payable objects ----
$payables = [$salEmp, $hourEmp, $commEmp, $baseCommEmp, $inv1, $inv2];

?><!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Lab 7 — Test Payable</title>
    <style>
        body { font-family: system-ui, -apple-system, Segoe UI, Roboto, Arial, sans-serif; margin: 2rem; line-height: 1.45; }
        .card { border: 1px solid #ddd; border-radius: 8px; padding: 1rem 1.25rem; margin-bottom: 1rem; }
        .type { font-weight: 700; margin-bottom: 0.25rem; }
        pre { margin: 0.25rem 0 0.5rem; white-space: pre-wrap; }
        .counts { margin-top: 2rem; padding-top: 1rem; border-top: 2px solid #eee; font-weight: 600; }
    </style>
</head>
<body>
<h1>Accounts Payable — Polymorphic Test</h1>
<p>This page processes Employees and Invoices through a common <code>Payable</code> interface and prints each item’s details and payment due.</p>

<?php foreach ($payables as $idx => $item): ?>
    <div class="card">
        <div class="type">
            <?= htmlspecialchars((new ReflectionClass($item))->getName(), ENT_QUOTES, 'UTF-8'); ?>
            (object #<?= $idx + 1 ?>)
        </div>
        <pre><?php $item->toString(); /* required toString(): void */ ?></pre>
        <div>Payment Amount: $<?= number_format($item->getPaymentAmount(), 2); ?></div>
    </div>
<?php endforeach; ?>

<div class="counts">
    <?php
    // Static counts must be shown per spec:
    // Employee::getEmployeeCount() and Invoice::getInvoiceCount()  :contentReference[oaicite:13]{index=13} :contentReference[oaicite:14]{index=14}
    $employeeCount = Employee::getEmployeeCount();
    $invoiceCount  = Invoice::getInvoiceCount();
    ?>
    <div>Total Employee objects created: <?= (int)$employeeCount; ?></div>
    <div>Total Invoice objects created: <?= (int)$invoiceCount; ?></div>
</div>
</body>
</html>