<?php
include 'inizio.inc';
?>
<html>
    <head>
        <title>Editori</title>
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
        <h2>Elenco editori</h2>
        <a class="black" href="inserimentoeditore.php" data-toggle="tooltip" title="Aggiungi editore"><i class="material-icons" alt="">&#xe146;</i></a>
        <br>
        <br>
        <?php
            $connessione = mysqli_connect("localhost", "id13768971_admin", "N2+?7hOGh3on=Em!", "id13768971_lattanzio") or die("Il server non risponde" . mysqli_error());
            $query = "select *
                      from editori
					  order by ideditore";
            $risultato = mysqli_query($connessione, $query);
            if (mysqli_num_rows($risultato) != 0) {
                echo "<table>";
                echo "<tr><th>IdEditore</th><th>Nome</th><th>Sede</th><th>Telefono</th><th>Anno Fondazione</th></tr>";
                while ($row = mysqli_fetch_array($risultato)) {
                    echo "<tr>";
                    echo "<td class='cella'>$row[idEditore]</td>";
                    echo "<td class='cella'>$row[nome]</td>";
                    echo "<td class='cella'>$row[sede]</td>";
                    echo "<td class='cella'>$row[telefono]</td>";
                    echo "<td class='cella'>$row[annoFondazione]</td>";
                    echo "<td class='cella'><a href='modificaeditore.php?id=$row[idEditore]'>Modifica</a></td>";
                    echo "<td class='cella'><a href='esegui.php?id=$row[idEditore]&azione=ELIMINA_EDITORE' onclick=\"return confirm('sei sicuro?');\">Elimina</a></td>";
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
