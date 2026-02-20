<?php    
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
ini_set('display_errors', 0);
header('Content-Type: application/json; charset=utf-8');

    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    try{
        $yhteys=mysqli_connect("db", "root", "password", "lounas");
    }
    catch(Exception $e){
        exit;
    }

    $tulos=mysqli_query($yhteys, "select * from Ruuat");
    $tulos2=mysqli_query($yhteys, "select * from Juomat");
    $tulos3=mysqli_query($yhteys, "select * from Lisukkeet");

    $ruoka=[];
    $juoma=[];
    $lisuke=[];


    while ($rivi=mysqli_fetch_object($tulos)){
        $r = new stdClass();
    $r->ruokaId = $rivi->RuokaID;       
    $r->ruokaNimi = $rivi->RuokaNimi;
    $r->ruokaHinta = $rivi->RuokaHinta;
    $ruoka[] = $r;
    }
    while ($rivi=mysqli_fetch_object($tulos2)){
        $j = new stdClass();
    $j->juomaId = $rivi->JuomaID;
    $j->juomaNimi = $rivi->JuomaNimi;
    $j->juomaHinta = $rivi->JuomaHinta;
    $juoma[] = $j;
    }
    while ($rivi=mysqli_fetch_object($tulos3)){
        $l = new stdClass();
    $l->LisukeId = $rivi->LisukeID;
    $l->lisukeNimi = $rivi->LisukeNimi;
    $l->lisukeHinta = $rivi->LisukeHinta;
    $lisuke[] = $l;

    }

    

    $vastaus=[
        "Ruuat"=>$ruoka,
        "Juomat"=>$juoma,
        "Lisukkeet"=>$lisuke
    ];


    
    mysqli_close($yhteys);
    print json_encode($vastaus);
?>
    
    
