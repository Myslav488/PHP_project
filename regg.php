<?
	session_start();
	include("nagl.php");
	include("polacz.php");
	
	if(isset($_POST['email']))
	{
	    //walidacja danych
	    $dobre_dane = true;
	    
	    
	    //poprawnosć imienia
	    $imie = $_POST['imie'];
	    if((strlen($imie)<2)||(strlen($imie)>24))
	    {
	        $dobre_dane = false;
	        $_SESSION['e_imie']="Imię musi być dłuższe niż 2 znaki, ale krótsze niż 24, sorry!";
	    }
	    
	    //poprawnosć nazwiska
	    $nazwisko = $_POST['nazwisko'];
	    if((strlen($nazwisko)<2)||(strlen($nazwisko)>24))
	    {
	        $dobre_dane = false;
	        $_SESSION['e_nazwisko']="Nazwisko musi być dłuższe niż 2 znaki, ale krótsze niż 24, sorry!";
	    }
	    
	    //poprawnosć e-maila
	    $email = $_POST['email'];
	    $email1 = filter_var($email, FILTER_SANITIZE_EMAIL);
	    	 
	    if((filter_var($email1, FILTER_VALIDATE_EMAIL)==false)||($email!=$email1))
	    {
	        $dobre_dane = false;
	        $_SESSION['e_email']="Podaj własciwy adres E-mail!";
	    }

	    $kwerenda = "SELECT email FROM users WHERE email = '$email'"; 
	    $wynik = mysql_query($kwerenda)
	    or die("Błąd zapytania");
	    $wiersz = mysql_fetch_assoc($wynik);
	    	    
	    if(isset($email)&&($wiersz['email']==$email)) {
	        $dobre_dane = false;
	        $_SESSION['e_email']="Podany adres E-mail jest już przypisany do konta w bazie!";
	    }
	    
	    
	    
	    //poprawnosć hasla	    
	    $haslo1 = $_POST['haslo1'];
	    $haslo2 = $_POST['haslo2'];
	    if((strlen($haslo1)<8)||(strlen($haslo1)>20))
	    {
	        $dobre_dane = false;
	        $_SESSION['e_haslo']="Hasło musi być dłuższe niż 8 znaków, ale krótsze niż 20, sorry!";
	    }
	    if($haslo1!=$haslo2)
	    {
	        $dobre_dane = false;
	        $_SESSION['e_haslo']="Podane hasła są różne, spróbuj jeszcze raz.";
	    }
	    $hashed_hash = password_hash($haslo1, PASSWORD_DEFAULT);
	    
	    if(!isset($_POST['regulamin']))
	    {
	        $dobre_dane = false;
	        $_SESSION['e_regulamin']="Regulamin musi być zaakceptowany!";
	    }
	    
	    
	    if($dobre_dane==true)
	    {
	        //wszystko dziala
	        echo "Udana walidacja";
	        
	        $zapytanie = "INSERT INTO users VALUES (NULL, '$imie','$nazwisko','$email','$hashed_hash',1)";
	        //$wynik = mysql_query($zapytanie)
	         //  or die("Błąd zapytania");
	        
	        if(mysql_query($zapytanie))
	        { 
	            header('Location: witaj.php');
	            $_SESSION['reg_compl']=true;
	        }else{
	            echo "Nieudana rejestracja";
	            exit();
	        }
	    }
	}
		
	echo "<h3>Rejestracja<h3/>"."<br/>";
	
?>
	<body>
		<h5>
		<form method="POST">
		Imię: <br /> <input type="text" name='imie'/> <br />
		<font color="red">
		<?php 
		if(isset($_SESSION['e_imie']))
		{
		     echo '<div class="error">'.$_SESSION['e_imie'].'<div/>' ;
		    unset($_SESSION['e_imie']);
		}
?>
		</font>
		
		Nazwisko: <br /> <input type="text" name='nazwisko'/> <br />
		<font color="red">
<?php 
		if(isset($_SESSION['e_nazwisko']))
		{
		     echo '<div class="error">'.$_SESSION['e_nazwisko'].'<div/>' ;
		    unset($_SESSION['e_nazwisko']);
		}
?>
		</font>
		
		E-mail: <br /> <input type="text" name='email'/> <br />
		<font color="red">
<?php 
		if(isset($_SESSION['e_email']))
		{
		     echo '<div class="error">'.$_SESSION['e_email'].'<div/>' ;
		    unset($_SESSION['e_email']);
		}
?>
		</font>
		
		Hasło: <br /> <input type="password" name='haslo1'/> <br />
		<font color="red">
<?php 
		if(isset($_SESSION['e_haslo']))
		{
		     echo '<div class="error">'.$_SESSION['e_haslo'].'<div/>' ;
		    unset($_SESSION['e_haslo']);
		}
?>
		</font>
		
		Powtórz hasło: <br /> <input type="password" name='haslo2'/> <br />
		
		<label>
		<input type="checkbox" name="regulamin"> Akceptuję 
		</label><a href = "reguj.php">regulamin</a>
		<font color="red">
<?php 
		if(isset($_SESSION['e_regulamin']))
		{
		     echo '<div class="error">'.$_SESSION['e_regulamin'].'<div/>' ;
		    unset($_SESSION['e_regulamin']);
		}
?>
		</font>
		
		<br/><br>
		<input type="submit" value = "Zarejestruj"/>
		</form>
		</h5>
		
				
		<br/><br/>
        <form action="index.php" method="POST">
        <input type="submit" value = "Wróć"/>
        </form>
        
	</body>           
<?php
    include("stopka.php");
?>