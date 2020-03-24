<?
	session_start();
	include("nagl.php");
	
	if(!isset($_SESSION['flg_login'])){
	    header('Location: index.php');
	    exit();
	}

	if(isset($_SESSION['login'])){
	    $_SESSION['podalej'] = true;
		echo  "<br /> <br />";
		echo "<p>Witaj administratorze, ".$_SESSION['nazwisko']."!</p>"."<br />";
	}else{ 
	    echo "Nie masz prawa wstępu!";
	}
?>
        
        <br>
        Umów wizytę u specjalisty:
   		<form action="poka.php" method="POST">
        <input type="submit" value = "Umów"/>
        </form>
        <br>
        Przejrzyj umówione wizyty:
   		<form action="fvis.php" method="POST">
        <input type="submit" value = "Pokaż"/>
        </form>
        <br>
        Przejrzyj odbyte wizyty:
   		<form action="pvis.php" method="POST">
        <input type="submit" value = "Pokaż"/>
        </form>
        <br>
		Przejrzyj wszystkie wizyty:
   		<form action="allvis.php" method="POST">
        <input type="submit" value = "Pokaż"/>
        </form>
        <br>
        <form action="wyloguj.php" method="POST">
        <input type="submit" value = "Wyloguj się"/>
        </form>
        
        
<?php
    include("stopka.php");
?>