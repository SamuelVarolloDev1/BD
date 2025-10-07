<?php
session_start();

if (!isset($_SESSION['ACESSO']))
   header('location: login.htm');
?>
<html>
    <body>
        <img src="https://picsum.photos/800/600"/>
    </body>
</html>