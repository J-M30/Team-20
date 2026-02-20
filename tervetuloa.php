<?php
session_start();
if (!isset($_SESSION["kayttaja"])){
    header("Location:./kirjaudu.html");
    exit;
}
print "<h2>Tervetuloa, ".$_SESSION["kayttaja"]."!<h2>";
?>
<a href="kirjauduUlos.php">Kirjaudu ulos</a>
