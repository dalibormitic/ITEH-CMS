<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Početna</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="http://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="style.css">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>

<body>
    <?php
    header("Access-Control-Allow-Origin: *");
    include "DBBroker.php";

    session_start();

    if (!isset($_SESSION['username'])) {
        header('Location: index.html');
    }
    $username =  $_SESSION['username'];

    $zahtev = curl_init("http://localhost/itehprojekat/WebService/clanci/");
    curl_setopt($zahtev, CURLOPT_RETURNTRANSFER, true);
    $json = curl_exec($zahtev);
    $clanci = json_decode($json);
    curl_close($zahtev);

    $id = DBBroker::getBroker()->vratiIdKorisnika($username);
    $korisnik = DBBroker::getBroker()->vratiKorisnikaPoId($id->id);
    $clanciPoKategorijama = DBBroker::getBroker()->vratiBrojClanakaPoKategorijama();
    ?>

    <nav>
        <div class="nav-wrapper blue">
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li style="margin-right: 15px"><a href="WebService/">Web Servis</a></li>
                <li id="ulogovani">Ulogovani korisnik: <?php echo $korisnik->username; ?></li>
                <?php
                if (isset($_SESSION['username'])) {
                    echo '<button class="btn red" name="logout" id="logout" onclick="logout()">Logout</button>';
                } ?>
            </ul>
            <ul style='margin-left:50px'>
                <?php
                $url = 'api.openweathermap.org/data/2.5/weather?q=Belgrade,RS&appid=0698506360165ed4342b801d515e7a30&units=metric';
                $curl = curl_init($url);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($curl, CURLOPT_POST, false);
                $curl_odgovor = curl_exec($curl);
                curl_close($curl);
                $parsiran_json = json_decode($curl_odgovor);
                echo "<li>Temperatura: " . $parsiran_json->main->temp . "°C,&nbsp</li><li>Vetar: " . $parsiran_json->wind->speed . " km/h,&nbsp</li>" . "</li><li>Vlažnost vazduha: " . $parsiran_json->main->humidity . "%</li>";
                ?>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="intro">
            <h1 id="naslov">Spisak svih članaka</h1>
            <a class="btn-floating btn-large waves-effect waves-light green" id="dodajClanak" title="Dodaj novi članak" href="noviClanak.php"><i class="material-icons">add</i></a>
        </div>

        <?php
        if ($korisnik->uloga == "admin") {
            echo "
                    <h4>Dodaj kategoriju</h4>
                    <form class='col s4 unosKategorije'>
                        <div class='row'>
                            <div class='input-field col s4'>
                                <input id='kategorija' type='text' class='validate' style='border-bottom: 1px solid #0066ff;'>
                            </div>
                        </div>
                    </form>
                    <button class='btn red' name='dodajKategoriju' id='dodajKategoriju'>Dodaj</button>
                ";
        }
        ?>

        <table class="striped" id="tabela">
            <thead>
                <tr>
                    <th>Slika</th>
                    <th>Naslov</th>
                    <th>Tekst</th>
                    <th>Kategorija</th>
                    <th>Uneo</th>
                    <th>Uredi</th>
                </tr>
            </thead>

            <tbody>

                <?php
                foreach ($clanci as $clanak) {
                    $dodaoClanak = DBBroker::getBroker()->vratiKorisnikaPoId($clanak->korisnikId);
                    $kategorija = DBBroker::getBroker()->vratiKategorijuPoId($clanak->kategorijaId);
                    $skraceniTekst = substr($clanak->tekst, 0, 30);
                    if ($korisnik->uloga == "admin") {
                        echo "<tr>
                        <td><img src='slike/$clanak->slika' width='100'></td>
                        <td>$clanak->naslov</td>
                        <td>$skraceniTekst</td>
                        <td>$kategorija->naziv</td>
                        <td>$dodaoClanak->username</td>
                        <td>                        
                            <button class='btn dugmeZaIzmenu' id='izmeni$clanak->id'><i class='material-icons' title='Izmeni'>mode_edit</i></button>
                            <button class='btn red dugmeZaBrisanje' id='obrisi$clanak->id'><i class='material-icons' title='Obriši'>delete</i></button>
                            <button class='btn green dugmeZaPregled' id='pregledaj$clanak->id'><i class='material-icons' title='Pogledaj'>visibility</i></button>
                        </td> 
                        
                    </tr>   ";
                    } else {
                        echo "<tr>
                        <td><img src='slike/$clanak->slika' width='100'></td>
                        <td>$clanak->naslov</td>
                        <td>$skraceniTekst</td>
                        <td>$kategorija->naziv</td>
                        <td>$dodaoClanak->username</td>
                        <td>                        
                            <button class='btn dugmeZaIzmenu' id='izmeni$clanak->id'><i class='material-icons' title='Izmeni'>mode_edit</i></button>
                            <button class='btn green dugmeZaPregled' id='pregledaj$clanak->id'><i class='material-icons' title='Pogledaj'>visibility</i></button>
                        </td> 
                    </tr>   ";
                    }
                }


                ?>

            </tbody>
        </table>
        <ul class="collapsible">
            <li>
                <div class="collapsible-header">
                    <h4>Programerski citat (kliknite da pogledate)</h4>
                </div>
                <div class="collapsible-body">
                    <p id="citat"></p>
                </div>
            </li>
        </ul>
        <div id="chart_div"></div>
    </div>




    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="http://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <script>
        $(document).ready(function() {
            $.ajax({
                url: 'https://programming-quotes-api.herokuapp.com/quotes/random/lang/sr',
                type: 'get',
                success: function(data) {
                    $('#citat').text(data.sr);
                }
            });

            $('#tabela').DataTable({
                "language": {
                    "url": "serbian.json"
                }
            });

            $('.collapsible').collapsible();
        });

        $('.dugmeZaBrisanje').click(function(e) {
            var elementId = e.target.parentElement.getAttribute('id');
            var id = elementId.replace('obrisi', '');

            e.preventDefault();
            if (id != '') {
                $.post('obrisiPost.php', {
                    metoda: "obrisi",
                    id: id,
                    success: function(response) {
                        M.toast({
                            html: 'Uspešno obrisano!',
                            classes: 'rounded'
                        });
                        setTimeout(function() {
                            window.location.assign('nova.php');
                        }, 1500);
                    }
                });
            }
        });

        $('#dodajKategoriju').click(function(e) {
            var kategorija = $('#kategorija')
                .val()
                .trim();

            e.preventDefault();
            if (kategorija != '') {
                $.post('dodajKategoriju.php', {
                    kategorija: kategorija,
                    success: function(response) {
                        M.toast({
                            html: 'Uspešno dodata kategorija!',
                            classes: 'rounded'
                        });
                        setTimeout(function() {
                            window.location.assign('nova.php');
                        }, 1500);
                    }
                });
            }
        });

        $('.dugmeZaIzmenu').click(function(e) {
            var elementId = e.target.parentElement.getAttribute('id');
            var idclanka = parseInt(elementId.replace('izmeni', ''), 10);

            e.preventDefault();
            if (idclanka != '') {
                $.get(`izmeniPostForma.php/?idclanka=${idclanka}`, {
                    metoda: "izmeni",
                    data: {
                        idclanka: idclanka
                    },
                    success: function(response) {
                        window.location.assign(`izmeniPostForma.php/?idclanka=${idclanka}`);
                    }
                });
            }
        });

        $('.dugmeZaPregled').click(function(e) {
            var elementId = e.target.parentElement.getAttribute('id');
            var idclanka = parseInt(elementId.replace('pregledaj', ''), 10);

            e.preventDefault();
            if (idclanka != '') {
                $.get(`pogledajPost.php/?idclanka=${idclanka}`, {
                    metoda: "izmeni",
                    data: {
                        idclanka: idclanka
                    },
                    success: function(response) {
                        window.location.assign(`pogledajPost.php/?idclanka=${idclanka}`);
                    }
                });
            }
        });

        logout = () => {
            $.ajax({
                url: 'izloguj.php',
                type: 'post',
                success: function() {
                    console.log('User nije vise ulogovan');
                    location.reload();
                }
            });
        }
    </script>
    <script type="text/javascript">
        // Load the Visualization API and the corechart package.
        google.charts.load('current', {
            'packages': ['corechart']
        });

        // Set a callback to run when the Google Visualization API is loaded.
        google.charts.setOnLoadCallback(drawChart);

        // Callback that creates and populates a data table,
        // instantiates the pie chart, passes in the data and
        // draws it.
        function drawChart() {
            var clanciPoKat = <?php echo json_encode($clanciPoKategorijama); ?>;


            // Create the data table.
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Naziv kategorije');
            data.addColumn('number', 'Broj članaka');
            clanciPoKat.forEach(function(temp) {
                data.addRow([temp.naziv, parseInt(temp.broj_clanaka)]);
            });

            // Set chart options
            var options = {
                'title': 'Broj članaka po kategorijama',
                'width': 800,
                'height': 500
            };

            // Instantiate and draw our chart, passing in some options.
            var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
    </script>

</body>

</html>