<?php
include 'inizio.inc';
?>
<html>
    <head>
        <title>Conferma eliminazione</title>
        <meta charset="windows-1252">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
	       .cella {
            border:1px black solid;
            padding: 5px;
        }
        .cella2 {
          border:1px black solid;
          padding: 5px;
          cursor: pointer;
          color: black;
        }
        .button-l {
          float: left;
          background-color: #33cc33;
          border: none;
          width: 150px;
          height: 50px;
          color: black;
          padding: 15px;
          text-align: center;
          text-decoration: none;
          margin-right: 20px;
          font-size: 16px;
        }
        .button-r {
          float: left;
          height: 50px;
          width: 150px;
          background-color: #ff0000;
          border: none;
          color: black;
          padding: 15px;
          text-align: center;
          text-decoration: none;
          font-size: 16px;
        }
        #contenitore {
          flex-wrap: nowrap;
          float: left;
          display: flex;
        }
        .button-r:hover, .button-l:hover {
          box-shadow: 0 12px 16px 0 rgba(0,0,0,0.24), 0 17px 50px 0 rgba(0,0,0,0.19);
        }
        table {
            border-collapse: collapse;
        }
        article {
          text-align: center;
        }
        #coprente {
          position: fixed;
          top: 0;
          left: 0;
          width: 100%;
          height: 100%;
          background-color: rgba(0,0,0,0.6);
          z-index: 1; /* o comunque il numero più alto tra quelli degli altri z-index presenti */
          overflow: auto;
          display: block;
        }
        #div2 {
          position: absolute;
          margin: 0 0 0 -180px;
          top: 170px;
          left: 50%;
          width: 360px;
          height: auto;
          background-color: white;
          border: 1px solid blue;
          overflow: auto;
          padding: 20px;
          display: block;
        }
        @media only screen and (max-width: 1000px) {
          #div2, #div1 {
            width: 50%;
          }
        }
        </style>
    </head>
    <body>
      <section>
	        <article>
        <br>
        <h2>Elenco prestiti</h2>
        <a class="black" href="inserimentoprestito.php" data-toggle="tooltip" title="Aggiungi prestito"><i class="material-icons" alt="">&#xe146;</i></a>
        <br>
        <br>
        <?php
            $connessione = mysqli_connect("localhost", "id13768971_admin", "N2+?7hOGh3on=Em!", "id13768971_lattanzio") or die("Il server non risponde" . mysqli_error());
            $query = "select prestiti.idprestito, prestiti.dataprestito, prestiti.datarestituzione, utenti.idutente, utenti.nome, utenti.cognome, libri.titolo, libri.codice
                      from prestiti, utenti, libri
                      where utenti.idutente = prestiti.utente and libri.codice = prestiti.libro and utenti.IDIstituto = '" . $_SESSION["istituto"] . "'
                      order by dataprestito";
            $risultato = mysqli_query($connessione, $query);
            if (mysqli_num_rows($risultato) != 0) {
                echo "<table>";
                echo "<tr><th>Utente</th><th>Libro</th><th>Inizio prestito</th><th>Fine prestito</th></tr>";
                while ($row = mysqli_fetch_array($risultato)) {
                    echo "<tr>";
                    echo "<td class='cella'>$row[nome] $row[cognome]</td>";
                    echo "<td class='cella'>$row[titolo]</td>";
                    echo "<td class='cella'>$row[dataprestito]</td>";
                    echo "<td class='cella'>$row[datarestituzione]</td>";
                    echo "<td class='cella'><a href='modificaprestito.php?idUtente=$row[idutente]&codice=$row[codice]&DataPrestito=$row[dataprestito]&DataRestituzione=$row[datarestituzione]'>Modifica</a></td>";
                    echo "<td class='cella'><a href='gestioneprestitibis.php?id=$row[idprestito]&libro=$row[codice]&utente=$row[idutente]&datap=$row[dataprestito]&datar=$row[datarestituzione]'>Elimina</a></td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
            if (mysqli_num_rows($risultato) == 0) {
                echo "<h3>Non ci sono prestiti.</h3>";
            }
        ?>

        <br>
        <hr style="border: 1px solid blue; width:50%;">
        <h2>Prestiti richiesti</h2>
        <?php
            $connessione = mysqli_connect("localhost", "id13768971_admin", "N2+?7hOGh3on=Em!", "id13768971_lattanzio") or die("Il server non risponde" . mysqli_error());
            $query = "select prestiti_in_attesa.idprestito, prestiti_in_attesa.dataprestito, prestiti_in_attesa.datarestituzione, utenti.idutente, utenti.nome, utenti.cognome, libri.titolo, libri.codice
                      from prestiti_in_attesa, utenti, libri
                      where utenti.idutente = prestiti_in_attesa.utente and libri.codice = prestiti_in_attesa.libro and utenti.IDIstituto = '" . $_SESSION["istituto"] . "'
                      order by dataprestito";
            $risultato = mysqli_query($connessione, $query);
            if (mysqli_num_rows($risultato) != 0) {
                echo "<table>";
                echo "<tr><th>Utente</th><th>Libro</th><th>Inizio prestito</th><th>Fine prestito</th></tr>";
                while ($row = mysqli_fetch_array($risultato)) {
                    echo "<tr>";
                    echo "<td class='cella'>$row[nome] $row[cognome]</td>";
                    echo "<td class='cella'>$row[titolo]</td>";
                    echo "<td class='cella'>$row[dataprestito]</td>";
                    echo "<td class='cella'>$row[datarestituzione]</td>";
                    echo "<td class='cella'><a href='esegui.php?id=$row[idprestito]&libro=$row[codice]&utente=$row[idutente]&datap=$row[dataprestito]&datar=$row[datarestituzione]&azione=AGGIUNGI_PRESTITO2' onclick=\"return confirm('sei sicuro?');\">Accetta</a></td>";
                    echo "<td class='cella2'><a href='gestioneprestitirifiuta.php?id=$row[idprestito]&libro=$row[codice]&utente=$row[idutente]&datap=$row[dataprestito]&datar=$row[datarestituzione]'>Rifiuta</a></td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
            if (mysqli_num_rows($risultato) == 0) {
                echo "<h3>Non ci sono richieste.</h3>";
            }
        ?>
</div>
        <!-- se il prestito viene rifiutato -->
        <div id="coprente">
        <div id="div2">
          <?php
          $id = $_GET["id"];
          $libro = $_GET["libro"];
          $utente = $_GET["utente"];
          $datap = $_GET["datap"];
          $datar = $_GET["datar"];
          echo "<br>";
          echo "<form action='esegui.php?id=$id&libro=$libro&utente=$utente&datap=$datap&datar=$datar&azione=ELIMINA_PRESTITO2' method='POST'>";
          echo "<h3>Inserisci motivazione</h3>";
          echo "<input type='text' name='var' placeholder='Scrivi qui...' required autofocus>";
          echo "<br>";
          echo "<br>";
          echo "<div id='contenitore'>";
          echo "<button class='button-l' type='submit'>Conferma</button>";
          echo "</form>";
          echo "<form action='gestioneprestiti.php'>";
          echo "<button class='button-r'>Torna indietro</button>";
          echo "</form>";
          echo "</div>";
          mysqli_close($connessione);
          ?>
        </div>
        </div>
		</article>
    <aside>
      <table><caption>La biblioteca</caption><tr><td><a href="https://www.divittoriolattanzio.it/home/index.php/biblioteca.html" target="_blank"><img class="rounded"src="https://www.divittoriolattanzio.it/home/images/biblioteca.jpg" width="100%" height="85px"></a></td></tr></table>
  <br>
      <table><caption>L'istituto</caption><tr><td><a href="https://www.divittoriolattanzio.it/home/index.php" target="_blank"><img src="https://www.divittoriolattanzio.it/home/images/logo-scuola.png" width="100%" height="85px"></a></td></tr></table>
    </aside>
		</section>
    <footer>
      Made by Fabio Iacus © 2020
   </footer>
 </div>
    </body>
</html>
