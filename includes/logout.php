<?php
// reset de sessies als er in het menu op logout geklikt wordt en gaat terug naar de home pagina
session_start();
session_unset();
session_destroy();
header("location: ../index.php");
exit();