<?php
/*
 * Author: Nevaeh Mosley
 * Date: 2025-10-23
 * Name: employee.class.php
 * Description: Abstract base class Employee (has-a Person via composition), implements Payable,
 *              and tracks the number of Employee objects created.
 */
declare(strict_types=1);

require_once __DIR__ . '/payable.class.php';
// Expect a Person class in person.class.php per lab handout UML.
// Example signature: class Person { /* __construct, getFirstName, getLastName, toString */ }

abstract class Employee implements Payable
{
    // -------- static member (tracks number of Employee objects) --------
    private static int $employee_count = 0; // UML: -employee_count: integer

    // -------- attributes (match UML names/types) --------
    protected Person $person;               // UML: -person: Person (composition)
    protected string $ssn;                  // UML: -ssn: String

    // -------- constructor --------
    public function __construct(Person $person, string $ssn)
    {
        $this->person = $person;
        $this->ssn    = $ssn;
        self::$employee_count++; // increment static counter
    }

    // -------- getters (as in UML) --------
    public function getPerson(): Person { return $this->person; }
    public function getSSN(): string { return $this->ssn; }

    // -------- Payable requirement --------
    abstract public function getPaymentAmount(): float;

    public function toString(): void
    {
        echo "<h3>Employee</h3>";
        // Person::toString() per UML; otherwise, use getters to print name.
        if (method_exists($this->person, 'toString')) {
            $this->person->toString();
            echo "<br>";
        }
        echo "<b>SSN:</b> {$this->ssn}<br>";
        echo "<b>Weekly pay:</b> " . number_format($this->getPaymentAmount(), 2) . "<br>";
    }

    // -------- static method (as in UML: +getEmployeeCount: integer) --------
    public static function getEmployeeCount(): int
    {
        return self::$employee_count;
    }
}
