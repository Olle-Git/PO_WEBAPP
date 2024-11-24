<?php
function connectDatabase($servername = "localhost", $username = "root", $password = "", $dbname = "nyp", $port = 3306) {
    $conn = new mysqli($servername, $username, $password, $dbname, $port);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}
//get user from formhandler.php after sending the user here
function getUser() {
    if (isset($_GET["userid"])) {
        return $_GET["userid"];
    } else {
        return 0;
    }
}

$userid = getUser();
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

<h1 style="color: white; margin-bottom: 2rem;">Uw bestellingen</h2>
    <table>
    <thead>
        <tr>
            <th>Bestellingen</th>
            <th>Datum</th>
            <th>Details</th>
        </tr>
    </thead>
<?php 
//connect to database and get orderid and date in list
$conn = connectDatabase();
$sql = "SELECT `id`, `besteldatum` FROM orders WHERE userid = ?;";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userid);
$stmt->execute();
$stmt->bind_result($orderid, $orderdate);
$stmt->fetch();
$stmt->close();

// connect to database bestelregels and get aantal en product_id
$sql2 = "SELECT `aantal`, `product_id` FROM bestelregels WHERE order_id = ?;";
$stmt2 = $conn->prepare($sql2);
$stmt2->bind_param("i", $orderid);
$stmt2->execute();
$stmt2->bind_result($aantal, $product_id);
$stmt2->fetch();
$stmt2->close();

// connect to database producten and get product name and prijs
$sql3 = "SELECT `naam`, `prijs` FROM producten WHERE id = ?;";
$stmt3 = $conn->prepare($sql3);
$stmt3->bind_param("i", $product_id);
$stmt3->execute();
$stmt3->bind_result($productname, $productprice);
$stmt3->fetch();
$stmt3->close();




echo "
    <tbody>
        <tr>
            <td>00001234</td>
            <td>28-05-2024</td>
            <td>1x Pizza Peperoni</td>
        </tr>
        <tr>
            <td>00002567</td>
            <td>16-07-2024</td>
            <td>1x Milkshake 2x...</td>
        </tr>
        <tr>
            <td>00003678</td>
            <td>18-09-2024</td>
            <td>2x Milkshake</td>
        </tr>
    </tbody>
    </table>
";
?>
</body>
</html>