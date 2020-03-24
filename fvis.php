<?php
    session_start();
    include("nagl.php");
    echo "<br><h3>"."Przyszłe badania: "."</h3><br>";// "Przegląd przyszłych wizyt: "."<br><br>";
    include("zmienne.php");
    if(!isset($_SESSION['podalej'])){
        header('Location: index.php');
        exit();
    }
    
    $conn = new mysqli($host,$user,$passwd,$baza);
    $dzen = date('Y-m-d');
    
    echo "Dzis jest: " . $dzen . "<br>";
    
    echo<<<END
        <table width="40%"  border="1" bordercolor="#d5d5d5" cellpadding="5" cellspacing="5">
        <tr>
        <td width="20"  bgcolor="e5e5e5">Imię i Nazwisko</td>
        <td width="20"  bgcolor="e5e5e5">Specjalizacja</td>
        <td width="20"  bgcolor="e5e5e5">Badanie</td>
        <td width="20"  bgcolor="e5e5e5">Koszt</td>
        <td width="20"  bgcolor="e5e5e5">Czas</td>
        <td width="30"  bgcolor="e5e5e5">Termin</td>
        <td width="30"  bgcolor="e5e5e5">Godzina</td>
        <td width="20"  bgcolor="e5e5e5">Usuń wizytę: </td>


</tr><tr>
END;
    
    $idUser = $_SESSION['idUser']; 
    //wyciagniecie ilosci wierszy w tabeli
    $qouz = "SELECT * FROM fvisit ORDER BY idW DESC LIMIT 1";
    if($cape= $conn->query($qouz))
    {
        $licz = $cape->fetch_assoc();
        $leng = $licz['idW'];
    }else {
        echo "klops";
        $leng = 10;
     }
     //sprawdzenie czy uzytkownik posiada umowione wizyty 
     $ilewizyt = "SELECT * FROM fvisit WHERE idUS = $idUser";
     if($capn= $conn->query($ilewizyt))
     {
        $ile_wiz = $capn->num_rows;
        //$wers = $capn->fetch_assoc();
     }
     
if($ile_wiz>0)    
     {
    for($cnt=1;$cnt<=$leng;$cnt++)
        {
        $qwer = "SELECT doctors.imie, doctors.nazwisko, specs.specjalizacja, exam.badanie, exam.koszt, exam.czas, fvisit.kiedy, fvisit.godzina FROM doctors, specs, exam, fvisit WHERE fvisit.idW = $cnt AND fvisit.idUS = $idUser AND doctors.idSS=specs.idSS AND exam.idBL=fvisit.idBL AND doctors.idSL=fvisit.idSL";
        if($capt= $conn->query($qwer))
        {
            $wiersz = $capt->fetch_assoc();
            $ile_usu = $capt->num_rows;
                        
            if($ile_usu>0 &&  $wiersz['kiedy'] > $dzen){
                echo "<td>".$wiersz['imie']. ' ' . $wiersz['nazwisko'] . "</td><td>" . $wiersz['specjalizacja'] . "</td><td>"  . $wiersz['badanie']. "</td><td>"  . $wiersz['koszt']."</td><td>".$wiersz['czas']."</td><td>".$wiersz['kiedy']."</td><td>".$wiersz['godzina']."</td>";
                echo "<td>"."<form action=\"usunw.php?varvar=$cnt\" method=\"POST\">";
                echo"<input type=\"submit\" value =\"Usuń\">";
                echo"</form>"."</td>";
                echo "</tr>";
                
            }else{
                continue;
            }
        }else{
            echo "Błąd";
            }
        }
     }else{
         echo "<td colspan='8'>"."Brak umówionych wizyt"."</td>"."<br>";
    }
    echo "</table>";
        $conn->close();
        echo"<form action=\"dalej.php\" method=\"POST\">";
        echo"<input type=\"submit\" value =\"Wróć\">";
        echo"</form>";

    include("stopka.php");
?>