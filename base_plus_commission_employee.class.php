<?php
/**
 * Author: Charley Corneil
 * Date: 10/23/25
 * File: base_plus_commission_employee.class.php
 * Description: BasePlusCommissionEmployee (inherits CommissionEmployee).
 *               Paid base_salary + (commission_rate * sales).
 */

declare(strict_types=1);

class BasePlusCommissionEmployee extends CommissionEmployee
{
    /** @var float */
    private float $base_salary;

    /**
     * +__construct (UML)  → Person, SSN, sales, commission_rate, base_salary
     * @param Person $person
     * @param string $ssn
     * @param int    $sales
     * @param float  $commission_rate
     * @param float  $base_salary        non-negative
     */
    public function __construct(
        Person $person,
        string $ssn,
        int $sales,
        float $commission_rate,
        float $base_salary
    ) {
        parent::__construct($person, $ssn, $sales, $commission_rate);

        if ($base_salary < 0.0) {
            throw new InvalidArgumentException("Base salary must be >= 0");
        }
        $this->base_salary = $base_salary;
    }

    /** +getBaseSalary: float (UML) */  // :contentReference[oaicite:8]{index=8}
    public function getBaseSalary(): float
    {
        return $this->base_salary;
    }

    /** +getPaymentAmount: float (UML) */  // :contentReference[oaicite:9]{index=9}
    public function getPaymentAmount(): float
    {
        return $this->base_salary + parent::getPaymentAmount();
    }

    /** +toString: void (UML) */  // :contentReference[oaicite:10]{index=10}
    public function toString(): void
    {
        // Reuse Commission details visually, then add base + total.
        $ratePct = number_format($this->getCommissionRate() * 100, 2) . "%";
        $commissionOnly = number_format(parent::getPaymentAmount(), 2);
        $base = number_format($this->base_salary, 2);
        $total = number_format($this->getPaymentAmount(), 2);
        $person = $this->getPerson();

        echo "Base + Commission Employee: {$person}\n"
            . "SSN: {$this->getSSN()}\n"
            . "Sales: {$this->getSales()}\n"
            . "Commission Rate: {$ratePct}\n"
            . "Base Salary: \${$base}\n"
            . "Commission Portion: \${$commissionOnly}\n"
            . "Total Weekly Pay: \${$total}\n";
    }
}
