<?php

$html = "<!DOCTYPE html> <html> <head> <title>Homework #8</title> </head> <body> <h1>Homework #8</h1>";

$html = $html . " <h2>First 100 odds</h2> <p id=\"odds\">";
$oddnums = "";
for($i = 1; $i <= 200; $i++){
    if($i % 2 === 1){
        if($i === 199){
            $oddnums = $oddnums . "and " . $i . ".";
            break;
        }
        $oddnums = $oddnums . $i . ", ";
    }
}
$html = $html . $oddnums . "</p>";

$html = $html . " <h2>First 100 Fibonacci's</h2> <p id=\"fibo\">";
$fiboNums = "";
$prevNum1 = 0;
$prevNum2 = 1;
$newNum = 1;
for($i = 1; $i <= 100; $i++){
    $fiboNums = $fiboNums . $newNum . " ";
    $newNum = $prevNum1 + $prevNum2;
    $prevNum1 = $prevNum2;
    $prevNum2 = $newNum;
}
$html = $html . $fiboNums . "</p>";

$html = $html . " <h2>Primes less than 100</h2> <p id=\"primes\">";
$primeNums = "";
for($i = 2; $i < 100; $i++){
    $isPrime = true;
    for($k = 2; $k < 100; $k++){
        if($k === $i){
            continue;
        } else if($i % $k === 0){
            $isPrime = false;
        }
    }
    if($isPrime){
        $primeNums = $primeNums . $i . " ";
    }
}
$html = $html . $primeNums . "</p>";

$html = $html . " </body> </html>";

echo $html;

?>