<?php
include 'inizio.inc';
?>
<html>
    <head>
        <title>Libri</title>
        <meta charset="windows-1252">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
	       .cella {
            border:1px black solid;
            padding: 5px;
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
      <script>
      $(function () {
      $('[data-toggle="tooltip"]').tooltip()})
      </script>
		<section>
		<article>
		<br>
        <h2>Elenco libri</h2>
        <a class="black" href="inserimentolibro.php" data-toggle="tooltip" title="Aggiungi libro"><i class="material-icons" alt="">&#xe146;</i></a>
        <br>
        <br>
        <?php
            $connessione = mysqli_connect("localhost", "id13768971_admin", "N2+?7hOGh3on=Em!", "id13768971_lattanzio") or die("Il server non risponde" . mysqli_error()); //connessione al database
            $query2 = "select libri.codice, libri.titolo, libri.editore, libri.annopubblic, editori.nome, GROUP_CONCAT(autori.nome) as aut
                      from libri, editori, scrittura, autori, immagazzinare, istituto
                      where libri.editore = editori.ideditore and libri.codice = scrittura.libro and autori.idautore = scrittura.autore and libri.codice = immagazzinare.libro and istituto.id = immagazzinare.istituto and immagazzinare.istituto = '" . $_SESSION["istituto"] . "'
                      group by libri.codice";     //query per stampare le informazione sul singolo libro
            $risultato2 = mysqli_query($connessione, $query2);  //esegue query
            if (mysqli_num_rows($risultato2) != 0) {      //se il numero di righe restituite è diverso da 0
                echo "<table>";
                echo "<tr><th>Codice</th><th>Titolo</th><th>Autore</th><th>Editore</th><th>Anno</th></tr>";
                while ($row2 = mysqli_fetch_array($risultato2)) {     //fin quando ci sono righe la variabile row prende il risultato della query
                    echo "<tr>";
                    echo "<td class='cella'>$row2[codice]</td>";
                    echo "<td class='cella'>$row2[titolo]</td>";
                    echo "<td class='cella'>$row2[aut]</td>";
                    echo "<td class='cella'>$row2[nome]</td>";
                    echo "<td class='cella'>$row2[annopubblic]</td>";
                    echo "<td class='cella'><a href='modificalibro.php?id=$row2[codice]&autore=$row2[aut]'>Modifica</a></td>";
                    echo "<td class='cella'><a href='esegui.php?codice=$row2[codice]&azione=ELIMINA_LIBRO' onclick=\"return confirm('sei sicuro?');\">Elimina</a></td>";
                    echo "<td><a href='libro.php?codice=$row2[codice]&titolo=$row2[titolo]' class='black' data-toggle='tooltip' title='Visualizza immagine e recensioni'><i style='font-size:24px' class='fas'>&#xf05a;</i></a></td>";
                    echo "</tr>";
                }
                echo "</table>";
            }
            if (mysqli_num_rows($risultato2) == 0) {
                echo "<h2>Non ci sono dati.</h2>";
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
