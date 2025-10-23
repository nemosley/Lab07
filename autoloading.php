<?php
/**
 * Author: Charley Corneil
 * Date: 10/23/25
 * File: autoloading.php
 * Description: implements autoloading for our php classes
 */


//convert a camel cased string to a underscored string
function camelCaseToUnderscore($str)
{
    //store all characters in an array
    $characters = str_split($str);

    //covert the first character to a lowercase
    $characters[0] = strtolower($characters[0]);

    //exam all characters in the array
    //if a character is uppercase, replace it with a lowercase and prefix it with an underscore
    foreach ($characters as &$character) {
        if (ord($character) >= ord('A') && ord($character) <= ord('Z'))
            $character = '_' . strtolower($character);
    }

    //convert all elements in the array into a string and return the string
    return implode('', $characters);
}

//this function automatically loads class file when a new object is instantiated
spl_autoload_register(function ($class_name) {
    require_once camelCaseToUnderscore($class_name) . '.class.php';
});
