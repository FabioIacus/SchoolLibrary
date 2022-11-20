<?php ob_start(); ?>
<?php
function runSql($sql,$conn) {
	$risultato=mysqli_query($conn,$sql);
}
include 'inizio.inc';
?>
<html>
    <head>
        <title>Registrazione</title>
    </head>
    <body>
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
	<section>
	<article>
        <?php
		if (isset($_GET["verifica"])) {
			if ($_GET["verifica"] == "si") {
				if ($_POST["password1"] == $_POST["password2"]) {
					$conn=mysqli_connect("localhost", "id13768971_admin","N2+?7hOGh3on=Em!", "id13768971_lattanzio") or die("Il server non risponde" . mysqli_error());
					$controlla= "select istituto.codice from istituto where istituto.codice = '$_POST[codice]'";
					$r = mysqli_query($conn,$controlla);
					if (mysqli_num_rows($r) != 0) {
					$cognome=$_POST["cognome"];
	        $nome = $_POST["nome"];
	        $telefono = $_POST["telefono"];
	        $username = $_POST["username"];
	        $password1 = $_POST["password1"];
	        $codice = $_POST['codice'];
					$data = $_POST['data'];
					$classe = $_POST['classe'];
					$conn = mysqli_connect("localhost", "id13768971_admin","N2+?7hOGh3on=Em!", "id13768971_lattanzio") or die("Il server non risponde" . mysqli_error());
					$query = "select istituto.id from istituto where istituto.codice = '$codice' ";
					$risultato = mysqli_query($conn,$query);
					$row = mysqli_fetch_array($risultato);
					$sql="insert into utenti (cognome,nome,telefono,username, pw, idruolo, idistituto, data_nascita) values ('" .  addslashes($_POST['cognome']) . "','" .
					addslashes($_POST['nome']) . "','".  addslashes($_POST['telefono']) . "','" .  addslashes($_POST['username']) . "','" .  addslashes($_POST['password1']) . "'," . "2" . ", '$row[id]' , '" . $data . "')";
					runSql($sql,$conn);
					$query2 = "select utenti.IDUtente from utenti where utenti.username = '$username' ";
					$risultato2 = mysqli_query($conn,$query2);
					$row2 = mysqli_fetch_array($risultato2);
					$sql2="insert into appartenenza (utente, classe) values ('$row2[IDUtente]','$classe')";
					runSql($sql2,$conn);
					mysqli_close($conn);
					header("location: index.php");
				} else {
					echo "<b><p style='color: red; text-align:center; margin-top: 0em;'>Non esiste nessuna scuola con il codice che hai inserito!</p></b>";
				}
				}
				else {
					echo "Le due password non coincidono!";
				}
			}
		}
		?>
		<form action="registrazione.php?verifica=si" method="post">
            <h1 style="text-align:center; font-size: 21px;">Registrazione</h1>
						<table align="center">
							<tr>
            <td><p style="text-align:center">Cognome: </td><td><input type="text" placeholder="es. Rossi" name="cognome" maxlength="30" required></p></td>
					</tr>
						<tr>
							<td><p style="text-align:center">Nome: </td><td><input type="text" placeholder="es. Mario" name="nome" maxlength="20" required></p></td>
            </tr>
						<tr>
						<td><p style="text-align:center">Telefono: </td><td><input type="text" placeholder="es. 123456789" name="telefono" maxlength="14" onkeypress="onlyNumbers(event)" required></p><td>
						</tr>
						<tr>
						<td><p style="text-align:center">Data di nascita: </td><td><input type="date" placeholder="gg/mm/aaaa" name="data" onkeypress="onlyNumbers(event)" required></p></td>
					</tr>
					<tr>
						<td><p style="text-align:center">Codice scuola: </td><td><input type="text" placeholder="Codice identificativo scuola" name="codice" onkeypress="onlyNumbers(event)" maxlength="4" required></p></td>
					</tr>
					<tr>
						<td style="text-align:center">Seleziona classe:</td>
						<td><select name="classe" required>
							<?php
							$conn=mysqli_connect("localhost", "id13768971_admin","N2+?7hOGh3on=Em!", "id13768971_lattanzio") or die("Il server non risponde" . mysqli_error());
							$query = "select classi.nome, classi.id from classi order by classi.id";
							$risultato = mysqli_query($conn,$query);
							while ($row = mysqli_fetch_array($risultato)) {
								echo "<option value=\"$row[id]\">$row[nome]</option>";
							}
							?>
						</select></td>
					</tr>
					<tr>
						<td><p style="text-align:center">Username: </td><td><input type="text" placeholder="Username" name="username" maxlength="30" required></p></td>
					</tr>
					<tr>
						<td><p style="text-align:center">Password: </td><td><input type="password" placeholder="Password" name="password1" maxlength="20" required></p></td>
					</tr>
					<tr>
					<td>  <p style="text-align:center">Conferma Password: </td><td><input type="password" placeholder="Password" name="password2" required></p></td>
				</tr>
				<tr>
					<td colspan="2" style="padding:12px;">  <p style="text-align:center"><button type="submit" name="login">Registrati</button></p></td>
					</tr>
				</table>
				</form>
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
