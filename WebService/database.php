<?php
class Database
{
    private $hostname = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "itehprvidomaci";
    private $dblink;
    private $result = true;
    private $records;
    private $affectedRows;


    function __construct($dbname)
    {
        $this->$dbname = $dbname;
        $this->Connect();
    }

    public function getResult()
    {
        return $this->result;
    }

    function __destruct()
    {
        $this->dblink->close();
    }


    function Connect()
    {
        $this->dblink = new mysqli($this->hostname, $this->username, $this->password, $this->dbname);
        if ($this->dblink->connect_errno) {
            printf("Konekcija neuspesna!");
            exit();
        }
        $this->dblink->set_charset("utf8");
    }

    function vratiSveKategorije()
    {
        $konekcija = new mysqli("localhost", "root", "", "itehprvidomaci");
        $q = "SELECT * FROM kategorija";
        $this->result = $konekcija->query($q);
        $konekcija->close();
    }

    function vratiSveClanke()
    {
        $konekcija = new mysqli("localhost", "root", "", "itehprvidomaci");
        $q = "SELECT * FROM clanak";
        $this->result = $konekcija->query($q);
        $konekcija->close();
    }

    function obrisiClanak($id)
    {
        $konekcija = new mysqli("localhost", "root", "", "itehprvidomaci");
        $q = "DELETE FROM clanak WHERE id=" . $id;
        $konekcija->query($q);
        $konekcija->close();
    }

    function dodajClanak($naslov, $tekst, $uneo, $kategorija, $slika)
    {
        $konekcija = new mysqli("localhost", "root", "", "itehprvidomaci");
        $q = "INSERT INTO clanak(naslov, tekst, korisnikId, kategorijaId, slika) VALUES('$naslov','$tekst',$uneo, $kategorija, '$slika')";
        $konekcija->query($q);
        $konekcija->close();
    }

    function vratiClanakPoId($id)
    {
        $konekcija = new mysqli("localhost", "root", "", "itehprvidomaci");
        $q = "SELECT * FROM clanak WHERE id=" . $id;
        $this->result = $konekcija->query($q);
        $konekcija->close();
    }

    function ExecuteQuery($query)
    {
        if ($this->result = $this->dblink->query($query)) {
            if (isset($this->result->num_rows)) $this->records         = $this->result->num_rows;
            if (isset($this->dblink->affected_rows)) $this->affected        = $this->dblink->affected_rows;
            return true;
        } else {
            return false;
        }
    }
}
