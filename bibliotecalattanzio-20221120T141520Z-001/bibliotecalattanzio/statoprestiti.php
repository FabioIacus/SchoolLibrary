<?php
include 'inizio.inc';
?>
<html>
    <head>
        <title>Stato Prestiti</title>
        <style>
	         .cella {
             border:1px black solid;
             padding: 5px;
          }
          table {
            border-collapse: collapse;
          }
          table.aside {
            width:100%;
          }
          article {
            text-align: center;
          }
          img.rounded {
      			border-radius: 50%;
      			max-width: 100%
      		}
        </style>
    </head>
    <body>
      <script>
      $(function () {
      $('[data-toggle="tooltip"]').tooltip()})
      </script>
		<section>
		<article>
        <?php
            $utente = $_SESSION['idutente'];
            $connessione = mysqli_connect("localhost", "id13768971_admin", "N2+?7hOGh3on=Em!", "id13768971_lattanzio") or die("Il server non risponde" . mysqli_error()); //connessione al database
            $query = "select prestiti_in_attesa.idprestito, prestiti_in_attesa.dataprestito, prestiti_in_attesa.datarestituzione, utenti.idutente, utenti.nome, utenti.cognome, libri.titolo, libri.codice
                      from prestiti_in_attesa, utenti, libri
                      where utenti.idutente = prestiti_in_attesa.utente and libri.codice = prestiti_in_attesa.libro and prestiti_in_attesa.utente = $utente
                      order by dataprestito";     //query per stampare le informazione sul singolo libro
            ?> <h2>Prestiti in attesa</h2> <?php
            $risultato = mysqli_query($connessione, $query);  //esegue query
            if (mysqli_num_rows($risultato) != 0) {      //se il numero di righe restituite è diverso da 0
                echo "<table>";
                echo "<tr><th>Libro</th><th>Inizio prestito</th><th>Fine prestito</th></tr>";
                while ($row = mysqli_fetch_array($risultato)) {     //fin quando ci sono righe la variabile row prende il risultato della query
                    echo "<tr>";
                    echo "<td class='cella'>$row[titolo]</td>";
                    echo "<td class='cella'>$row[dataprestito]</td>";
                    echo "<td class='cella'>$row[datarestituzione]</td>";
                    echo "<td><a href='libro.php?codice=$row[codice]&titolo=$row[titolo]' class='black' data-toggle='tooltip' title='Visualizza tutti i dettagli'><i style='font-size:24px' class='fas'>&#xf05a;</i></a></td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
            if (mysqli_num_rows($risultato) == 0) {
                echo "<h3>Non ci sono prestiti in attesa.</h3>";
            }
            echo "<br>";
            echo "<hr style='border: 1px solid blue; width:50%;'>";
            ?> <h2>Prestiti accettati</h2> <?php
            $query2 = "select prestiti.idprestito, prestiti.dataprestito, prestiti.datarestituzione, utenti.idutente, utenti.nome, utenti.cognome, libri.titolo, libri.codice
                      from prestiti, utenti, libri
                      where utenti.idutente = prestiti.utente and libri.codice = prestiti.libro and prestiti.utente = $utente
                      order by dataprestito";     //query per stampare le informazione sul singolo libro
            $risultato2 = mysqli_query($connessione, $query2);  //esegue query
            if (mysqli_num_rows($risultato2) != 0) {      //se il numero di righe restituite è diverso da 0
                echo "<table>";
                echo "<tr><th>Libro</th><th>Inizio prestito</th><th>Fine prestito</th></tr>";
                while ($row2 = mysqli_fetch_array($risultato2)) {     //fin quando ci sono righe la variabile row prende il risultato della query
                    echo "<tr>";
                    echo "<td class='cella'>$row2[titolo]</td>";
                    echo "<td class='cella'>$row2[dataprestito]</td>";
                    echo "<td class='cella'>$row2[datarestituzione]</td>";
                    echo "<td><a href='libro.php?codice=$row2[codice]&titolo=$row2[titolo]' class='black' data-toggle='tooltip' title='Visualizza tutti i dettagli'><i style='font-size:24px' class='fas'>&#xf05a;</i></a></td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
            if (mysqli_num_rows($risultato2) == 0) {
                echo "<h3>Non ci sono prestiti accettati.</h3>";
            }
            echo "<br>";
            echo "<hr style='border: 1px solid blue; width:50%;'>";
            ?> <h2>Prestiti rifiutati o terminati</h2> <?php
            $query3 = "select prestiti_rifiutati.motivo, prestiti_rifiutati.idprestito, prestiti_rifiutati.dataprestito, prestiti_rifiutati.datarestituzione, utenti.idutente, utenti.nome, utenti.cognome, libri.titolo, libri.codice
                      from prestiti_rifiutati, utenti, libri
                      where utenti.idutente = prestiti_rifiutati.utente and libri.codice = prestiti_rifiutati.libro and prestiti_rifiutati.utente = $utente
                      order by dataprestito";     //query per stampare le informazione sul singolo libro
            $risultato3 = mysqli_query($connessione, $query3);  //esegue query
            if (mysqli_num_rows($risultato3) != 0) {      //se il numero di righe restituite è diverso da 0
                echo "<table>";
                echo "<tr><th>Libro</th><th>Inizio prestito</th><th>Fine prestito</th><th>Motivo</th></tr>";
                while ($row3 = mysqli_fetch_array($risultato3)) {     //fin quando ci sono righe la variabile row prende il risultato della query
                    echo "<tr>";
                    echo "<td class='cella'>$row3[titolo]</td>";
                    echo "<td class='cella'>$row3[dataprestito]</td>";
                    echo "<td class='cella'>$row3[datarestituzione]</td>";
                    echo "<td class='cella'>$row3[motivo]</td>";
                    echo "<td><a href='libro.php?codice=$row3[codice]&titolo=$row3[titolo]' class='black' data-toggle='tooltip' title='Visualizza i dettagli del libro'><i style='font-size:24px' class='fas'>&#xf05a;</i></a></td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
            if (mysqli_num_rows($risultato3) == 0) {
                echo "<h3>Non ci sono prestiti rifiutati o terminati.</h3>";
            }
            mysqli_close($connessione);
        ?>
		</article>
    <aside>
      <table class="aside"><caption>La biblioteca</caption><tr><td><a href="https://www.divittoriolattanzio.it/home/index.php/biblioteca.html" target="_blank"><img class="rounded"src="https://www.divittoriolattanzio.it/home/images/biblioteca.jpg" width="100%" height="85px"></a></td></tr></table>
  <br>
      <table class="aside"><caption>L'istituto</caption><tr><td><a href="https://www.divittoriolattanzio.it/home/index.php" target="_blank"><img src="https://www.divittoriolattanzio.it/home/images/logo-scuola.png" width="100%" height="85px"></a></td></tr></table>
    </aside>
		</section>
    <footer>
      Made by Fabio Iacus © 2020
   </footer>
    </body>
</html>
