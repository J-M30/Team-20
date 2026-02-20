<?php    
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    try{
        $yhteys=mysqli_connect("db", "root", "password", "lounas");
    }
    catch(Exception $e){
        exit;
    }

    $json=isset($_POST["user"]) ? $_POST["user"] : "";

    if (!($user=tarkistaJson($json))) {
        print "Et ole täyttänyt kaikkia kohtia";
        
    }

    $sql="insert into kayttaja (tunnus, salasana) values (?, SHA2(?, 256)";
    try{
       $stmt=mysqli_prepare($yhteys,$sql);
        mysqli_stmt_bind_param($stmt, "ss", $user->tunnus, $user->salasana);
        mysqli_stmt_execute($stmt);
        mysqli_close($yhteys);
        print $json;
    }
    catch (Exception $e){
        print "Väärin meni";
    }
?>
<?php

   function tarkistaJson($json) {
    if (empty($json)) {
        return false;
    }
    $user=json_decode($json, false);
    if (empty($user->tunnus) || empty($user->salasana)) {
        return false;
    }
    return $user;
}
?>
