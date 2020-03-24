<?php
    session_start();
    include("nagl.php");
    
    if(isset($_SESSION)){
        // $_SESSION['flg_login'] = false;
        
        session_destroy();
        //   $_SESSION=array();
    }
    
        echo "<br/> Poprawne wylogowanie! <br/><br/>";
        echo"<form action=\"index.php\" method=\"POST\">";
        echo"<input type=\"submit\" value =\"Wyjdź\">";
        echo"</form>";

    include("stopka.php");
?>