<?php
/*
 * Author: Nevaeh Mosley
 * Date: 2025-10-23
 * Name: invoice.class.php
 * Description: Invoice class that implements Payable and tracks the number of Invoice objects.
 */
declare(strict_types=1);

require_once __DIR__ . '/payable.class.php';

class Invoice implements Payable
{
    // -------- static member (tracks number of Invoice objects) --------
    private static int $invoice_count = 0;  // matches UML: -invoice_count: integer

    // -------- attributes (match UML names/types) --------
    private string $part_number;               // UML shows getPartNumber: integer
    private string $part_description;
    private int $quantity;
    private float $price_per_item;

    // -------- constructor --------
    public function __construct(int $part_number, string $part_description, int $quantity, float $price_per_item)
    {
        $this->part_number      = $part_number;
        $this->part_description = $part_description;
        $this->quantity         = $quantity;
        $this->price_per_item   = $price_per_item;

        self::$invoice_count++; // increment static counter
    }

    // -------- getters (as in UML) --------
    public function getPartNumber(): int { return $this->part_number; }
    public function getPartDescription(): string { return $this->part_description; }
    public function getQuantity(): int { return $this->quantity; }
    public function getPricePerItem(): float { return $this->price_per_item; }

    // -------- Payable implementation --------
    public function getPaymentAmount(): float
    {
        return $this->quantity * $this->price_per_item;
    }

    public function toString(): void
    {
        echo "<h3>Invoice</h3>";
        echo "<b>Part Number:</b> {$this->part_number}<br>";
        echo "<b>Description:</b> {$this->part_description}<br>";
        echo "<b>Quantity:</b> {$this->quantity}<br>";
        echo "<b>Price per item:</b> " . number_format($this->price_per_item, 2) . "<br>";
        echo "<b>Payment due:</b> " . number_format($this->getPaymentAmount(), 2) . "<br>";
    }

    // -------- static method (as in UML: +getInvoiceCount: integer) --------
    public static function getInvoiceCount(): int
    {
        return self::$invoice_count;
    }
}
