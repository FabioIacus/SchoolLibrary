<?php ob_start(); ?>
<?php
session_start();
?>
<html>
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<style>
	/*contenitore in cima dove c'è scritto "Login"*/
.pre_contenitore{
	  width:320px;
	  margin:auto;
		margin-top: 30px;
	  height:50px;
	  border:1px solid black;
	  border-radius: 40px 40px 0px 0px;
	   background-color:rgba(0,0,0,0.9);
	   box-shadow: 20px 30px 20px #000000;
	   padding:20px;
}

.pre_contenitore p{
     color:white;
     text-align: center;
     font-size: 1.9em;
     font-family: arial;
    line-height:2px;

}
.pre_contenitore b{
     color:white;
     text-align: center;
     font-size: 12;
     font-family: arial;
    line-height:2px;
	color: red;
}


body{
	background: linear-gradient(to top right, #66ffff 0%, #66ff66 100%);
	text-align: center;
}

/*contenitore contenete il form */

.contenitore {
	  border:1px solid black;
	  margin:auto;
	  width: 320px;
      height: 390px;
      border-radius: 0px 0px 40px 40px;
      padding:20px;
      background-color:rgba(0,0,0,0.8);
      box-shadow: 20px 20px 20px #000000;
      color:white;
}

.contenitore input{
    width: 100%;
    margin-bottom: 20px;
    border:none;
    border:1px solid black;
    height: 30px;

}
.contenitore input[type="text"], input[type="password"] /* i css si riferiscono solo alla barra ditesto */
{
    border: none;
    border-bottom: 1px solid #fff;
    background: transparent;
    outline: none;
    height: 40px;
    color: #fff;
    font-size: 16px;
}

.contenitore p{

}
.contenitore input[type="submit"]{  /* i css si riferiscono solo al pulsante */
	border-radius: 14px;
	height: 40px;
}

.contenitore input[type="submit"]:hover {
	background: lightblue;
}
    </style>
</head>
	<body>
<?php
		if(isset($_GET["verifica"]))
		{
				if ($_GET["verifica"]=="si")
				{
					$trovato=false;
					$conn=mysqli_connect("localhost", "id13768971_admin", "N2+?7hOGh3on=Em!", "id13768971_lattanzio") or die("Il server non risponde" . mysqli_error());
					$sql="select istituto.nome as scuola, utenti.Nome, utenti.IDUtente, utenti.IDIstituto, utenti.Cognome, ruoli.Ruolo from utenti, ruoli, istituto where utenti.idruolo=ruoli.idruolo and istituto.id = utenti.IDIstituto and username='" . $_POST["username"] . "' and PW='" . $_POST["password"] . "' GROUP BY utenti.IDUtente";
					$risultato=mysqli_query($conn,$sql);
		            if (mysqli_num_rows($risultato) != 0)
					{
						$row=mysqli_fetch_array($risultato);
						$query2="SELECT classi.id from classi, appartenenza, utenti where classi.id = appartenenza.classe and utenti.IDUtente = appartenenza.utente and appartenenza.utente = " . $row["IDUtente"] . "";
				    $risultato2=mysqli_query($conn,$query2);
				    $row2 = mysqli_fetch_array($risultato2);
				    $classe = $row2["id"];
						$_SESSION['nome']=$row['Nome'];
						$_SESSION['cognome']=$row['Cognome'];
						$_SESSION['idutente']=$row['IDUtente'];
						$_SESSION['statoutente']=$row['Ruolo'];
						$_SESSION['istituto']=$row['IDIstituto'];
						$_SESSION['nistituto']=$row['scuola'];
						if (isset($classe)){
						$_SESSION['classe'] = $classe;
						}
						$trovato=true;
						header("location:index.php?var=vero");
}
					}
				}
?>
        <div class="pre_contenitore">
			<p>Login</p>
			<?php
			if (isset($trovato)) {
			if ($trovato == false) {
				echo "<br>";
				echo "<b>USERNAME O PASSWORD ERRATI</b>";
			}
			}
			?>
		</div>
		<div class="contenitore">
			<form action="login.php?verifica=si" method="post">
				<p>Inserisci le tue credenziali</p>
					<p>
						<label>Username</label><br>
							<input type="text" name="username" class="username" placeholder="Username" required autofocus>
					</p>
					<p>
						<label>Password</label><br>
							<input type="password" id="pwd" name="password" class="password" placeholder="Password" required autofocus>
							<input type="button" style="width: 180px;" onclick="showPwd()" value="Mostra/nascondi password">
					</p>
						<input type="submit" name="btn" value="Accedi">
			</form>
			<script>
			function showPwd() {
        var input = document.getElementById('pwd');
        if (input.type === "password") {
          input.type = "text";
        } else {
          input.type = "password";
        }
      }
			</script>
			<p>
						<form action="index.php">
						<button name="indietro" type="submit" value="Indietro">Torna alla home page</button>
						</form>
						</p>
		</div>

	</body>
</html>
