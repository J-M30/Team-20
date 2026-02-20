<?php

//tarkistetaan onko urlissa ?poistettava=ID
if (isset($_GET["poistettava"])) {
    $poistettava = $_GET["poistettava"];
}

//tarkistetaan onko urlissa myös mistä taulusta poistetaan
if (isset($_GET["taulu"])) {
    $taulu = $_GET["taulu"];
}


mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);


try {
    $yhteys = mysqli_connect("db", "root", "password", "lounas");
}
catch(Exception $e) {
    print "mee kotio";
    exit;
}




//poisto suoritetaan vain jos molemmat parametrit löytyvät
if (isset($poistettava) && isset($taulu)) {

    //valitaan oikea sql-lause sen mukaan mistä taulusta poistetaan
    if ($taulu == "Ruuat") {
        $sql = "DELETE FROM Ruuat WHERE ruokaId=?";
    }
    elseif ($taulu == "Juomat") {
        $sql = "DELETE FROM Juomat WHERE juomaId=?";
    }
    elseif ($taulu == "Lisukkeet") {
        $sql = "DELETE FROM Lisukkeet WHERE LisukeId=?";
    }

    //stmt=statement eli tehdään sql-lause
    $stmt = mysqli_prepare($yhteys, $sql);

    //sidotaan muuttuja ?-paikkaan (i = integer)
    mysqli_stmt_bind_param($stmt, 'i', $poistettava);

    //poistaa
    mysqli_stmt_execute($stmt);
}


//taulujen tiedot

// Haetaan kaikki ruuat, juomat ja lisukkeet
$ruuat = mysqli_query($yhteys, "SELECT * FROM Ruuat");

$juomat = mysqli_query($yhteys, "SELECT * FROM Juomat");

$lisukkeet = mysqli_query($yhteys, "SELECT * FROM Lisukkeet");


//ruoat

print "<h2>Ruuat</h2>";
print "<ol>";

//käydään jokainen ruoka läpi
while ($rivi = mysqli_fetch_object($ruuat)) {

    //tulostetaan ruoan tiedot ja poistamislinkki
    print "<li>
        RuokaID=$rivi->ruokaId 
        Nimi=$rivi->ruokaNimi 
        Hinta=$rivi->ruokaHinta €
        <a href='poisto.php?taulu=Ruuat&poistettava=".$rivi->ruokaId."'>Poista</a>
    </li>";
}

print "</ol>";


//juomat

print "<h2>Juomat</h2>";
print "<ol>";

while ($rivi = mysqli_fetch_object($juomat)) {

    // Sama logiikka kuin ruuissa
    print "<li>
        JuomaID=$rivi->juomaId 
        Nimi=$rivi->juomaNimi 
        Hinta=$rivi->juomaHinta €
        <a href='poisto.php?taulu=Juomat&poistettava=".$rivi->juomaId."'>Poista</a>
    </li>";
}

print "</ol>";


//lisukkeiden tulostus

print "<h2>Lisukkeet</h2>";
print "<ol>";

while ($rivi = mysqli_fetch_object($lisukkeet)) {

    print "<li>
        LisukeID=$rivi->LisukeId 
        Nimi=$rivi->lisukeNimi 
        Hinta=$rivi->lisukeHinta €
        <a href='poisto.php?taulu=Lisukkeet&poistettava=".$rivi->LisukeId."'>Poista</a>
    </li>";
}

print "</ol>";



mysqli_close($yhteys);

?>
