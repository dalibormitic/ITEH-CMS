<?php
require 'flight/Flight.php';
require 'jsonindent.php';
Flight::register('db', 'Database', array('itehprojekat'));
$json_podaci = file_get_contents("php://input");
Flight::set('json_podaci', $json_podaci);

Flight::route('/', function () {
    echo "Izaberite neku od ruta:" . "</br></br>" . "GET /kategorije" . "</br>" . "GET /clanci" . "</br>" . "GET /clanci/@id" . "</br>" . "DELETE /clanci/@id" . "</br>" . "POST /clanci";
});

Flight::route('GET /kategorije', function () {
    header("Content-Type: application/json; charset=utf-8");
    $db = Flight::db();
    $db->vratiSveKategorije();

    $niz =  [];
    while ($red = $db->getResult()->fetch_object()) {
        array_push($niz, $red);
    }

    echo indent(json_encode($niz));
});

Flight::route('GET /clanci', function () {
    header("Content-Type: application/json; charset=utf-8");
    $db = Flight::db();
    $db->vratiSveClanke();

    $niz =  [];
    while ($red = $db->getResult()->fetch_object()) {
        array_push($niz, $red);
    }

    echo indent(json_encode($niz));
});

Flight::route('GET /clanci/@id', function ($id) {
    header("Content-Type: application/json; charset=utf-8");
    $db = Flight::db();
    $db->vratiClanakPoId($id);

    $red = $db->getResult()->fetch_object();

    echo indent(json_encode($red));
});

Flight::route('DELETE /clanci/@id', function ($id) {
    header("Content-Type: application/json; charset=utf-8");
    $db = Flight::db();
    if ($db->obrisiClanak($id)) {
        $odgovor["poruka"] = "Neuspešno";
        $json_odgovor = json_encode($odgovor);
    } else {
        $odgovor["poruka"] = "Uspešno";
        $json_odgovor = json_encode($odgovor);
    }
    echo $json_odgovor;
});

Flight::route(
    'POST /clanci',
    function () {
        header("Content-Type: application/json; charset=utf-8");
        $db = Flight::db();
        $podaci_json = Flight::get("json_podaci");
        $podaci = json_decode($podaci_json);

        if ($podaci == null) {
            $odgovor["poruka"] = "Niste prosledili podatke";
            $json_odgovor = json_encode($odgovor);
            echo $json_odgovor;
            return false;
        } else {
            if (!property_exists($podaci, 'naslov') || !property_exists($podaci, 'tekst') || !property_exists($podaci, 'uneo') || !property_exists($podaci, 'kategorija') || !property_exists($podaci, 'slika')) {
                $odgovor["poruka"] = "Niste prosledili korektne podatke";
                $json_odgovor = json_encode($odgovor, JSON_UNESCAPED_UNICODE);
                echo $json_odgovor;
                return false;
            } else {
                $podaci_query = array();
                foreach ($podaci as $k => $v) {
                    $v = "" . $v . "";
                    $podaci_query[$k] = $v;
                }
                if ($db->dodajClanak($podaci_query["naslov"], $podaci_query["tekst"], $podaci_query["uneo"], $podaci_query["kategorija"], $podaci_query["slika"])) {
                    $odgovor["poruka"] = "Došlo je do greške pri ubacivanju članka";
                    $json_odgovor = json_encode($odgovor, JSON_UNESCAPED_UNICODE);
                    echo $json_odgovor;
                    return false;
                } else {
                    $odgovor["poruka"] = "Članak je uspešno ubačen";
                    $json_odgovor = json_encode($odgovor, JSON_UNESCAPED_UNICODE);
                    echo $json_odgovor;
                    return false;
                }
            }
        }
    }

);

Flight::start();
