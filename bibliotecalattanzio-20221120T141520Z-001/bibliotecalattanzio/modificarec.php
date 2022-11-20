<?php
include 'inizio.inc';
$libro=$_GET["libro"];
$titolo=$_GET["titolo"];
$id = $_GET["id"];
$testo = $_GET["testo"];
?>
<html>
    <head>
        <title>Modifica Recensione</title>
        <meta charset="windows-1252">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
	<section>
		<article>
      <p>
      <a style="cursor: pointer" class="black" onclick="javascript:history.go(-1)" data-toggle="tooltip" title="Torna indietro"><i class="material-icons">&#xe5c4;</i></a>
      </p>
        <h3>Modifica recensione</h3>
        <form action="esegui.php?azione=MODIFICA_REC&libro=<?php echo $libro ?>&titolo=<?php echo $titolo ?>&id=<?php echo $id ?>" method="POST">
			<p>Modifica testo:</p>
        <textarea style="resize:none" name="testo" rows="4" maxlength="1000" cols="50" placeholder="Inserisci qui la tua recensione..."><?php echo $testo ?></textarea>
      <p>Modifica voto:
			<select name="voto" required>
        <?php
        $conn=mysqli_connect("localhost", "id13768971_admin","N2+?7hOGh3on=Em!", "id13768971_lattanzio") or die("Il server non risponde" . mysqli_error());
        $query = "SELECT voto from recensioni where id = $_GET[id]";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($result);
        $cont = 1;
        while($cont <= 5){
          echo "<option value=$cont ";
          if($row["voto"] == $cont)
          echo "selected=selected";
          echo "> $cont </option>";
          $cont++;

        }
        ?>
      </select>
    </p>
			<p><input type="submit" value="Modifica"></p>
		</form>
		</article>
    <aside>
      <table><caption>La biblioteca</caption><tr><td><a href="https://www.divittoriolattanzio.it/home/index.php/biblioteca.html" target="_blank"><img class="rounded"src="https://www.divittoriolattanzio.it/home/images/biblioteca.jpg" width="100%" height="85px"></a></td></tr></table>
  <br>
      <table><caption>L'istituto</caption><tr><td><a href="https://www.divittoriolattanzio.it/home/index.php" target="_blank"><img src="https://www.divittoriolattanzio.it/home/images/logo-scuola.png" width="100%" height="85px"></a></td></tr></table></aside>
		</section>
    <footer>
      Made by Fabio Iacus © 2020
   </footer>
    </body>
</html>
