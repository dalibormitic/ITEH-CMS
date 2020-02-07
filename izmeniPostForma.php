<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Izmeni Članak</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../style.css">
</head>

<body class="blue lighten-1">
    <?php
    include "DBBroker.php";
    session_start();

    if (!isset($_SESSION['username'])) {
        header('Location: ../index.html');
    }

    $username =  $_SESSION['username'];

    $id = DBBroker::getBroker()->vratiIdKorisnika($username);
    $korisnik = DBBroker::getBroker()->vratiKorisnikaPoId($id->id);
    $kategorije = DBBroker::getBroker()->vratiSveKategorije();

    if (isset($_GET['idclanka'])) {
        $idClanka = $_GET['idclanka'];
    }

    $clanak = DBBroker::getBroker()->vratiClanakPoId($idClanka);
    ?>
    <div style="display: none">
        <li id="clanakId"><?php echo $clanak->id ?></li>
        <li id="clanakNaslov"><?php echo $clanak->naslov ?></li>
        <li id="clanakTekst"><?php echo $clanak->tekst ?></li>
        <li id="clanakKorisnik"><?php echo $clanak->korisnikId ?></li>
        <li id="clanakKategorija"><?php echo $clanak->kategorijaId ?></li>
    </div>

    <nav>
        <div class="nav-wrapper blue">
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li id="ulogovani">Ulogovani korisnik sa id-jem: <span id="ulogovaniKorisnik"><?php echo $korisnik->id; ?></span></li>
                <?php
                if (isset($_SESSION['username'])) {
                    echo  '<button class="btn red" name="logout" id="logout" onclick="logout()">Logout</button>';
                }
                ?>
            </ul>
        </div>
    </nav>
    <div class="row center">
        <div class="row">
            <h3 class="white-text">Izmeni članak</h3>
            <form class="col s4 push-s4 formaZaUnosClanaka">
                <div class="row">
                    <div class="input-field">
                        <i class="material-icons prefix white-text" id="user-icon">title</i>
                        <input id="naslov" type="text" class="validate white-text">
                    </div>
                </div>
                <div class="row">
                    <div class="input-field">
                        <i class="material-icons prefix white-text" id="pass-icon">text_fields</i>
                        <input id="tekst" type="text" class="validate white-text">
                    </div>
                </div>
                <div class="row">
                    <div class="input-field">
                        <i class="material-icons prefix white-text" id="pass-icon">verified_user</i>
                        <input id="uneo" type="text" class="white-text" disabled>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field">
                        <select class="browser-default" id="kategorija">
                            <option value="" disabled selected>Izaberite kategoriju...</option>
                            <?php
                            foreach ($kategorije as $kategorija) {
                                echo "
                            <option value='$kategorija->id'>$kategorija->naziv</option> ";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <a class="waves-effect waves-light btn indigo darken-2" id="buttonIzmeniClanak">Izmeni</a>
            </form>
        </div>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
<script>
    $(document).ready(function() {
        $('#tekst').val($('#clanakTekst').text());
        $('#naslov').val($('#clanakNaslov').text());
        $('#uneo').val($('#clanakKorisnik').text());
        $("select").val($("#clanakKategorija").text());
    });

    $('#buttonIzmeniClanak').click(function(e) {

        var naslov = $('#naslov')
            .val()
            .trim();
        var tekst = $('#tekst')
            .val()
            .trim();
        var kategorija = parseInt($('#kategorija')
            .val(), 10);


        e.preventDefault();
        if (naslov != '' && tekst != '' && kategorija != '') {
            $.ajax({
                url: '../izmeniPost.php',
                type: 'post',
                data: {
                    id: parseInt($('#clanakId').text(), 10),
                    naslov: naslov,
                    tekst: tekst,
                    kategorija: kategorija
                },
                success: function(response) {
                    M.toast({
                        html: 'Uspešno izmenjeno!',
                        classes: 'rounded'
                    });
                    setTimeout(function() {
                        window.location.assign('../nova.php');
                    }, 1500);
                }
            });
        } else {
            M.toast({
                html: 'Sva polja su obavezna!',
                classes: 'rounded'
            });
        }
    });


    logout = () => {
        $.ajax({
            url: '../izloguj.php',
            type: 'post',
            success: function() {
                console.log('User nije vise ulogovan');
                location.reload();
            }
        });
    }
</script>

</html>