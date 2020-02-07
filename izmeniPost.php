<?php
include "DBBroker.php";

$naslov = $_POST['naslov'];
$tekst = $_POST['tekst'];
$kategorija = $_POST['kategorija'];
$id = $_POST['id'];


$clanak = DBBroker::getBroker()->izmeniClanak($id, $naslov, $tekst, $kategorija);
