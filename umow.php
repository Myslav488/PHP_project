<br><h3>Wybierz badanie: <h3/><br>
<?php
    session_start();
    include("nagl.php");
    include("zmienne.php");
    
    if(!isset($_SESSION['popoka'])){
        header('Location: index.php');
        exit();
    }
       
    //pozyskanie id specjalisty
       if(isset($_GET['varvar']))
    $_SESSION['idLek']=$_GET['varvar'];
    //otwarcie kanału
    $conn = new mysqli($host,$user,$passwd,$baza);
          
    
echo<<<END
        <table width="25%"  border="1" bordercolor="#d5d5d5" cellpadding="5" cellspacing="5">
        <tr>
        <td width="40"  bgcolor="e5e5e5">Badanie</td>
        <td width="20"  bgcolor="e5e5e5">Czas trwania</td>
        <td width="20"  bgcolor="e5e5e5">Koszt</td>
        <td width="20"  bgcolor="e5e5e5">Wybierz: </td>

</tr><tr>
END;
    
        $qouz = "SELECT * FROM exam";
            if($cape= $conn->query($qouz))
            {
              $leng = $cape->num_rows;
            }else {
                echo "Cos poszlo nie tak";
                  $leng = 10;
            }
    
    for($cnt=1;$cnt<=$leng;$cnt++)
    {
        $qwer = "SELECT badanie, czas, koszt FROM exam WHERE idBL='$cnt'";
        if($capt= @$conn->query($qwer))
        {
            $wiersz = $capt->fetch_assoc();
            $ile_usu = $capt->num_rows;
            //if($leng!=$ile_usu) $leng=$ile_usu;
            
            if($ile_usu>0){
                
                echo "<td>".$wiersz['badanie']. "</td><td>" . $wiersz['czas'] . "</td><td>" . $wiersz['koszt'] . "</td>";
                
                echo "<td>"."<form action=\"kiedy.php?varvar=$cnt\" method=\"POST\">";
                echo"<input type=\"submit\" value =\">\">";
                echo"</form>"."</td>";
                
                echo "</tr>";
            }
        }
    }
    
    echo "</table>";
    echo "<br/> <br/>";

        echo"<form action=\"poka.php\" method=\"POST\">";
        echo"<input type=\"submit\" value =\"Wróć\">";
        echo"</form>";

    include("stopka.php");
?>