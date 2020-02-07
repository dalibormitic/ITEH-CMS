<?php

class DBBroker
{

    private $mysqli;
    private $mysql_server = "localhost";
    private $mysql_user = "root";
    private $mysql_password = "";
    private $mysql_db = "itehprvidomaci";
    public static $instanca;

    private function __construct()
    {
        $mysqli1 = new mysqli($this->mysql_server, $this->mysql_user, $this->mysql_password, $this->mysql_db);
        if ($mysqli1->connect_errno) {
            printf("Konekcija neuspešna: %s\n", $mysqli1->connect_error);
            exit();
        }
        $this->mysqli = $mysqli1;
        $this->mysqli->set_charset("utf8");
    }
    public static function getBroker()
    {
        if (!isset($instanca)) {
            $instanca = new DBBroker();
        }
        return $instanca;
    }

    function vratiKorisnika($username, $password)
    {
        $query = "SELECT * FROM korisnik WHERE username='" . $username . "' AND password='" . $password . "'";
        $rezultat = $this->mysqli->query($query);
        if ($rezultat->num_rows == 0) {
            return "Greska";
        }

        return $rezultat->fetch_object();
    }

    function vratiKorisnikaPoUsername($username)
    {
        $query = "SELECT * FROM korisnik WHERE username='" . $username . "'";
        $rezultat = $this->mysqli->query($query);
        if ($rezultat->num_rows == 0) {
            return "Greska";
        }

        return $rezultat->fetch_object();
    }

    function registrujKorisnika($username, $password, $ulogaID)
    {
        $query = "INSERT INTO korisnik(username, password, ulogaID) VALUES(?,?,?)";
        $stmt = $this->mysqli->prepare($query);
        $stmt->bind_param("ssi", $username, $password, $ulogaID);
        $rezultat = $stmt->execute();

        return $rezultat;
    }

    function vratiKorisnikaPoId($id)
    {
        $query = "SELECT k.id, k.username, k.password, u.nazivUloge AS uloga FROM korisnik k JOIN uloga u ON k.ulogaID = u.ulogaID WHERE id=" . $id;
        $rezultat = $this->mysqli->query($query);
        if ($rezultat->num_rows == 0) {
            return "Greska";
        }
        return $rezultat->fetch_object();
    }

    function vratiKategorijuPoId($id)
    {
        $query = "SELECT * FROM kategorija WHERE id=" . $id;
        $rezultat = $this->mysqli->query($query);
        if ($rezultat->num_rows == 0) {
            return "Greska";
        }
        return $rezultat->fetch_object();
    }

    function vratiSveKategorije()
    {
        $query = "SELECT * FROM kategorija";
        $rezultat = $this->mysqli->query($query);
        $niz = array();
        while ($red = $rezultat->fetch_object()) {
            array_push($niz, $red);
        }
        return $niz;
    }

    function vratiIdKorisnika($username)
    {
        $query = "SELECT id FROM korisnik WHERE username='" . $username . "'";

        $rezultat = $this->mysqli->query($query);
        if ($rezultat->num_rows == 0) {
            return "Greska";
        }

        return $rezultat->fetch_object();
    }

    function vratiSveClanke()
    {
        $query = "SELECT * FROM clanak";
        $rezultat = $this->mysqli->query($query);

        $niz = array();
        while ($red = $rezultat->fetch_object()) {
            array_push($niz, $red);
        }
        return $niz;
    }

    function obrisiClanak($id)
    {
        $query = "DELETE FROM clanak WHERE id=" . $id;
        $this->mysqli->query($query);
    }

    function dodajClanak($naslov, $tekst, $uneo, $kategorija, $slika)
    {
        $query = "INSERT INTO clanak(naslov, tekst, korisnikId, kategorijaId, slika) VALUES(?,?,?,?,?)";
        $stmt = $this->mysqli->prepare($query);
        $stmt->bind_param("ssiis", $naslov, $tekst, $uneo, $kategorija, $slika);
        $rezultat = $stmt->execute();

        return $rezultat;
    }

    function dodajKategoriju($kategorija)
    {
        $query = "INSERT INTO kategorija(naziv) VALUES(?)";
        $stmt = $this->mysqli->prepare($query);
        $stmt->bind_param("s", $kategorija);
        $rezultat = $stmt->execute();

        return $rezultat;
    }

    function vratiBrojClanakaPoKategorijama()
    {
        $query = "SELECT k.naziv, COUNT(c.id) AS broj_clanaka FROM clanak c JOIN kategorija k ON c.kategorijaID = k.id GROUP BY k.id";
        $rezultat = $this->mysqli->query($query);

        $niz = array();
        while ($red = $rezultat->fetch_object()) {
            array_push($niz, $red);
        }
        return $niz;
    }

    function vratiClanakPoId($id)
    {
        $query = "SELECT * FROM clanak WHERE id=" . $id;
        $rezultat = $this->mysqli->query($query);
        return $rezultat->fetch_object();
    }

    function izmeniClanak($id, $naslov, $tekst, $kategorija)
    {
        $query = "UPDATE clanak SET naslov=" . "'" . $naslov . "'" . ",tekst='" . $tekst . "'" . ",kategorijaId=" . $kategorija . " WHERE id=" . $id;
        $rezultat = $this->mysqli->query($query);

        return $rezultat;
    }
}
