 <?php
 if (isset($_SESSION['statoutente']))
 {

 switch ($_SESSION["statoutente"])
  {

	case "Utente":
	echo "<li style='float:right;color:#feb236; padding: 14px 16px;'>Utente " . $_SESSION["nome"] . " " . $_SESSION["cognome"] . "</li>";
	echo "<li style='float:right'><a href='logout.php'>Log Out</a></li>";
	break;
  case "Prof":
	echo "<li style='float:right;color:#feb236; padding: 14px 16px;'>Prof. " . $_SESSION["nome"] . " " . $_SESSION["cognome"] . "</li>";
	echo "<li style='float:right'><a href='logout.php'>Log Out</a></li>";
	break;
	case "Amministratore":
	echo "<li style='float:right;color:#feb236; padding: 14px 16px;'>Amministratore " . $_SESSION["nome"] . " " . $_SESSION["cognome"] . "</li>";
	echo "<li style='float:right'><a href='logout.php'>Log Out</a></li>";
	break;

   }
  }
   else
   {
   ?>
   <li style="float:right"><a href="registrazione.php">Registrati</a></li>
   <li style="float:right"><a href="login.php">Log In</a></li>
   <?php
  }
   ?>
