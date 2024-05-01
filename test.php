<?php

error_reporting(E_ALL);
            ini_set('display_errors', 1);

class MyClass {
    private $data = [];

    public function __set($name, $value) {
        if (!isset($this->data[$name])) {
            $this->data[$name] = [];
        }
        $this->data[$name][] = $value;
    }
}

$obj = new MyClass();
$obj->my_array['next'] = "Test 1"; // Sets an element in the array
$obj->my_array['after'] = "Test 2"; // Adds another element
$obj->mine = "Test 3"; // Adds another element
print_r($obj); // Output: Array([0] => Test 1 [1] => Test 2)