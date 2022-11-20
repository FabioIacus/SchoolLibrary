 <?php
 if (isset($_SESSION['statoutente']))
 {

 switch ($_SESSION["statoutente"])
  {

	case "Utente":
	include 'inizioU.inc';
	break;
  case "Prof":
  include 'inizioP.inc';
  break;
	case "Amministratore":
	include 'inizioA.inc';
	break;
   }
  }
   else
   {
   ?>
   <li><a href="index.php"><img src="baseline_home_white_18dp.png"></a></li>
   <li style="float:right"><a href="login.php">Log In</a></li>
   <li style="float:right"><a href="registrazione.php">Registrati</a></li>
   <?php
  }
   ?>
