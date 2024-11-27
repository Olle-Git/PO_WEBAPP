<?php
session_start();
include_once "includes/functions.php";
if (!isset($_SESSION["UserID"])) {
    header("location: login.php");
    exit();
}
$userID = $_SESSION["UserID"];
echo $userID . "<br>";
// $klantenTable = getTable("klanten", "usr_id", $userID);
// if ($klantenTable == false) {
//     echo "Geen klant gevonden<br>";
//     exit();
// } else {
//     echo "klant gevonden<br>";
//     $klanten_id = $klantenTable["id"];
// }
// $ordersTable = getTable("orders", "klant_id", $klanten_id);
// if ($ordersTable == false) {
//     echo "order niet gevonden<br>";
// }
// else {
//     echo "order gevonden<br>";
// }

// $bestelregelsTable = getTable("bestelregels", "order_id", $ordersTable["id"]);
// $productenTable = getTable("producten", "id", $bestelregelsTable["product_id"]);


// $rawOrders = getTableRaw("orders", "klant_id", $klanten_id);
// $rawBestelregels = getTableRaw("bestelregels", "order_id", $ordersTable["id"]);
// $rawProducten = getTableRaw("producten", "id", $bestelregelsTable["product_id"]);
$result = tableData($userID);
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
    </style>

    </head>

<body>

    <nav>   
        <ul class="nav-list">
            <li class="navlogo"><img src="img/NYP.png" height="71px" alt="logo"></li>
            <li class="navitems"><a href="index.php">Home</a></li>
            <li class="navitems"><a href="">Menu</a></li>
            <li class="navitems"><a href="">Deals</a></li>
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
                echo "tablehead generated<br>";
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



<?php
// echo "
//     <tbody>
//         <tr>
//             <td>00001234</td>
//             <td>28-05-2024</td>
//             <td>1x Pizza Peperoni</td>
//         </tr>
//         <tr>
//             <td>00002567</td>
//             <td>16-07-2024</td>
//             <td>1x Milkshake 2x...</td>
//         </tr>
//         <tr>
//             <td>00003678</td>
//             <td>18-09-2024</td>
//             <td>2x Milkshake</td>
//         </tr>
//     </tbody>
//      </table>
// ";
?>
</body>
</html>