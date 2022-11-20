<?php
include 'inizio.inc';
?>
<html>
<head>
    <title>Modifica Libro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<section>
		<article>
      <p>
      <a style="cursor: pointer" class="black" onclick="javascript:history.go(-1)" data-toggle="tooltip" title="Torna indietro"><i class="material-icons">&#xe5c4;</i></a>
      </p>
      <h1>Modifica libro</h1></p>
<?php
		$codice = $_GET["id"];
		$conn = mysqli_connect("localhost", "id13768971_admin", "N2+?7hOGh3on=Em!", "id13768971_lattanzio") or die("Il server non risponde" . mysqli_error());
		$query = "SELECT libri.codice, libri.titolo, editori.nome, editori.idEditore ,libri.annoPubblic, GROUP_CONCAT(autori.nome) as aut, autori.idAutore
		FROM libri, editori, scrittura, autori
		where libri.editore = editori.idEditore and libri.codice = scrittura.libro and scrittura.autore = autori.idAutore and libri.codice = '$codice'
		group by libri.codice";
			$result = mysqli_query($conn, $query);
            $row=mysqli_fetch_array($result);
			echo "<form action=esegui.php?azione=MODIFICA_LIBRI&cod=$codice method='POST'>";
			?>
			<p>Codice: <input type="text" name="isbn" value='<?php echo $row["codice"] ?>' maxlength="13" onkeypress="onlyNumbers(event)"></p>
            <p>Titolo: <input type="text" name="titolo" value="<?php echo $row["titolo"] ?>"></p>
            <p>Anno Pubblicazione: <input type="text" name="anno" value=" <?php echo $row["annoPubblic"] ?>" maxlength="5" onkeypress="onlyNumbers(event)"></p>
            <p>Editore:
			<?php
			$query = "SELECT * from editori order by nome";
            $risultato = mysqli_query($conn, $query);
            if(mysqli_num_rows($risultato) != 0){
				echo "<select name='editore' selected>";
				$ID = $row['idEditore'];
                $nome = $row['nome'];
                echo "<option value='$ID'>$nome</option>";
                while($riga=mysqli_fetch_array($risultato))
                {
                    if($ID != $riga['idEditore']){
                        echo "<option value='$riga[idEditore]'>$riga[nome]</option>";
                    }
                }
                echo "</select>";
            }
			echo "</p>";
			$idAutore = $_GET["autore"];
            echo "<p>Seleziona autore:<br>";
            $query = "SELECT * from autori order by nome";
            $result = mysqli_query($conn, $query);
            if(mysqli_num_rows($result) != 0){
              $ID =  explode(",", $row["idAutore"]);
                $nome = explode(",", $row["aut"]);
                while($riga=mysqli_fetch_array($result))
                {
                  $testo = "$riga[nome] <input type='checkbox' id='autore' name='aut[]'' value='$riga[idAutore]' ";
                    for ($i = 0; $i < count($nome); $i++) {
                        if ($nome[$i] == $riga["nome"]) {
                            $testo .= "checked=checked";
                        }
                    }
                    $testo .= "><br>";
                    echo $testo;
				         }
            }
			         else {
                    echo "Non ci sono autori.";
              }
			        echo "</p>";
              echo "<p><input type='submit' value='Modifica'></p>";
              echo "</form>";
?>
<script type="text/javascript">
function onlyNumbers(evt) {
var theEvent = evt || window.event;
var key = theEvent.keyCode || theEvent.which;
key = String.fromCharCode( key );
var regex = /[0-9]/;
if( !regex.test(key) ) {
theEvent.returnValue = false;
if(theEvent.preventDefault) theEvent.preventDefault();
}
}
</script>
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
