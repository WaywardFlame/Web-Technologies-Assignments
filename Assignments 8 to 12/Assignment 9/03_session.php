<?php
    define('KEY','foo') ; 

    session_start() ; 

    if (isset($_GET['reset'])) {
        unset($_SESSION[KEY]) ; 
    }
    
    if (isset($_SESSION[KEY])) {
        $val = $_SESSION[KEY] ; 
    } else {
        $val = 1 ; 
    }
    $_SESSION[KEY] = $val+1 ; 
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Testing sessions</title>
    </head>
<body>
    <?php
    if ($val==1) {
        echo '<p>This is your <b>first</b> visit</p>';
    } else {
        echo "<p>This is your $val visit</p>" ; 
    }
    ?>
</body>
</html>
