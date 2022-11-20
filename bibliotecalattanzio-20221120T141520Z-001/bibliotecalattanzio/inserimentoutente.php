<?php
include 'inizio.inc';
?>
<html>
<head>
<title>Inserimento Utente</title>
<link href="style.css" rel="stylesheet" type="text/css">
</head>
<?php
if (isset($_GET["var"])) {
  echo "<body>";
}
else {
  echo "<body onload='indice0()'>";
}?>
<section>
<article>
  <p>
  <a style="cursor: pointer" class="black" onclick="javascript:history.go(-1)" data-toggle="tooltip" title="Torna indietro"><i class="material-icons">&#xe5c4;</i></a>
  </p>
<h3>Inserimento nuovo utente </h3>
<form action="gestioneutenti.php?azione=IU" method="POST">
  <p>Seleziona il ruolo:
 				<?php
 		$conn=mysqli_connect("localhost", "id13768971_admin","N2+?7hOGh3on=Em!", "id13768971_lattanzio") or die("Il server non risponde" . mysqli_error());
 		$query="SELECT * from ruoli";
 		$risultato=mysqli_query($conn,$query);
 		if (mysqli_num_rows($risultato) != 0)
 			{
         echo "<select name='ruolo' id='mySelect' onchange='selezionaclasse()' required>";
 				while ($row=mysqli_fetch_array($risultato))
 				{
           if (isset($_GET["var"])) {
           echo "<option value=\"$_GET[var]\" selected>$_GET[txt]</option>";
           if ($row["IDRuolo"] == $_GET["var"]) {
           } else {
           echo "<option value=\"$row[IDRuolo]\">$row[Ruolo]</option>";
         }
           $tmp = $_GET["var"];
           $_GET["var"] = null;
         } else {
           if ($row["IDRuolo"] == $tmp) {
           } else {
             echo "<option value=\"$row[IDRuolo]\">$row[Ruolo]</option>";
             }
         }
 				}
 				echo "</select>	";
 			}
 		mysqli_close($conn);
 		?>
  </p>
 <p>Inserisci il cognome:
 <input type="text" name="cognome" placeholder="es. Rossi"maxlength="30"required autofocus>
 </p>
<p>Inserisci il nome:
 <input type="text" name="nome" placeholder="es. Mario" maxlength="20" required autofocus>
 </p>
<p>Inserisci username:
 <input type="text" name="username" placeholder="0000" maxlength="30" required autofocus>
</p>
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
 <p>Inserisci il telefono:
 <input type="text" name="telefono"  placeholder="es. 123456789" maxlength="14" onkeypress="onlyNumbers(event)" required autofocus>
 </p>
 <p>Inserisci la data di nascita:
   <input type="date" name="data" placeholder="gg/mm/aaaa" onkeypress="onlyNumbers(event)" required autofocus>
 </p>
 <p>Inserisci la password:
 <input type="password" name="password1"  placeholder="password" maxlength="20" required autofocus>
 </p>
 <p>Conferma la password:
   <input type="password" name="password2"  placeholder="riscrivi password" maxlength="20" required autofocus>
</p>
<table>
  <tr>
 <td><p>Seleziona classe:</td><?php
    if (isset($_GET["f"])) {
      if ($_GET["f"] == 'true') {
        if ($tmp == "1") {
    echo "<td><select name='classe' disabled>";
    $conn=mysqli_connect("localhost", "id13768971_admin","N2+?7hOGh3on=Em!", "id13768971_lattanzio") or die("Il server non risponde" . mysqli_error());
    $query = "select classi.nome, classi.id from classi order by classi.id";
    $risultato = mysqli_query($conn,$query);
    while ($row = mysqli_fetch_array($risultato)) {
      echo "<option value=\"$row[id]\">$row[nome]</option>";
    }
  }  else {
     echo "<td><select name='classe[]' required multiple>";
     $conn=mysqli_connect("localhost", "id13768971_admin","N2+?7hOGh3on=Em!", "id13768971_lattanzio") or die("Il server non risponde" . mysqli_error());
     $query = "select classi.nome, classi.id from classi order by classi.id";
     $risultato = mysqli_query($conn,$query);
     while ($row = mysqli_fetch_array($risultato)) {
       echo "<option value=\"$row[id]\">$row[nome]</option>";
     }
   }
 }
} else {
   echo "<td><select name='classe' disabled>";
   $conn=mysqli_connect("localhost", "id13768971_admin","N2+?7hOGh3on=Em!", "id13768971_lattanzio") or die("Il server non risponde" . mysqli_error());
   $query = "select classi.nome, classi.id from classi order by classi.id";
   $risultato = mysqli_query($conn,$query);
   while ($row = mysqli_fetch_array($risultato)) {
     echo "<option value=\"$row[id]\">$row[nome]</option>";
   }
 }
 mysqli_close($conn);
     ?>
   </select></td>
 </tr>
</table>
</p>
<p><i>*per inserire più classi premi il tasto Ctrl</i></p>
 <p><input type="submit" value="Inserisci"></p>
</form>
</article>
<script>
function selezionaclasse() {
  var x = document.getElementById("mySelect").value;
  var y = document.getElementById("mySelect").selectedIndex;
  var z = document.getElementById("mySelect").options;
  var f = true;
  window.location.href = "https://bibliotecalattanzio.000webhostapp.com/inserimentoutente.php?var=" + x + "&ind=" + y + "&txt=" + z[y].text + "&f=" + f;
}
function indice0() {
  document.getElementById("mySelect").selectedIndex = "-1";
}
</script>
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
