<?php
    session_start();
    include("nagl.php");
    
    if(!isset($_SESSION['podalej'])){
        header('Location: index.php');
        exit();
    }
        
    echo "<h3>"."Przegląd przeszłych wizyt: "."</h3>"."<br>"."<br>";
    
    include("zmienne.php");
    
    $conn = new mysqli($host,$user,$passwd,$baza);
    
echo<<<END
        <table width="40%"  border="1" bordercolor="#d5d5d5" cellpadding="5" cellspacing="5">
        <tr>
        <td width="20"  bgcolor="e5e5e5">Imię i Nazwisko</td>
        <td width="20"  bgcolor="e5e5e5">Specjalizacja</td>
        <td width="20"  bgcolor="e5e5e5">Dzień wizyty</td>
        <td width="20"  bgcolor="e5e5e5">Przepisane lekarstwo</td>
        <td width="20"  bgcolor="e5e5e5">Producent</td>
        <td width="20"  bgcolor="e5e5e5">Iloć tabletek</td>
        </tr><tr>

END;
    
    $idUser = $_SESSION['idUser'];
    
    $qouz = "SELECT * FROM pvisit";
    if($cape= $conn->query($qouz))
    {
        $ile_usd = $cape->num_rows;
        $leng = $ile_usd;
    }else {
        echo "klops";
        $leng = 10;
    }
    
    //sprawdzenie czy uzytkownik posiada odbyte wizyty
    $ilewizyt = "SELECT * FROM pvisit, fvisit WHERE fvisit.idUS = $idUser AND fvisit.idW = pvisit.idW";
    if($capn= $conn->query($ilewizyt))
        $ile_wiz = $capn->num_rows;
        
        if($ile_wiz>0)
        {
    
    for($cnt=1;$cnt<=$leng;$cnt++)
    {
        $qwer = "SELECT doctors.imie, doctors.nazwisko, specs.specjalizacja, fvisit.kiedy, medicines.nazwa, medicines.producent, medicines.ilosc FROM doctors, specs, fvisit, pvisit, medicines WHERE pvisit.idZL = $cnt AND fvisit.idUS = $idUser AND doctors.idSS=specs.idSS AND doctors.idSL=fvisit.idSL AND fvisit.idW = pvisit.idW AND pvisit.idSLek = medicines.idSLek";
        if($capt= $conn->query($qwer))
        {
            $wiersz = $capt->fetch_assoc();
            $ile_usu = $capt->num_rows;
            
            if($ile_usu>0){
                echo "<td>".$wiersz['imie']. ' ' . $wiersz['nazwisko'] . "</td><td>" . $wiersz['specjalizacja'] . "</td><td>"  . $wiersz['kiedy']. "</td><td>"  . $wiersz['nazwa']. "</td><td>"  . $wiersz['producent']. "</td><td>"  . $wiersz['ilosc']."</td>";
                echo "</tr>";
                
                }
             }else{
              echo "Błąd";
              }
           }
        }else{
            echo "<td colspan='6'>"."Brak odbytych wizyt"."</td>"."<br>";
    }
    echo "</table>";
    $conn->close();
    
    echo "<br>";
    
    echo"<form action=\"dalej.php\" method=\"POST\">";
    echo"<input type=\"submit\" value =\"Wróć\">";
    echo"</form>";

    include("stopka.php");
?>