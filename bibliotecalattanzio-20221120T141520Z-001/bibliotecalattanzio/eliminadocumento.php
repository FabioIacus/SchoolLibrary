<?php
include 'inizio.inc';
?>
<html>
    <head>
        <title>Eliminazione Documento</title>
        <meta charset="windows-1252">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
      </head>
    <body>
	<section>
	<article>
    <p>
    <a style="cursor: pointer" class="black" onclick="javascript:history.go(-1)" data-toggle="tooltip" title="Torna indietro"><i class="material-icons">&#xe5c4;</i></a>
    </p>
        <h1>Elimina documento</h1>
			  <p>
        <form action="esegui.php?azione=ELIMINA_DOCUMENTO" method="POST">
        <p>
				Seleziona documento:
        <?php
        $conn=mysqli_connect("localhost", "id13768971_admin","N2+?7hOGh3on=Em!", "id13768971_lattanzio") or die("Il server non risponde" . mysqli_error());
        $query="SELECT * from condividere4, documenti where documenti.id = condividere4.documento and condividere4.insegnante = " . $_SESSION["idutente"] . " order by condividere4.documento";
        $risultato=mysqli_query($conn,$query);
        if (mysqli_num_rows($risultato) != 0){
          echo "<select name=\"id\" required>";
          while ($row=mysqli_fetch_array($risultato)) {
            echo "<option value=\"$row[documento]\">$row[descrizione]&nbsp&nbsp&nbsp- Caricato nel $row[anno] -</option>";
          }
          echo "</select>";
        }
        if (mysqli_num_rows($risultato) == 0) {
            echo "<h2>Non ci sono dati.</h2>";
        }
        mysqli_close($conn);
        ?>
				</p>
        <p>
				<input type="submit" value="Elimina">
				</p>
			</form>
			</p>
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
