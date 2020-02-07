<?php
include "DBBroker.php";

$kategorija = $_POST['kategorija'];

$kat = DBBroker::getBroker()->dodajKategoriju($kategorija);
