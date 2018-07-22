<?php

class LogIn {
    
    var $test = "hi";
    
    function getHi($name){
        echo $this->test . " " .$name;
    }
}


$myTest = new LogIn;

$myTest->getHi("tony");

?>