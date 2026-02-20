<?php
header('Content-Type: application/json; charset=utf-8');
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $yhteys = mysqli_connect("db", "root", "password", "lounas");
} catch(Exception $e) {
    print json_encode(["status" => "error"]);
    exit;
}

//tarkistetaan etää tarvittavat GET-parametrit on annettu
if (!isset($_GET["poistettava"]) || !isset($_GET["taulu"])) {
    print json_encode(["status" => "error"]);
    exit;
}

//haetaan poistettava ID ja taulun nimi GET-parametreista
$poistettava = intval($_GET["poistettava"]);
$taulu = $_GET["taulu"];

//valitaan oikea SQL-lause taulun perusteella
if ($taulu == "Ruuat") {
    $sql = "DELETE FROM Ruuat WHERE ruokaId=?";
} elseif ($taulu == "Juomat") {
    $sql = "DELETE FROM Juomat WHERE juomaId=?";
} elseif ($taulu == "Lisukkeet") {
    $sql = "DELETE FROM Lisukkeet WHERE LisukeId=?";
}

//valmistellaan SQL-lause 
$stmt = mysqli_prepare($yhteys, $sql);

//sidotaan poistettava ID parametrina ja suoritetaan statement elit stmt
mysqli_stmt_bind_param($stmt, 'i', $poistettava);
mysqli_stmt_execute($stmt);

print json_encode(["status" => "ok"]);

mysqli_close($yhteys);
?>
