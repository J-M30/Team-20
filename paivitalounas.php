<?php
//Luetaan lomakkeelta tulleet tiedot funktiolla $_POST
//jos syötteet ovat olemassa
$id = isset($_POST["id"]) ? $_POST["id"] : "";
$taulu = isset($_POST["taulu"]) ? $_POST["taulu"] : "";
$nimi = isset($_POST["nimi"]) ? $_POST["nimi"] : "";
$hinta = isset($_POST["hinta"]) ? $_POST["hinta"] : 0;

//Jos ei jompaa kumpaa tai kumpaakaan tietoa ole annettu
//ohjataan pyyntö takaisin lomakkeelle
if (empty($id) || empty($taulu) || empty($nimi)){
    header("Location: menu.html");
    exit;
}

mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);
// mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try{
    $yhteys=mysqli_connect("db", "root", "password", "lounas");
}
catch(Exception $e){
    header("Location: ../html/yhteysvirhe.html");
    exit;
}

//Tehdään sql-lause, jossa kysymysmerkeillä osoitetaan paikat
//joihin laitetaan muuttujien arvoja

//
if ($taulu == "Ruuat") {
    $sql = "UPDATE Ruuat SET ruokaNimi=?, ruokaHinta=? WHERE ruokaId=?";
} elseif ($taulu == "Juomat") {
    $sql = "UPDATE Juomat SET juomaNimi=?, juomaHinta=? WHERE juomaId=?";
} elseif ($taulu == "Lisukkeet") {
    $sql = "UPDATE Lisukkeet SET lisukeNimi=?, lisukeHinta=? WHERE LisukeId=?";
}

//Valmistellaan sql-lause
$stmt=mysqli_prepare($yhteys, $sql);
//Sijoitetaan muuttujat oikeisiin paikkoihin
mysqli_stmt_bind_param($stmt, 'sdi', $nimi, $hinta, $id);
//Suoritetaan sql-lause
mysqli_stmt_execute($stmt);
//Suljetaan tietokantayhteys
mysqli_close($yhteys);

header("Location:menu.html");
exit;

?>
