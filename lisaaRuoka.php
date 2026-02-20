<?php    
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    try{
        $yhteys=mysqli_connect("db", "root", "password", "lounas");
    }
    catch(Exception $e){
        exit;
    }

    $json=isset($_POST["Ruuat"]) ? $_POST["Ruuat"] : "";

    if (!($Ruuat=tarkistaJson($json))) {
        print "Et ole täyttänyt kaikkia kohtia";
        
    }

    $sql="insert into Ruuat (ruokaNimi, ruokaHinta) values (?, ?)";
    $stmt=mysqli_prepare($yhteys,$sql);
    mysqli_stmt_bind_param($stmt, "sd", $Ruuat->ruokaNimi, $Ruuat->ruokaHinta);
    mysqli_stmt_execute($stmt);

    mysqli_close($yhteys);

    print $json;

?>

<?php

   function tarkistaJson($json) {
    if (empty($json)) {
        return false;
    }
    $Ruuat=json_decode($json, false);
    if (empty($Ruuat->ruokaNimi) || empty($Ruuat->ruokaHinta)) {
        return false;
    }
    return $Ruuat;
}
?>
