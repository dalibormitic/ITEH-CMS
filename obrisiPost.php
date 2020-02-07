<?php
include "DBBroker.php";

if (isset($_POST["metoda"]) && $_POST["metoda"] = "obrisi" && isset($_POST["id"])) {
    $zahtev = curl_init("http://localhost/itehprojekat/WebService/clanci/" . $_POST["id"]);
    curl_setopt($zahtev, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($zahtev, CURLOPT_CUSTOMREQUEST, "DELETE");
    $json = curl_exec($zahtev);
    $podaci = json_decode($json);
    curl_close($zahtev);
}
