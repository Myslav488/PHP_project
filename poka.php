Cixo3kigu!<br/><h3> Wybierz specjalistę: <h3/><br>
 
<?php
    session_start();
    include("nagl.php");
    include("zmienne.php");
    if(!isset($_SESSION['podalej'])){
        header('Location: index.php');
        exit();
    }
    unset($_SESSION['podalej']);
    $_SESSION['popoka'] = true;
    $conn = new mysqli($host,$user,$passwd,$baza);
    
echo<<<END
        <table width="40%"  border="1" bordercolor="#d5d5d5" cellpadding="5" cellspacing="5">
        <tr>
        <td width="20"  bgcolor="e5e5e5">Imię</td>
        <td width="20"  bgcolor="e5e5e5">Nazwisko</td>
        <td width="20"  bgcolor="e5e5e5">Miasto</td>
        <td width="20"  bgcolor="e5e5e5">Specjalizacja</td>
        <td width="20"  bgcolor="e5e5e5">Wybierz: </td>

</tr><tr>
END;

        $qouz = "SELECT * FROM doctors";
        if($cape= $conn->query($qouz))
            {
              $leng = $cape->num_rows;
            }else {
                 echo "Cos poszlo nie tak";
                 $leng = 10;
             }
   
    for($cnt=1;$cnt<=$leng;$cnt++)
    {
        $qwer = "SELECT doctors.imie, doctors.nazwisko, doctors.miasto, specs.specjalizacja FROM doctors, specs WHERE doctors.idSL='$cnt' AND doctors.idSS=specs.idSS";
        if($capt= @$conn->query($qwer))
        {
             $wiersz = $capt->fetch_assoc();
             $ile_usu = $capt->num_rows;
             
            if($ile_usu>0){
               
                echo "<td>".$wiersz['imie']. "</td><td>" . $wiersz['nazwisko'] . "</td><td>" . $wiersz['miasto'] . "</td><td>"  . $wiersz['specjalizacja']."</td>";
                echo "<td>"."<form action=\"umow.php?varvar=$cnt\" method=\"POST\">";
                echo"<input type=\"submit\" value =\">\">";
                echo"</form>"."</td>";
                echo "</tr>";
            }
        }
    }
        
        echo "</table>";
        echo "<br/> <br/>";
        echo"<form action=\"dalej.php\" method=\"POST\">";
        echo"<input type=\"submit\" value =\"Wróć\">";
        echo"</form>";
       
    include("stopka.php");
?>