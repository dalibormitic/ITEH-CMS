<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pregled</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../style.css">
</head>

<body class="blue lighten-1" style="color:white">
    <?php
    include "DBBroker.php";
    if (isset($_GET['idclanka'])) {
        $idClanka = $_GET['idclanka'];
    }

    session_start();

    if (!isset($_SESSION['username'])) {
        header('Location: ../index.html');
    }

    $zahtev = curl_init("http://localhost/itehprojekat/WebService/clanci/" . $idClanka);
    curl_setopt($zahtev, CURLOPT_RETURNTRANSFER, true);
    $json = curl_exec($zahtev);
    $clanak = json_decode($json);
    curl_close($zahtev);

    $dodaoClanak = DBBroker::getBroker()->vratiKorisnikaPoId($clanak->korisnikId);
    $kategorija = DBBroker::getBroker()->vratiKategorijuPoId($clanak->kategorijaId);
    ?>

    <div class="container">

        <h1 id="clanakNaslov" class="center"><?php echo $clanak->naslov ?></h1>
        <div>
            <span id="spanKategorija">Kategorija: <?php echo $kategorija->naziv ?></span>
            <span class="right" id="spanDodao"> Dodao: <?php echo $dodaoClanak->username ?></span>
        </div>
        <p id="clanakTekst"><?php echo $clanak->tekst ?></p>
        <a class="waves-effect waves-light btn indigo darken-2" id="vratiSeBtn" href="../nova.php">Vrati se na pregled</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</body>

</html>