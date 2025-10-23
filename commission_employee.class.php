<?php
/**
 * Author: Charley Corneil
 * Date: 10/23/25
 * File: commission_employee.class.php
 * Description: CommissionEmployee class (inherits Employee). Paid commission_rate * sales.
 */

declare(strict_types=1);

class CommissionEmployee extends Employee implements Payable
{
    /** @var int */
    private int $sales;

    /** @var float */
    private float $commission_rate;

    /**
     * + __construct  (UML)  → takes Person + SSN + sales + commission_rate
     * @param Person $person
     * @param string $ssn
     * @param int $sales non-negative
     * @param float $commission_rate 0.0..1.0 (e.g., 0.06 means 6%)
     */
    public function __construct(Person $person, string $ssn, int $sales, float $commission_rate)
    {
        parent::__construct($person, $ssn);

        if ($sales < 0) {
            throw new InvalidArgumentException("Sales must be >= 0");
        }
        if ($commission_rate < 0.0 || $commission_rate > 1.0) {
            throw new InvalidArgumentException("Commission rate must be between 0.0 and 1.0");
        }

        $this->sales = $sales;
        $this->commission_rate = $commission_rate;
    }

    /** +getSales: integer (UML) */  // :contentReference[oaicite:4]{index=4}
    public function getSales(): int
    {
        return $this->sales;
    }

    /** +getCommissionRate: float (UML) */  // :contentReference[oaicite:5]{index=5}
    public function getCommissionRate(): float
    {
        return $this->commission_rate;
    }

    /** +getPaymentAmount: float (UML) */  // :contentReference[oaicite:6]{index=6}
    public function getPaymentAmount(): float
    {
        return $this->commission_rate * $this->sales;
    }

    /**
     * +toString: void (UML). Print a human-readable representation.
     * NOTE: Lab requires a toString(): void on Payable.  // :contentReference[oaicite:7]{index=7}
     */
    public function toString(): void
    {
        $person = $this->getPerson();
        $ratePct = number_format($this->commission_rate * 100, 2) . "%";
        $pay = number_format($this->getPaymentAmount(), 2);

        echo "Commission Employee: {$person}\n"
            . "SSN: {$this->getSSN()}\n"
            . "Sales: {$this->sales}\n"
            . "Commission Rate: {$ratePct}\n"
            . "Weekly Pay: \${$pay}\n";
    }
}
