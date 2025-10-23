<?php
/*
 * Author: Nevaeh Mosley
 * Date: 2025-10-23
 * Name: payable.class.php
 * Description: Payable interface implemented by Employee and Invoice.
 */
declare(strict_types=1);

interface Payable
{
    // As specified in the UML: +getPaymentAmount: float, +toString: void
    public function getPaymentAmount(): float;
    public function toString(): void;
}
