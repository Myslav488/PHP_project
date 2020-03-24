<?php
    session_start();
    include("nagl.php");
    include("zmienne.php");
    
    if(isset($_SESSION)){
        
    }
        
    $idUser = $_SESSION['idUser'];
    if(isset($_GET['varvar']))
        $ktory=$_GET['varvar'];
    
    $conn = new mysqli($host,$user,$passwd,$baza);
    
    echo "<h3>"."Czy na pewno chcesz usunąć wizytę: "."</h3>"."<br>"."<br>";

    $qwer = "SELECT doctors.imie, doctors.nazwisko, specs.specjalizacja, exam.badanie, exam.koszt, exam.czas, fvisit.kiedy FROM doctors, specs, exam, fvisit WHERE fvisit.idW = $ktory AND fvisit.idUS = $idUser AND doctors.idSS=specs.idSS AND exam.idBL=fvisit.idBL AND doctors.idSL=fvisit.idSL";
    if($capt= $conn->query($qwer))
    {
        $wiersz = $capt->fetch_assoc();
        $ile_usu = $capt->num_rows;
            
        if($ile_usu>0){
            
            echo "<table width='40%'  border='1' bordercolor=BLACK cellpadding='5' cellspacing='5'>";
            echo "<tr>";
            echo "<td>".$wiersz['imie']. ' ' . $wiersz['nazwisko'] . "</td><td>" . $wiersz['specjalizacja'] . "</td><td>"  . $wiersz['badanie']. "</td><td>"  . $wiersz['koszt']. "</td><td>"  . $wiersz['czas']. "</td><td>"  . $wiersz['kiedy']."</td>";
            echo "</tr>";
            echo "</table>";
        }
    }else{
        echo "Błąd";
    }
   
   $del = "DELETE FROM fvisit WHERE idW = $ktory";
   if(isset($_POST['usun']))
   {
       if($conn->query($del))
       {
           
           echo "Pomyslnie usunieto wizytę,";
           header('Location: fvis.php');
            //$_SESSION['vis5']=true;
       }else{
           echo "Cos poszlo nie tak.";
           exit();
       }
   }
    
    echo "<br>";
    
    echo"<form method=\"POST\">";
    echo"<input type=\"submit\" name=\"usun\" value =\"Tak, potwierdzam swój wybór.\">";
    echo"</form>";
    
    echo "<br>";
    
    echo"<form action=\"fvis.php\" method=\"POST\">";
    echo"<input type=\"submit\" value =\"Nie, wróć do poprzedniej strony.\">";
    echo"</form>";

    $conn->close();
    include("stopka.php");
?>