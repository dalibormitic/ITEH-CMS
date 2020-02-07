<?php
include "DBBroker.php";

$naslov = $_POST['naslov'];
$tekst = $_POST['tekst'];
$uneo = $_POST['uneo'];
$kategorija = $_POST['kategorija'];
$slika = $_POST['slika'];

if ($naslov != '' && $tekst != '' && $uneo != '' && $kategorija != '') {
    $clanak = DBBroker::getBroker()->dodajClanak($naslov, $tekst, $uneo, $kategorija, $slika);
}
