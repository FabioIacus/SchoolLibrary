<?php
include 'inizio.inc';
?>
<html>
    <head>
        <title>Autori</title>
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
	<section>
		<article>
        <br>
        <h2>Elenco autori</h2>
        <a class="black" href="inserimentoautore.php" data-toggle="tooltip" title="Aggiungi autore"><i class="material-icons" alt="">&#xe146;</i></a>
        <br>
        <br>
        <?php
            $connessione = mysqli_connect("localhost", "id13768971_admin", "N2+?7hOGh3on=Em!", "id13768971_lattanzio");
            /*$query = "select autori.nome, autori.indirizzo, autori.telefono, autori.idAutore
                     from autori
                     order by idautore";*/
            $query = "select libri.codice, libri.titolo, autori.idAutore, autori.nome, GROUP_CONCAT(libri.titolo) as aut
  					from autori, scrittura, libri, immagazzinare, istituto
  					where libri.codice = scrittura.libro and autori.idautore = scrittura.autore and libri.codice = immagazzinare.libro and istituto.id = immagazzinare.istituto and immagazzinare.istituto = '" . $_SESSION["istituto"] . "'
  					group by autori.nome order by idAutore
  					";
            $risultato = mysqli_query($connessione, $query);
            if (mysqli_num_rows($risultato) != 0) {
                echo "<table>";
                echo "<tr><th>Id Autore</th><th>Nome</th><th>Libri scritti</th>";
                while ($row = mysqli_fetch_array($risultato)) {
                    echo "<tr>";
					          echo "<td class='cella'>$row[idAutore]</td>";
                    echo "<td class='cella'>$row[nome]</td>";
                    echo "<td class='cella'>$row[aut]</td>";
                    echo "<td class='cella'><a href='modificaautore.php?idAutore=$row[idAutore]'>Modifica</a></td>";
                    echo "<td class='cella'><a href='esegui.php?idAutore=$row[idAutore]&azione=ELIMINA_AUTORE' onclick=\"return confirm('sei sicuro?');\">Elimina</a></td>";
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
