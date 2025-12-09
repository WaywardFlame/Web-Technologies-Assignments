<?php
if(isset($_GET["firstName"])){
    $firstname = $_GET["firstName"];
} else {
    $firstname = "";
}

if(isset($_GET["lastName"])){
    $lastname = $_GET["lastName"];
    $lnValid = true;
    $lnValid = (strlen($lastname) >= 4 || $lastname === "" || $lastname === null);
} else {
    $lastname = "";
    $lnValid = true;
}

if(isset($_GET["password"])){
    $password = $_GET["password"];
} else {
    $password = "";
}

if(isset($_GET["comMethod"])){
    $comMethod = $_GET["comMethod"];
} else {
    $comMethod = "";
}

if(isset($_GET["Marketing"])){
    $marketCheck = $_GET["Marketing"];
} else {
    $marketCheck = "";
}

if(isset($_GET["Promotions"])){
    $promoCheck = $_GET["Promotions"];
} else {
    $promoCheck = "";
}

if(isset($_GET["Announcements"])){
    $announceCheck = $_GET["Announcements"];
} else {
    $announceCheck = "";
}

if(isset($_GET["EmailBox"])){
    $email = $_GET["EmailBox"];
    $explodedEmail = explode("@", $email);
    $domain = array_pop($explodedEmail);
    $emValid = true;
    $emValid = ($comMethod !== "EmailRadio" || $comMethod === "" || $domain === "utsa.edu" || $domain === "my.utsa.edu");
} else {
    $email = "";
    $emValid = true;
}

if(isset($_GET["PhoneNum"])){
    $phone = $_GET["PhoneNum"];
} else {
    $phone = "";
}

if(isset($_GET["Message"])){
    $message = $_GET["Message"];
} else {
    $message = "";
}

$submitValid = true;
if(isset($_GET["urgentSubmit"])){
    if($comMethod === "EmailRadio"){
        $submitValid = false;
    }
}

if($lnValid && $emValid && $submitValid){
    $firstname = "";
    $lastname = "";
    $password = "";
    $comMethod = "";
    $marketCheck = "";
    $promoCheck = "";
    $announceCheck = "";
    $email = "";
    $phone = "";
    $message = "";
}
?>

<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="utf-8">
        <title>Assignment 10</title>
        <link rel="stylesheet" href="./styles.css">
        <script src="./hw10.js"></script>
    </head>
    <body>
        <div class="Confirmation">
            <p id="ClientValidation"></p>
            <p id="ServerValidation">
                <?php
                if(!$lnValid){ echo "last name not in valid format: must be at least 4 characters long<br/>"; }
                if(!$emValid){ echo "email not valid: must be a utsa email address<br/>"; }
                if(!$submitValid){ echo "urgent requests must be through voice / sms<br/>"; }
                if($lnValid && $submitValid && (isset($_GET["normalSubmit"]) || isset($_GET["urgentSubmit"]))){
                    echo "information received correctly";
                }
                ?>
            </p>
        </div>

        <div class="InputForm">
            <form id="hwTenForm" action="index.php" method="GET">
                <label for="firstName">First Name:</label><br/>
                <input type="text" id="firstName" name="firstName" value=<?php echo '"'.$firstname.'"'; ?> required><br/>

                <label for="lastName">Last Name:</label><br/>
                <input type="text" id="lastName" name="lastName" value=<?php echo '"'.$lastname.'"'; ?> required><br/>

                <label for="password">Password:</label><br/>
                <input type="password" id="password" name="password" value=<?php echo '"'.$password.'"'; ?> required><br/><br/>

                <label for="voice">Preferred Method of Communication:</label><br/>
                <input type="radio" id="voice" name="comMethod" value="voice" onclick="enablePhone()">
                <label for="voice">Voice</label>

                <input type="radio" id="SMS" name="comMethod" value="SMS" onclick="enablePhone()">
                <label for="SMS">SMS</label>

                <input type="radio" id="EmailRadio" name="comMethod" value="EmailRadio" onclick="enableEmail()" checked>
                <label for="EmailRadio">Email</label><br/><br/>

                <label for="Marketing">Services interested in:</label><br/>
                <input type="checkbox" id="Marketing" name="Marketing" value="Marketing">
                <label for="Marketing"> Marketing</label><br/>

                <input type="checkbox" id="Promotions" name="Promotions" value="Promotions">
                <label for="Promotions"> Promotions</label><br/>

                <input type="checkbox" id="Announcements" name="Announcements" value="Announcements">
                <label for="Announcements"> Announcements</label><br/><br/>

                <label for="EmailBox">Email:</label><br/>
                <input type="email" id="EmailBox" name="EmailBox" value=<?php echo '"'.$email.'"'; ?>><br/>

                <label for="PhoneNum">Phone Number:</label><br/>
                <input type="text" id="PhoneNum" name="PhoneNum" value=<?php echo '"'.$phone.'"'; ?> disable><br/>

                <label for="Message">Want to leave a message?</label><br/>
                <input type="text" id="Message" name="Message" value=<?php echo '"'.$message.'"'; ?>><br/><br/>

                <input type="submit" id="normalSubmit" name="normalSubmit" value="normal" class="button">
                <input type="submit" id="urgentSubmit" name="urgentSubmit" value="urgent" class="button">
                <input type="reset" id="resetButton" name="resetButton" value="reset" class="button">
            </form>
        </div>
    </body>
</html>