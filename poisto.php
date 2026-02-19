<?php
header('Content-Type: application/json; charset=utf-8');

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

try {
    $yhteys = mysqli_connect("db", "root", "password", "lounas");
}
catch(Exception $e) {
    print json_encode(["status" => "error"]);
    exit;
}

if (isset($_GET["poistettava"]) && isset($_GET["taulu"])) {

    $poistettava = $_GET["poistettava"];
    $taulu = $_GET["taulu"];

    if ($taulu == "Ruuat") {
        $sql = "DELETE FROM Ruuat WHERE RuokaID=?";
    }
    elseif ($taulu == "Juomat") {
        $sql = "DELETE FROM Juomat WHERE JuomaID=?";
    }
    elseif ($taulu == "Lisukkeet") {
        $sql = "DELETE FROM Lisukkeet WHERE LisukeID=?";
    }

    $stmt = mysqli_prepare($yhteys, $sql);
    mysqli_stmt_bind_param($stmt, 'i', $poistettava);
    mysqli_stmt_execute($stmt);

    print json_encode(["status" => "ok"]);
}

mysqli_close($yhteys);
?>
