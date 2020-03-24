<?php
    session_start();
    include("nagl.php");
    
    
    if(isset($_SESSION)){
       //session_destroy();
     }
    echo "Udało się dodać nową wizytę! "."<br>"."Wróć do strony głównej:"; 
    
        
        echo"<form action=\"dalej.php\" method=\"POST\">";
        echo"<input type=\"submit\" value =\"Wróć\">";
        echo"</form>";

    include("stopka.php");
?>