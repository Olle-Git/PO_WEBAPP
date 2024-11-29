<?php
session_start();
include_once "includes/functions.php";
if (!isset($_SESSION["UserID"]) || $_SESSION["UserID"] != true) {
    header("location: index.php");
    exit();
}
$userID = $_SESSION["UserID"];
$result = tableData($userID);
?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <!--Standaard informatie over de webpagina in de head-->
    <meta name="author" content="Adrian Bleeker, Olle van Damme">
    <link rel="stylesheet" href="style_paginas.css">
    <link rel="stylesheet" href="style.css">
    <title>Uw bestellingen</title>    
    <style>
        tr:hover {
            background-color:#7dd48c; /* Hover effect*/
        }
    </style>

    </head>

<body>

    <nav>   
        <ul class="nav-list">
            <li class="navlogo"><img src="img/NYP.png" height="71px" alt="logo"></li> <!-- Dit is voor de navigatiebar boven in de pagina-->
            <li class="navitems"><a href="index.php">Home</a></li>
            <li class="navitems"><a href="Menu.php">Menu</a></li>
            <li class="navitem"><a href="#">Mijn bestellingen</a></li>
            <?php if (isset($_SESSION["bezorger"])) if ($_SESSION["bezorger"] == true) { {echo "<li class='navitem'><a href='bezorger.php'>bezorgers</a></li>";}}?>
            <li class="navitems"><a href="includes/logout.php">Log uit</a></li>
        </ul>
    </nav>
    <table>
    <thead>
        <tr>
            <?php
            if ($result == false) {
                echo "bestelregels niet gevonden<br>";
            } 
            else {
                TableHead();
            }
            ?>
        </tr>
    </thead>
    <tbody>
        <tr>
            <?php 
                while($row = mysqli_fetch_assoc($result))
                {
                    echo "<td>" . $row["id"] . "</td>";
                    echo "<td>". $row["besteldatum"] ."</td>";
                    echo "<td>". $row["aantal"] . "x " . $row['naam'] . "</td>";
                    echo "</tr>";
                }
            ?>

    </tbody>
    </table>
</body>
</html>