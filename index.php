 
 <?
	session_start();
		include("nagl.php");
		
	if((isset($_SESSION['flg_login']))&&($_SESSION['flg_login'])==true){
	    header('Location: dalej.php');
	    exit();
	 }
	 
	if(isset($_SESSION['POST'])){
		session_destroy();
		$_SESSION = array();
		echo "Usuniecie pozostałości po poprzednim logowaniu <br /><br />";
	   }
?>

<body>
	Witaj!<br /><br />
	Logowanie: <br />
	<form action="log2.php" method="POST">
		E-mail: <input type="text" name="email" /><br />
		Hasło: <input type="password" name="haslo" /><br /><br />
		<input type = "submit" value="Zaloguj" /><br />
		</form>

  <br/><br/>    
  <br/><br/>
    
    Nie masz jeszcze konta?
    <a href = "regg.php">Zarejestruj się!</a>

</body>

		
<?
	include("stopka.php");
?>
		