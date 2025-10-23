<?php
/**
 * Author: Benjamin Egger-Torke
 * Date: 10/22/25
 * File: salaried_employee.class.php
 * Description: creates the salaried employee class
 **/

class SalariedEmployee extends Employee {
    private float $weekly_salary;

    public function __construct(Person $person, string $ssn, float $weekly_salary) {
        parent::__construct($person, $ssn);
        $this->weekly_salary = $weekly_salary;
    }
    public function getWeeklySalary(): float {
        return $this->weekly_salary;
    }
    public function getPaymentAmount(): float {
        return $this->weekly_salary;
    }
    public function toString(): void {
        echo "Weekly salary: ".$this->weekly_salary."\n";
    }
}