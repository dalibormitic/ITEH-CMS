<?php
include "DBBroker.php";

$username = $_POST['username'];
$password = hash('sha256', $_POST['password']);


if ($username != "" && $password != "") {
    $korisnik = DBBroker::getBroker()->vratiKorisnika($username, $password);
    if ($korisnik == "Greska") {
        echo json_encode(array('error' => 0));
    } else {
        echo json_encode(array('success' => 1));
        session_start();
        $_SESSION['username'] = $username;
    }
}
