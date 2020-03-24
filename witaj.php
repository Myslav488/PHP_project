<?php
        session_start();
        include("nagl.php");

    if(!isset($_SESSION['reg_compl']))
    {
         header('Location: index.php');
         exit();
    }else{
        session_destroy();
         //unset($_SESSION['reg_compl']);
    }
    
echo "<br/> Gratulacje! Udało Ci się założyć konto! <br/><br/>";
        echo "<br/> Możesz wrócić teraz do ekranu logowania: <br/><br/>";
        echo"<form action=\"index.php\" method=\"POST\">";
        echo"<input type=\"submit\" value =\"Logowanie\">";
        echo"</form>";

    include("stopka.php");
?>