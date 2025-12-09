<?php
    session_start();
    $_SESSION["fillOrdered"] = "100 ordered numbers were listed";
    $_SESSION["fillRandom"] = "100 random numbers were generated";
    $_SESSION["increment"] = "data has been incremented";
    $_SESSION["oddify"] = "data has been modified";
    $_SESSION["allEven"] = "allEven is ";
    $_SESSION["allOdd"] = "allOdd is ";
    $_SESSION["multipleOf12found"] = "found ";
    $_SESSION["multipleOf12absent"] = "no multiple of 12";
    $_SESSION["skipremove"] = "data has been skip/removed";

    if($_SERVER['REQUEST_METHOD'] == "POST"){
        if(isset($_POST['fillOrdered'])){
            fillOrdered();
        } else if(isset($_POST['fillRandom'])){
            fillRandom();
        } else if(isset($_POST['increment'])){
            increment();
        } else if(isset($_POST['oddify'])){
            oddify();
        } else if(isset($_POST['allEven'])){
            allEven();
        } else if(isset($_POST['allOdd'])){
            allOdd();
        } else if(isset($_POST['multipleOf12'])){
            multipleOf12();
        } else if(isset($_POST['skipremove'])){
            skipremove();
        }
    }

    function fillOrdered(){
        $val1 = array();
        for($i = 0; $i < 100; $i++){
            array_push($val1, $i);
        }
        $val2 = $_SESSION["fillOrdered"];
        $_SESSION["DATA1"] = $val1;
        $_SESSION["DATA2"] = $val2;
    }

    function fillRandom(){
        $val1 = array();
        for($i = 0; $i < 100; $i++){
            array_push($val1, rand(0, 99));
        }
        $val2 = $_SESSION["fillRandom"];
        $_SESSION["DATA1"] = $val1;
        $_SESSION["DATA2"] = $val2;
    }

    function increment(){
        $val1 = $_SESSION["DATA1"];
        for($i = 0; $i < count($val1); $i++){
            $val1[$i] = $val1[$i] + 1;
        }
        $val2 = $_SESSION["increment"];
        $_SESSION["DATA1"] = $val1;
        $_SESSION["DATA2"] = $val2;
    }

    function oddify(){
        $val1 = $_SESSION["DATA1"];
        for($i = 0; $i < count($val1); $i++){
            $val1[$i] = ($val1[$i] * 2) + 1;
        }
        $val2 = $_SESSION["oddify"];
        $_SESSION["DATA1"] = $val1;
        $_SESSION["DATA2"] = $val2;
    }

    function allEven(){
        $val1 = $_SESSION["DATA1"];
        $isthereodd = false;
        for($i = 0; $i < count($val1); $i++){
            if($val1[$i] % 2 != 0){
                $isthereodd = true;
                break;
            }
        }
        $val2 = $_SESSION["allEven"];
        if($isthereodd){
            $val2 = $val2 . "false";
        } else {
            $val2 = $val2 . "true";
        }
        $_SESSION["DATA2"] = $val2;
    }

    function allOdd(){
        $val1 = $_SESSION["DATA1"];
        $isthereeven = false;
        for($i = 0; $i < count($val1); $i++){
            if($val1[$i] % 2 != 1){
                $isthereeven = true;
                break;
            }
        }
        $val2 = $_SESSION["allOdd"];
        if($isthereeven){
            $val2 = $val2 . "false";
        } else {
            $val2 = $val2 . "true";
        }
        $_SESSION["DATA2"] = $val2;
    }

    function multipleOf12(){
        $val1 = $_SESSION["DATA1"];
        $position = -1;
        for($i = 0; $i < count($val1); $i++){
            if($val1[$i] % 12 == 0){
                $position = $i;
                break;
            }
        }
        $val2 = "";
        if($position != -1){
            $val2 = $_SESSION["multipleOf12found"] . $val1[$position];
        } else {
            $val2 = $_SESSION["multipleOf12absent"];
        }
        $_SESSION["DATA2"] = $val2;
    }

    function skipremove(){
        $val1OLD = $_SESSION["DATA1"];
        $val1NEW = array();
        for($i = 1; $i <= count($val1OLD); $i += 2){
            $val1NEW[] = $val1OLD[$i];
        }
        $val2 = $_SESSION["skipremove"];
        $_SESSION["DATA1"] = $val1NEW;
        $_SESSION["DATA2"] = $val2;
    }

    if(isset($_SESSION["DATA1"])){
        $val1 = $_SESSION["DATA1"];
    } else {
        $val1 = array();
    }
    if(isset($_SESSION["DATA2"])){
        $val2 = $_SESSION["DATA2"];
    } else {
        $val2 = "";
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Assignment 9</title>
        <style>
            .DataField {
                margin-left: 100px;
                margin-right: 100px;
                padding-left: 4px;
                padding-right: 4px;
                outline: 2px solid black;
            }

            .button {
                background-color: #9f9d9c;
                border: none;
                padding: 10px;
                text-align: center;
                display: inline-block;
                font-size: 20px;
            }

            .button:hover {
                background-color: #757575;
            }
        </style>
    </head>
    <body>
        <h1>Data</h1>
        <div class="DataField">
            <?php 
                $val1str = "";
                for($i = 0; $i < count($val1); $i++){
                    $val1str = $val1str . $val1[$i] . " "; 
                }
                echo "<p>$val1str</p>";
            ?>
        </div>

        <h1>Result of last command</h1>
        <div class="DataField">
            <?php
                echo "<p>$val2</p>";
            ?>
        </div>

        <h1>Controls</h1>
        <form action="index.php" method="post">
            <input class="button" type="submit" name="fillOrdered" value="Fill Ordered" />
            <input class="button" type="submit" name="fillRandom" value="Fill Random" />
            <input class="button" type="submit" name="increment" value="Increment" />
            <input class="button" type="submit" name="oddify" value="Oddify" />
            <input class="button" type="submit" name="allEven" value="All Even?" />
            <input class="button" type="submit" name="allOdd" value="All Odd?" />
            <input class="button" type="submit" name="multipleOf12" value="Multiple of 12" />
            <input class="button" type="submit" name="skipremove" value="Skip / Remove" />
        </form>
    </body>
</html>