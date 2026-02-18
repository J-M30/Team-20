<?php    
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
        $r=new class{};
        $r->ruokaId=$rivi->ruokaId;
        $r->ruokaNimi=$rivi->ruokaNimi;
        $r->ruokaHinta=$rivi->ruokaHinta;
        $ruoka[]=$r;
    }
    while ($rivi=mysqli_fetch_object($tulos2)){
        $j=new class{};
        $j->juomaId=$rivi->juomaId;
        $j->juomaNimi=$rivi->juomaNimi;
        $j->juomaHinta=$rivi->juomaHinta;
        $juoma[]=$j;
    }
    while ($rivi=mysqli_fetch_object($tulos3)){
        $l=new class{};
        $l->LisukeId=$rivi->LisukeId; 
        $l->lisukeNimi=$rivi->lisukeNimi; 
        $l->lisukeHinta=$rivi->lisukeHinta;
        $lisuke[]=$l;

    }

    

    $vastaus=[
        "Ruuat"=>$ruoka,
        "Juomat"=>$juoma,
        "Lisukkeet"=>$lisuke
    ];


    
    mysqli_close($yhteys);
    print json_encode($vastaus);
?>



    
    
    
    
    
