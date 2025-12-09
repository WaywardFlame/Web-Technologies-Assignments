"use strict";

let oddNums = "";
for(let i = 1; i <= 200; i++){
    if(i % 2 === 1){
        if(i === 199){
            oddNums += "and " + i.toString() + "."
            break;
        }
        oddNums += i.toString() + ", ";
    }
}
document.getElementById("odds").innerHTML = oddNums;

let fiboNums = "";
let prevNum1 = 0;
let prevNum2 = 1;
let newNum = 1;
for(let i = 1; i <= 100; i++){
    fiboNums += newNum.toString() + " ";
    newNum = prevNum1 + prevNum2;
    prevNum1 = prevNum2;
    prevNum2 = newNum;
}
document.getElementById("fibo").innerHTML = fiboNums;

let primeNums = "";
for(let i = 2; i < 100; i++){
    let isPrime = true;
    for(let k = 2; k < 100; k++){
        if(k === i){
            continue;
        } else if(i % k === 0){
            isPrime = false;
        }
    }
    if(isPrime){
        primeNums += i.toString() + " ";
    }
}
document.getElementById("primes").innerHTML = primeNums;