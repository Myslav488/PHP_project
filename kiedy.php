<br><h3>Sprecyzuj czas badania: <h3/><br>

<?php
    session_start();
    include("nagl.php");
    
    if(isset($_SESSION)){
        // $_SESSION['flg'] = false;
        
    }
    //$dzis = date('Y-m-d');
        
    //pozyskanie id specjalisty
    if(isset($_GET['varvar']))
    $_SESSION['idBad']=$_GET['varvar'];
?>

   <div>
        <form action="podsum.php" method="POST">
        <input type="date" name="date" value="2019-06-01" min="2019-05-25" max="2019-08-31" placeholder="The date">
 		<input type="time" name="time" value="09:00" min="08:00" max="18:45" placeholder="The time">
 		<br>
        <input type="submit" value = "Przejdź do podsumowania"/>
        </form>
     </div>
 
   <br><br>
<?php         

        echo"<form action=\"umow.php\" method=\"POST\">";
        echo"<input type=\"submit\" value =\"Wróć\">";
        echo"</form>";

    include("stopka.php");
?>