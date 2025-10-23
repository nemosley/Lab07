<?php
/**
 * Author: Benjamin Egger-Torke
 * Date: 10/22/25
 * File: hourly_employee.class.php
 * Description: Creates the Hourly Employee class
 **/

class HourlyEmployee extends Employee {
    private float $wage;
    private int $hours;

    public function __construct(Person $person, string $ssn, float $wage, int $hours) {
        parent::__construct($person, $ssn);
        $this->wage = $wage;
        $this->hours = $hours;
    }

    public function getWage(): float
    {
        return $this->wage;
    }

    public function getHours(): int
    {
        return $this->hours;
    }
    public function getPaymentAmount(): float {
        return $this->hours * $this->wage;
    }
    public function toString(): void {
        parent::toString();
        echo "Wage: ".$this->wage."\n";
        echo "Hours: ".$this->hours."\n";
    }

}