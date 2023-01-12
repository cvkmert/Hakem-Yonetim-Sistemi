<?php 
    $user = "u0646652_hys_user";
    $pass = "jW]PUHOKj;KE";
    $server = "94.73.151.111";
    $database = "u0646652_hys";
    $conn = mysqli_connect($server, $user, $pass, $database);
    if ($conn) {}
    else {
        echo "<div style='background-color:red; color:white; text-align:center; width:100%; padding:20px 0;'>Veri tabanı ile bağlantı kurulamadı!!!</div>";
    }
    $conn -> set_charset("utf8");
?>