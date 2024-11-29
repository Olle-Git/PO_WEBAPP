<?php
session_start();
if (!isset($_SESSION["UserID"])) {
    header("location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Adrian Bleeker, Olle van Damme">
    <link rel="stylesheet" href="style_paginas.css">
    <link rel="stylesheet" href="style.css">
    <title>Uw bestellingen</title>
    
    <style>
    table {
        width: 80%;
        border-collapse: collapse; 
        text-align: center; 
    }
    th, td {
        text-align: center;
        padding: 5px; 
    }

    img {
        display: block;
        margin: 0 auto;
        width: 50%;
    }

    td {
        border: 1px solid #ccc; 
    }

    td:hover {
    background-color:#7dd48c; /* Hover effect*/
    }
    .empty {
        background-color: gray;
    }
    .empty input[type="number"], label {
        display: none;
    }
</style>

    </head>

    

<body>

    <nav>   
        <ul class="nav-list">
            <li class="navlogo"><img src="img/NYP.png" height="71px" alt="logo"></li>
            <li class="navitems"><a href="index.php">Home</a></li>
            <li class="navitems"><a href="#">Menu</a></li>
            <li class="navitem"><a href="klant.php">Mijn bestellingen</a></li>
            <li class="navitems"><a href="includes/logout.php">Log uit</a></li>
        </ul>
    </nav>
    <br><br>
    <table>
        <form action="includes/bestellingenhandler.php" method="post">
        <th colspan="3">MENU</th>
        <?php 
            require_once "includes/functions.php";
            $result = menuTable();
            drawMenu($result);
        ?>
      </table>
            <br><br><br><br><br>
      <center>
            <input type="submit" name="submit" value="Bestelling plaatsen" style="width: auto; background-color:white; color:black;">
        </form></center>


        <!-- <script>
            let productCounter = {};

            function clickMenu(id) {
                alert("U hebt een artikel toegevoegd aan uw bestelling.");
                if (!productCounter[id]) {
                    productCounter[id] = 1;
                }
                productCounter[id]++;
            }
            function toPHP() {
                
            }


        </script> -->
</body>
</html>