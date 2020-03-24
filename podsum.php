<?php
    session_start();
    include("nagl.php");
    include("polacz.php");
    include("zmienne.php");
    
  
    if(isset($_POST['time']))
    {
        $m_time = $_POST['time'];
        $m_date = $_POST['date'];
    }
        //$meeting_time = $_POST['date'].' '.$_POST['time'];
        //$meeting_time = date("Y-m-d H:i:s",strtotime($meeting_time));
        
        echo $m_time;
        echo gettype($m_time);
        echo $m_date;
        echo gettype($m_date);
        
    $_SESSION['m_time'] = $_POST['time'];
    $_SESSION['m_date'] = $_POST['date'];
    $idUser = $_SESSION['idUser'];
    $idLek = $_SESSION['idLek'];
    $idBad = $_SESSION['idBad'];
        
    echo "<h3>"."Podsumowanie: "."</h3>"."<br>";
    $conn = new mysqli($host,$user,$passwd,$baza);
    $qwer = "SELECT doctors.imie, doctors.nazwisko, specs.specjalizacja, exam.badanie, exam.koszt, exam.czas FROM doctors, specs, exam WHERE exam.idBL=$idBad AND doctors.idSL=$idLek AND doctors.idSS=specs.idSS";
   
    if($capt= @$conn->query($qwer))
        {
        $wiersz = $capt->fetch_assoc();
              
echo<<<END
        <table width="40%"  border="1" bordercolor="#d5d5d5" cellpadding="5" cellspacing="5">
        <tr>
        <td width="20"  bgcolor="e5e5e5">Lekarz</td>
        <td width="20"  bgcolor="e5e5e5">Specjalizacja</td>
        <td width="20"  bgcolor="e5e5e5">Badanie</td>
        <td width="20"  bgcolor="e5e5e5">Koszt</td>
        <td width="20"  bgcolor="e5e5e5">Czas</td>
        <td width="30"  bgcolor="e5e5e5">Termin</td>
</tr>
END;
       echo "<tr>";
       echo "<td width=20  bgcolor=e5e5e5>". $wiersz['imie'].' '. $wiersz['nazwisko']."</td>";
       echo "<td width=20  bgcolor=e5e5e5>". $wiersz['specjalizacja']."</td>";
       echo "<td width=20  bgcolor=e5e5e5>". $wiersz['badanie'] ."</td>";
       echo "<td width=20  bgcolor=e5e5e5>". $wiersz['koszt'] ."</td>";
       echo "<td width=20  bgcolor=e5e5e5>". $wiersz['czas'] ."</td>";
       echo "<td width=20  bgcolor=e5e5e5>". $m_date. ' ' . $m_time."</td>";
       echo "</tr>";
 echo "</table>";
        }else{
            echo "Cos poszło nie tak :(";
        }
 //$zapytanie = "INSERT INTO fvisit VALUES (NULL, $idUser, $idLek, $idBad, '$m_date', '$m_time')";
echo $zapytanie = "INSERT INTO fvisit VALUES (NULL, $idUser, $idLek, $idBad, '2019-06-01', '$m_time')";
 
 if(isset($_POST['dodaj']))
    {
     if(mysql_query($zapytanie))
     {
         header('Location: dodvis5.php');
         $_SESSION['vis5']=true;
     }else{
         echo "Nieudana rejestracja";
         exit();
     }
    }
 
 ?>
 <br> Potwierdź dodanie wizyty:  
 <form method="POST">
 <input type="submit" name="dodaj" value = "Dodaj"/>
 </form>
 
 <?php 
        echo "<br>"."<br>";
        echo"<form action=\"kiedy.php\" method=\"POST\">";
        echo"<input type=\"submit\" value =\"Wróć\">";
        echo"</form>";

    include("stopka.php");
?>