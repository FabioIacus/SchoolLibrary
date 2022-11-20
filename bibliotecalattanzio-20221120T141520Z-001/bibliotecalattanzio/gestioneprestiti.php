<?php
include 'inizio.inc';
?>
<html>
    <head>
        <title>Gestione prestiti</title>
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
          color: white;
        }
        table {
            border-collapse: collapse;
        }
        article {
          text-align: center;
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
            mysqli_close($connessione);
        ?>

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
    </body>
</html>
