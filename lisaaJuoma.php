<?php    
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    try{
        $yhteys=mysqli_connect("db", "root", "password", "lounas");
    }
    catch(Exception $e){
        exit;
    }

    $json2=isset($_POST["Juomat"]) ? $_POST["Juomat"] : "";

    if (!($Juomat=tarkista2Json($json2))) {
        print "Et ole täyttänyt kaikkia kohtia";
        
    }

    $sql2="insert into Juomat (juomaNimi, juomaHinta) values (?, ?)";
    $stmt2=mysqli_prepare($yhteys,$sql2);
    mysqli_stmt_bind_param($stmt2, "sd", $Juomat->juomaNimi, $Juomat->juomaHinta);
    mysqli_stmt_execute($stmt2);

    mysqli_close($yhteys);

    print $json2;

?>
<?php

    
    function tarkista2Json($json2) {
    if (empty($json2)) {
        return false;
    }
    $Juomat=json_decode($json2, false);
    if (empty($Juomat->juomaNimi) || empty($Juomat->juomaHinta)) {
        return false;
    }
    return $Juomat;
}

?>
