<?
include("zmienne.php");
/*
$conn = new mysqli($host, $user, $passwd, $baza);
if ($mysqli -> connect_errno)
{
    printf("Błąd połączenia: %s\n", $mysqli->connect_error);
    exit();
}
$conn -> close();*/

@mysql_connect($host, $user, $passwd)
	or die('Brak polaczenia z serwerem MySQL.');

@mysql_select_db($baza)
	or die('Blad wyboru bazy danych.');
?>