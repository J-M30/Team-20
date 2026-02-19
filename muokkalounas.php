<?php
// Käytetään vain muokattava-muuttujaa yhtenäisyyden vuoksi
$muokattava = isset($_GET["muokattava"]) ? $_GET["muokattava"] : "";
$taulu = isset($_GET["taulu"]) ? $_GET["taulu"] : "";

if (empty($muokattava) || empty($taulu)){
    header("Location: menu.html");
    exit;
}

mysqli_report(MYSQLI_REPORT_ALL ^ MYSQLI_REPORT_INDEX);

try {
    $yhteys = mysqli_connect("db", "root", "password", "lounas");
    
    // Haetaan VAIN ruuan tiedot
    // Valitaan oikea SQL-lause taulun perusteella
    if ($taulu == "Ruuat") {
        $sql = "SELECT * FROM Ruuat WHERE ruokaId = ?";
    } elseif ($taulu == "Juomat") {
        $sql = "SELECT * FROM Juomat WHERE juomaId = ?";
    } elseif ($taulu == "Lisukkeet") {
        $sql = "SELECT * FROM Lisukkeet WHERE LisukeId = ?";
    }

    $stmt = mysqli_prepare($yhteys, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $muokattava);
    mysqli_stmt_execute($stmt);
    $tulos = mysqli_stmt_get_result($stmt);
    
    $tuote = mysqli_fetch_object($tulos);


    if (!$tuote){
        header("Location: menu.html");
        exit;
    }

    // Määritetään muuttujat lomaketta varten riippuen taulusta
    if ($taulu == "Ruuat") {
        $id = $tuote->ruokaId;
        $nimi = $tuote->ruokaNimi;
        $hinta = $tuote->ruokaHinta;
    } elseif ($taulu == "Juomat") {
        $id = $tuote->juomaId;
        $nimi = $tuote->juomaNimi;
        $hinta = $tuote->juomaHinta;
    } elseif ($taulu == "Lisukkeet") {
        $id = $tuote->LisukeId;
        $nimi = $tuote->lisukeNimi;
        $hinta = $tuote->lisukeHinta;
    }

} catch(Exception $e) {
    print("Virhe haettaessa tietoja: " . $e->getMessage());
    exit;
}
?>

<!DOCTYPE html>
<html>
<head><title>Muokkaa tuotetta</title></head>
<body>
    <h2>Muokkaa tuotetta (<?php print $taulu; ?>)</h2>
    <form action="paivitalounas.php" method="post">
        <input type="hidden" name="id" value="<?php print $id; ?>">
        <input type="hidden" name="taulu" value="<?php print $taulu; ?>">
        
        Nimi: <input type="text" name="nimi" value="<?php print $nimi; ?>"><br><br>
        Hinta (€): <input type="text" name="hinta" value="<?php print $hinta; ?>"><br><br>
        
        <input type="submit" name='ok' value="Päivitä">
    </form>
</body>
</html>


<?php mysqli_close($yhteys); ?>
