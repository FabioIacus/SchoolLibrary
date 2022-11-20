<?php ob_start(); ?>
<?php
session_start();
 $conn=mysqli_connect("localhost", "id13768971_admin","N2+?7hOGh3on=Em!", "id13768971_lattanzio") or die("Errore" . mysqli_error());
 $sql="";
  function runSql($sql,$conn)
 {
      $risultato=mysqli_query($conn,$sql);
}

  switch ($_GET["azione"])
  {
	//REGISTRAZIONE UTENTE
	case "registrazione":
        $cognome=$_POST["cognome"];
        $nome = $_POST["nome"];
        $telefono = $_POST["telefono"];
        $username = $_POST["username"];
        $password1 = $_POST["password1"];
        $codice = $_POST['codice'];
        $query = "select istituto.id from istituto where istituto.";
        $istituto =
        $sql="insert into utenti (cognome,nome,telefono,username, pw, idruolo) values ('" .  addslashes($cognome) . "','" .  addslashes($nome) . "','".  addslashes($telefono) . "','" .  addslashes($username) . "','" .  addslashes($password1) . "'," . "2" . ")";
        runSql($sql,$conn);
        header("location: index.php");
    break;

    //AGGIUNGI VIDEO YT
  	case "AGGIUNGI_VIDEOYT":
  		  $link = $_POST["link"];
        $utente = $_SESSION['idutente'];
  		  echo "$utente";
        $descrizione = $_POST["descrizione"];
        $anno = $_POST["anno"];
        $sql = "INSERT INTO video_yt(src, descrizione) VALUES ('$link','$descrizione')";
        echo $sql;
        runSql($sql,$conn);
        $query2 = "select video_yt.id from video_yt where video_yt.src = '$link'";
        $risultato2 = mysqli_query($conn, $query2);
        $row2 = mysqli_fetch_array($risultato2);
        $sql2 = "INSERT INTO condividere(insegnante, video, anno) VALUES ('$utente','$row2[id]', '$anno')";
  		  echo $sql2;
        runSql($sql2,$conn);
        header("location: videoyt.php");
    break;
    //ELIMINA VIDEO YT
    case "ELIMINA_VIDEOYT":
      $id=$_POST["id"];
      $sql="delete from condividere where video = '$id'";
      $sql2="delete from video_yt where id ='$id'";
      runSql($sql,$conn);
      runSql($sql2,$conn);
      header("location:videoyt.php");
    break;

    //AGGIUNGI SITOGRAFIA
    case "AGGIUNGI_LINK":
  		  $link = $_POST["link"];
        $utente = $_SESSION['idutente'];
  		  echo "$utente";
        $descrizione = $_POST["descrizione"];
        $anno = $_POST["anno"];
        $sql = "INSERT INTO sitografie(src, descrizione) VALUES ('$link','$descrizione')";
        echo $sql;
        runSql($sql,$conn);
        $query2 = "select sitografie.id from sitografie where sitografie.src = '$link'";
        $risultato2 = mysqli_query($conn, $query2);
        $row2 = mysqli_fetch_array($risultato2);
        $sql2 = "INSERT INTO condividere2(insegnante, sitografia, anno) VALUES ('$utente','$row2[id]', '$anno')";
  		  echo $sql2;
        runSql($sql2,$conn);
        header("location: sitografie.php");
    break;
    //ELIMINA SITOGRAFIA
    case "ELIMINA_LINK":
      $id=$_POST["id"];
      $sql="delete from condividere2 where sitografia = '$id'";
      $sql2="delete from sitografie where id ='$id'";
      runSql($sql,$conn);
      runSql($sql2,$conn);
      header("location: sitografie.php");
    break;

    //AGGIUNGI VIDEO
    case "AGGIUNGI_VIDEO":
    if (!isset($_FILES['userfile']) || !is_uploaded_file($_FILES['userfile']['tmp_name'])) {
          echo 'Non hai inviato nessun file...';
          exit;
        }
        //percorso della cartella dove mettere i file caricati dagli utenti
        $uploaddir = 'video/';

        //Recupero il percorso temporaneo del file
        $userfile_tmp = $_FILES['userfile']['tmp_name'];

        //recupero il nome originale del file caricato
        $userfile_name = $_FILES['userfile']['name'];

        //copio il file dalla sua posizione temporanea alla mia cartella upload
        if (move_uploaded_file($userfile_tmp, $uploaddir . $userfile_name)) {
          //Se l'operazione è andata a buon fine...
          echo 'File inviato con successo.';
        }else{
          //Se l'operazione è fallta...
          echo 'Upload NON valido!';
        }
//

$riferimento_immagine = "https://bibliotecalattanzio.000webhostapp.com/immagini/" . $userfile_name;
$src = $userfile_name;
$src2 = str_replace('.mp4', '', $src);
$utente = $_SESSION['idutente'];
$descrizione = $_POST["descrizione"];
$anno = $_POST["anno"];
  $sql="INSERT INTO video(src, descrizione) VALUES ('$src2','$descrizione')";
    echo $sql;
    runSql($sql,$conn);
    $query2 = "select video.id from video where video.src = '$src2'";
    $risultato2 = mysqli_query($conn, $query2);
    $row2 = mysqli_fetch_array($risultato2);
    $sql2 = "INSERT INTO condividere3(insegnante, video, anno) VALUES ('$utente', '$row2[id]', '$anno')";
    echo $sql2;
   runSql($sql2,$conn);
   header("location: caricavideo.php");
    break;
    //ELIMINA VIDEO
    case "ELIMINA_VIDEO":
      $id=$_POST["id"];
      $sql="delete from condividere3 where video = '$id'";
      $sql2="delete from video where id ='$id'";
      runSql($sql,$conn);
      runSql($sql2,$conn);
      header("location:caricavideo.php");
    break;

    //AGGIUNGI DOCUMENTO
    case "AGGIUNGI_DOCUMENTO":
    if (!isset($_FILES['userfile']) || !is_uploaded_file($_FILES['userfile']['tmp_name'])) {
          echo 'Non hai inviato nessun file...';
          exit;
        }
        //percorso della cartella dove mettere i file caricati dagli utenti
        $uploaddir = 'documenti/';

        //Recupero il percorso temporaneo del file
        $userfile_tmp = $_FILES['userfile']['tmp_name'];

        //recupero il nome originale del file caricato
        $userfile_name = $_FILES['userfile']['name'];

        //copio il file dalla sua posizione temporanea alla mia cartella upload
        if (move_uploaded_file($userfile_tmp, $uploaddir . $userfile_name)) {
          //Se l'operazione è andata a buon fine...
          echo 'File inviato con successo.';
        }else{
          //Se l'operazione è fallta...
          echo 'Upload NON valido!';
        }
//

$riferimento_immagine = "https://bibliotecalattanzio.000webhostapp.com/immagini/" . $userfile_name;
$src = $userfile_name;
$src2 = $_FILES["userfile"]["type"];
echo $src2;
$utente = $_SESSION['idutente'];
$descrizione = $_POST["descrizione"];
$anno = $_POST["anno"];
  $sql="INSERT INTO documenti(src, descrizione) VALUES ('$src','$descrizione')";
    echo $sql;
    runSql($sql,$conn);
    $query2 = "select documenti.id from documenti where documenti.src = '$src'";
    $risultato2 = mysqli_query($conn, $query2);
    $row2 = mysqli_fetch_array($risultato2);
    $sql2 = "INSERT INTO condividere4(insegnante, documento, anno) VALUES ('$utente', '$row2[id]', '$anno')";
    echo $sql2;
   runSql($sql2,$conn);
   header("location: documenti.php");
    break;
    //ELIMINA VIDEO
    case "ELIMINA_DOCUMENTO":
      $id=$_POST["id"];
      $sql="delete from condividere4 where documento = '$id'";
      $sql2="delete from documenti where id ='$id'";
      runSql($sql,$conn);
      runSql($sql2,$conn);
      header("location: documenti.php");
    break;


    //AGGIUNGI RECENSIONE
    case "AGGIUNGI_REC":
      $utente=$_SESSION['idutente'];
      $codice=$_GET['libro'];
      $titolo=$_GET["titolo"];
      $testo=$_POST['testo'];
      $voto=$_POST['voto'];
      $data = date('Y-m-d');
      echo $codice;
      $sql = "INSERT INTO recensioni(utente, libro, testo, data, voto) VALUES ('$utente','$codice','$testo','$data','$voto')";
      echo $sql;
      runSql($sql,$conn);
      header("location: libro.php?codice=$codice&titolo=$titolo");
    break;

    //ELIMINA RECENSIONE
    case "ELIMINA_REC":
      $id = $_GET["id"];
      $codice=$_GET["libro"];
      $titolo=$_GET["titolo"];
      $sql="delete from recensioni where id = '$id'";
      runSql($sql,$conn);
      header("location: libro.php?codice=$codice&titolo=$titolo");
    break;

    //MODIFICA RECENSIONE
      case "MODIFICA_REC":
        $codice=$_GET["libro"];
        $titolo=$_GET["titolo"];
        $id=$_GET["id"];
        $testo = $_POST["testo"];
        $data = date('Y-m-d');
        $voto = $_POST["voto"];
        $sql="UPDATE recensioni SET testo ='$testo', data ='$data', voto = '$voto' WHERE id ='$id'";
        echo $sql;
        runSql($sql,$conn);
        header("location: libro.php?codice=$codice&titolo=$titolo");
    break;


	//AGGIUNGI PRESTITO DA UTENTE
	case "AGGIUNGI_PRESTITOU":
		$titolo = $_POST["libro"];
        $utente = $_SESSION['idutente'];
		echo "$utente";
        $datainizio = $_POST["datap"];
        $datafine = $_POST["datar"];
        $sql = " INSERT INTO prestiti_in_attesa(utente, libro, dataPrestito, dataRestituzione) VALUES ('$utente','$titolo','$datainizio','$datafine')";
		echo $sql;
        runSql($sql,$conn);
        header("location: statoprestiti.php");
    break;

    //QUERY RELATIVE ALL'AUTORE
      case "MODIFICA_AUTORE":
        $codice=$_GET["codice"];
        $nome = $_POST["nome"];
        $sql="UPDATE autori SET nome ='$nome' WHERE idAutore ='$codice'";
        echo $sql;
        runSql($sql,$conn);
        header("location: elencoautori.php");
    break;

      case "ELIMINA_AUTORE":
        $idAutore=$_GET["idAutore"];
        $sql="delete from autori where idAutore = '$idAutore'";
        runSql($sql,$conn);
        header("location:elencoautori.php");
      break;

      case "AGGIUNGI_AUTORE":
        //$id = $_POST["id"];
        $nome = $_POST["nome"];
        $sql="INSERT INTO autori (Nome) VALUES ('$nome')";
        runSql($sql,$conn) ;
        header("location: elencoautori.php");
      break;



      //QUERY RELATIVE ALL'EDITORE
      case "AGGIUNGI_EDITORE":
        //$id = $_POST["id"];
        $nome = $_POST["nome"];
        $sede = $_POST["sede"];
        $telefono= $_POST["telefono"];
        $anno = $_POST["anno"];
        $sql="INSERT INTO editori (Nome, Sede, Telefono, AnnoFondazione) VALUES ('$nome','$sede','$telefono', '$anno')";
        runSql($sql,$conn);
       // echo $sql;
        header("location: elencoeditori.php");
      break;

      case "ELIMINA_EDITORE":
        $id =$_GET["id"];
        $sql="delete from editori where idEditore = '$id'";
      //  echo $sql;
        runSql($sql,$conn);
        header("location:elencoeditori.php");
      break;


      case "MODIFICA_EDITORE":
        $id=$_GET["codice"];
        //$IdEditore = $_POST["id"];
        $nome = $_POST["nome"];
        $telefono= $_POST["telefono"];
        $sede = $_POST["sede"];
        $anno =$_POST["anno"];
        $sql="UPDATE editori SET Nome ='$nome', Sede ='$sede', Telefono = '$telefono', AnnoFondazione = '$anno' WHERE idEditore ='$id'";
       // echo $sql;
        runSql($sql,$conn);
        header("location: elencoeditori.php");
    break;

        //QUERY RELATIVE AI PRESTITI
        case "AGGIUNGI_PRESTITO":
          $titolo = $_POST["libro"];
          $utente = $_POST["utente"];
          $datainizio = $_POST["datap"];
          $datafine = $_POST["datar"];
          $sql = " INSERT INTO prestiti(utente, libro, dataPrestito, dataRestituzione) VALUES ('$utente','$titolo','$datainizio','$datafine')";
          runSql($sql,$conn);
          header("location: gestioneprestiti.php");
        break;

        case "AGGIUNGI_PRESTITO2":
          $titolo = $_GET["libro"];
          $utente = $_GET["utente"];
          $datainizio = $_GET["datap"];
          $datafine = $_GET["datar"];
          $sql = " INSERT INTO prestiti(utente, libro, dataPrestito, dataRestituzione) VALUES ('$utente','$titolo','$datainizio','$datafine')";
          runSql($sql,$conn);
          $id = $_GET["id"];
    		  $sql2="delete from prestiti_in_attesa where idprestito='$id'";
          runSql($sql2,$conn);
          header("location: gestioneprestiti.php");
        break;


        case "MODIFICA_PRESTITO":
          $id = $_GET["id"];
          $libro = $_GET["libro"];
          $data1 = $_GET["data1"];
          $data2 = $_GET["data2"];

          $codice = $_POST["codice"];
          $idUtente = $_POST["id1"];
          $datainizio = $_POST["datainizio"];
          $datafine = $_POST["datafine"];
          $sql = " UPDATE prestiti SET Utente='$idUtente', Libro='$codice', dataPrestito ='$datainizio', dataRestituzione='$datafine' WHERE Utente='$id' AND Libro='$libro'AND  dataPrestito ='$data1' AND dataRestituzione='$data2' ";
          runSql($sql,$conn);
          header("location: gestioneprestiti.php");
        break;




        case "ELIMINA_PRESTITO":
		      $id = $_GET["id"];
          $titolo = $_GET["libro"];
          $utente = $_GET["utente"];
          $datainizio = $_GET["datap"];
          $datafine = $_GET["datar"];
          $motivo = $_POST["var"];
		      $sql="delete from prestiti where idprestito='$id'";
          $sql2="INSERT INTO prestiti_rifiutati(utente, libro, dataPrestito, dataRestituzione, motivo) VALUES ('$utente','$titolo','$datainizio','$datafine','$motivo')";
          runSql($sql,$conn);
          runSql($sql2,$conn);
          echo $sql;
          echo $sql2;
          header("location:gestioneprestiti.php");
        break;

        case "ELIMINA_PRESTITO2":
		      $id = $_GET["id"];
		      $sql="delete from prestiti_in_attesa where idprestito='$id'";
          $titolo = $_GET["libro"];
          $utente = $_GET["utente"];
          $datainizio = $_GET["datap"];
          $datafine = $_GET["datar"];
          $motivo = $_POST["var"];
          $sql2="INSERT INTO prestiti_rifiutati(utente, libro, dataPrestito, dataRestituzione, motivo) VALUES ('$utente','$titolo','$datainizio','$datafine','$motivo')";
          runSql($sql,$conn);
          runSql($sql2,$conn);
         header("location:gestioneprestiti.php");
        break;




       //QUERY RELATIVE AL LIBRO
      case "ELIMINA_LIBRO":
        $codice=$_GET["codice"];
        $sql="delete from libri where codice = '$codice'";
        runSql($sql,$conn);
        header("location: elencolibri.php");
      break;




      case "AGGIUNGI_LIBRI":
        $codice=$_POST["isbn"];
        $Titolo = $_POST["Titolo"];
        $idEditore = $_POST["idEditore"];
        $AnnoPubblic = $_POST["anno"];
        $autore = $_POST["aut"];
        $sql="INSERT INTO libri (codice, Titolo, Editore, AnnoPubblic) VALUES ('$codice','$Titolo'," . $idEditore . ",'$AnnoPubblic')";
        runSql($sql,$conn);
		    echo $sql;
        echo $codice . $Titolo . $idEditore . $AnnoPubblic . $autore[0];
        //AGGIUNTA AUTORI
        $sql2 = "INSERT INTO scrittura (Libro, Autore) VALUES ";
        $idAutore = $autore[0];
        $sql2 .= "('$codice' , '$idAutore')";
        for($i=1; $i<count($autore); $i++){
          $idAutore = $autore[$i];
          $sql2 .= ", ('$codice', '$idAutore')";
        }

      runSql($sql2,$conn);
	    echo $sql2;
      $istituto = $_SESSION['istituto'];
      $sql3 = "INSERT INTO immagazzinare (istituto, libro) VALUES ('$istituto','$codice')";
      runSql($sql3,$conn);
      header("location: elencolibri.php");
      break;



      case "MODIFICA_LIBRI":
        $codice = $_GET["cod"];
        $isbn = $_POST["isbn"];
        $Titolo = $_POST["titolo"];
        $idEditore = $_POST["editore"];
        $AnnoPubblic = $_POST["anno"];
		    $autore = $_POST["aut"];

        //aggiorna i dati tranne l'autore
  		  $sql ="UPDATE libri SET codice='$isbn',Titolo='$Titolo',Editore='$idEditore',AnnoPubblic='$AnnoPubblic' WHERE codice = '$codice'";
        runSql($sql,$conn);
        //aggiorna autori
        $sql2 = "DELETE From scrittura where libro = '$codice'";
        runSql($sql2, $conn);
        for($i=0; $i < count($autore); $i++){
            $sql2 = "INSERT INTO scrittura (autore, libro) values ($autore[$i],'$codice')";
            runSql($sql2, $conn);
        }
        header("location: elencolibri.php");
        break;
}
?>
