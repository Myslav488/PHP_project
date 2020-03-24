<?
	session_start();
	include("nagl.php");
	include("polacz.php");
	
	if((!isset($_POST['email'])) || (!isset($_POST['haslo']))){
	    header('Location: index.php');
	    exit();
	}	
	
	$login =  $_POST['email'];
	$pass =  $_POST['haslo'];
	
	if((isset($_SESSION['flg_login']))&&(($_SESSION['flg_login'])==true)&&($_SESSION['status']==1)){
	    header('Location: dalej.php');
	    exit();
	}else if((isset($_SESSION['flg_login']))&&(($_SESSION['flg_login'])==true)&&($_SESSION['status']==2)){
		header('Location: adalej.php');
	    exit();
	}
	
	if(isset($_SESSION)) {
	   // echo "zmienne sesji: <br />";
	   // print_r($_SESSION);
	    echo "<br/ > <br/>";
	} else
	    echo "Sesja nie została jeszcze zainicjowana <br> <br>";
	
	    //echo "$login"."<br><br>";
	    
	    $kwerenda = "SELECT * FROM users WHERE email = '$login'";
	    //echo $kwerenda . "<br> <br >";
	    
	    $wynik = mysql_query($kwerenda)
	    or die("Błąd zapytania");
	    
	    if($wynik) {
	        $wiersz = mysql_fetch_assoc($wynik);
	        $has = $wiersz['haslo'];
	       }
	    $_SESSION['idUser'] = $wiersz['idUS'];
	    echo "==============================================<br>";
	
	    if(password_verify($pass, $has)){
		echo "<br />Podano poprawne dane logowania <br />";
		echo "Rozpoczynam sesje logowania <br /> <br />";
		$_SESSION['login'] = $_POST['email'];
		$_SESSION['nazwisko'] = $wiersz['imie'];
		$_SESSION['status'] = $wiersz['status'];
		//print_r ($_SESSION['status']);
		$_SESSION['flg_login'] = true;
		
		$forma = "<form action = \"dalej.php\" method=\"POST\"> ";
		$forma.= "<input type=\"submit\" value=\"Kontynuacja sesji\" />";
		$forma.= "</form >";

	    }else{
		echo "Podaleś zle dane - nie masz uprawnień"."<br/>";
		$forma = "<form action = \"index.php\" method=\"POST\"> ";
		$forma.= "<input type=\"submit\" value=\"Wróć\" />";
		$forma.= "</form >";
	    }
	    echo  $forma;
	    

	include("stopka.php");
?>