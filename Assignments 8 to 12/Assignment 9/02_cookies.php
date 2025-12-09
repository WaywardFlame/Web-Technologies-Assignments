<?php
    define('KEY','foo') ; 

    if (isset($_COOKIE[KEY])) {
        $val = $_COOKIE[KEY] ; 
    } else {
        $val = 0 ; 
    }
    setcookie(KEY,$val+1,array('SameSite'=>'Strict')) ; 
?>
<html>
    <head>
        <title>Testing Cookies</title>
    </head>
<body>
    <p>Value of cookie is: <?= $val ?></p>
</body>
</html>
