<?php
/**
 * Author: Benjamin Egger-Torke
 * Date: 10/22/25
 * File: person.class.php
 * Description: Implements the person class
 **/

class Person {
    private string $first_name;
    private string $last_name;

    public function __contruct($first_name, $last_name) {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
    }

    public function getFirstName(): string
    {
        return $this->first_name;
    }

    public function getLastName(): string
    {
        return $this->last_name;
    }
    //toString : Prints the name
    public function toString(): void {
        echo $this->first_name . " " . $this->last_name;
    }

}