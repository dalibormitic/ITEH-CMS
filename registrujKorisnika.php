<?php
include "DBBroker.php";

$username = $_POST['username'];
$password = hash('sha256', $_POST['password']);


if ($username != "" && $password != "") {
    $korisnikIzBaze = DBBroker::getBroker()->vratiKorisnikaPoUsername($username);
    if ($korisnikIzBaze == "Greska") {
        $korisnik = DBBroker::getBroker()->registrujKorisnika($username, $password, 2);
        echo json_encode(array('success' => 1));
    } else {
        echo json_encode(array('error' => 0));
    }
}
