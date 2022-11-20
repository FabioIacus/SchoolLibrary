<?php
include 'inizio.inc';
?>
<html>
    <head>
        <title>Libri</title>
        <style>
	         .cella {
             border:1px black solid;
             padding: 5px;
          }
          table {
            border-collapse: collapse;
            width:50%;
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

        <h2>Elenco libri</h2>
        <?php
            $connessione = mysqli_connect("localhost", "id13768971_admin", "N2+?7hOGh3on=Em!", "id13768971_lattanzio") or die("Il server non risponde" . mysqli_error()); //connessione al database
            $query = "select libri.codice, libri.titolo, libri.editore, libri.annopubblic, editori.nome, GROUP_CONCAT(autori.nome) as aut
                      from libri, editori, scrittura, autori, immagazzinare, istituto
                      where libri.editore = editori.ideditore and libri.codice = scrittura.libro and autori.idautore = scrittura.autore and libri.codice = immagazzinare.libro and istituto.id = immagazzinare.istituto and immagazzinare.istituto = '" . $_SESSION["istituto"] . "'
                      group by libri.codice";     //query per stampare le informazione sul singolo libro
            $risultato = mysqli_query($connessione, $query);  //esegue query
            if (mysqli_num_rows($risultato) != 0) {      //se il numero di righe restituite è diverso da 0
                echo "<table>";
                echo "<tr><th>Titolo</th></tr>";
                while ($row = mysqli_fetch_array($risultato)) {     //fin quando ci sono righe la variabile row prende il risultato della query
                    echo "<tr>";
                    echo "<td class='cella'>$row[titolo]</td>";
                    echo "<td><a href='libro.php?codice=$row[codice]&titolo=$row[titolo]' class='black' data-toggle='tooltip' title='Visualizza tutti i dettagli'><i style='font-size:24px' class='fas'>&#xf05a;</i></a></td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
            if (mysqli_num_rows($risultato) == 0) {
                echo "<h2>Non ci sono dati.</h2>";
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
