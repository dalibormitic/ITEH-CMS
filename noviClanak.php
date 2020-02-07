<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dodaj članak</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body class="blue lighten-1">
    <?php
    include "DBBroker.php";
    session_start();
    $username =  $_SESSION['username'];

    if (!isset($_SESSION['username'])) {
        header('Location: index.html');
    }

    $id = DBBroker::getBroker()->vratiIdKorisnika($username);
    $korisnik = DBBroker::getBroker()->vratiKorisnikaPoId($id->id);
    ?>
    <nav>
        <div class="nav-wrapper blue">
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li id="ulogovani">Ulogovani korisnik sa id-jem: <span id="ulogovaniKorisnik"><?php echo $korisnik->id; ?></span></li>
            </ul>
        </div>
    </nav>
    <div class="row center">
        <div class="row">
            <h3 class="white-text">Dodaj članak</h3>
            <form class="col s4 push-s4 formaZaUnosClanaka">
                <div class="row">
                    <div class="input-field">
                        <i class="material-icons prefix white-text" id="user-icon">title</i>
                        <input id="naslov" type="text" class="validate white-text">
                        <label for="naslov">Naslov</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field">
                        <i class="material-icons prefix white-text" id="pass-icon">text_fields</i>
                        <input id="tekst" type="text" class="validate white-text">
                        <label for="tekst">Tekst</label>
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
                            $zahtev = curl_init("http://localhost/itehprojekat/WebService/kategorije");
                            curl_setopt($zahtev, CURLOPT_RETURNTRANSFER, true);
                            $json = curl_exec($zahtev);
                            $podaci = json_decode($json);
                            curl_close($zahtev);
                            foreach ($podaci as $kategorija) {
                                echo "<option value='$kategorija->id'>$kategorija->naziv</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="file-field input-field">
                        <div class="btn indigo darken-2">
                            <span>Odaberi sliku</span>
                            <input type="file" name="fileToUpload" id="fileToUpload">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate white-text" type="text">
                        </div>
                    </div>
                </div>

                <a class="waves-effect waves-light btn indigo darken-2" id="buttonDodajClanak">Dodaj</a>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#uneo').val($('#ulogovaniKorisnik').text());
            $('select').formSelect();
        });

        var fileToUpload = $('#fileToUpload');


        $('#buttonDodajClanak').click(function(e) {
            var naslov = $('#naslov')
                .val()
                .trim();
            var tekst = $('#tekst')
                .val()
                .trim();
            var uneo = parseInt($('#uneo')
                .val(), 10);
            var kategorija = parseInt($('#kategorija')
                .val(), 10);
            var slika = $('.file-path').val().trim();

            e.preventDefault();
            if (naslov != '' && tekst != '' && kategorija > 0) {
                $.ajax({
                    url: 'dodajPost.php',
                    type: 'post',
                    data: {
                        naslov: naslov,
                        tekst: tekst,
                        uneo: uneo,
                        kategorija: kategorija,
                        slika: slika
                    },
                    success: function(response) {
                        M.toast({
                            html: 'Uspešno dodato!',
                            classes: 'rounded'
                        });
                        setTimeout(function() {
                            window.location.assign('nova.php');
                        }, 1500);
                    }
                });
            } else {
                M.toast({
                    html: 'Sva polja su obavezna!',
                    classes: 'rounded'
                });
            }

            var file_data = $('#fileToUpload').prop('files')[0];
            var form_data = new FormData();
            form_data.append('fileToUpload', file_data);
            $.ajax({
                url: 'upload.php', // point to server-side PHP script 
                dataType: 'text', // what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post'
            });

        });
    </script>
</body>

</html>