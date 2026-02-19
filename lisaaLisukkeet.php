<?php    
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    try{
        $yhteys=mysqli_connect("db", "root", "password", "lounas");
    }
    catch(Exception $e){
        exit;
    }

     $json3=isset($_POST["Lisukkeet"]) ? $_POST["Lisukkeet"] : "";

    if (!($Lisukkeet=tarkista3Json($json3))) {
        print "Et ole täyttänyt kaikkia kohtia";
        
    }

     $sql3="insert into Lisukkeet (lisukeNimi, lisukeHinta) values (?, ?)";
    $stmt3=mysqli_prepare($yhteys,$sql3);
    mysqli_stmt_bind_param($stmt3, "sd", $Lisukkeet->lisukeNimi, $Lisukkeet->lisukeHinta);
    mysqli_stmt_execute($stmt3);

    mysqli_close($yhteys);

    print $json3;
?>

    <?php

function tarkista3Json($json3) {
    if (empty($json3)) {
        return false;
    }
    $Lisukkeet=json_decode($json3, false);
    if (empty($Lisukkeet->lisukeNimi) || empty($Lisukkeet->lisukeHinta)) {
        return false;
    }
    return $Lisukkeet;
}

?>
