<?php
require_once "functions.php";

session_start();
if (!isset($_SESSION["UserID"])) {
    header("location: ../login.php");
    echo "exit 1";
    exit();
}
$userID = $_SESSION["UserID"];

if (isset($_POST["submit"])) {
    $row = addOrder($userID);
    $orderID = $row['id'];

    $result = menuTable(); 
    $i=0;
    while ($row = mysqli_fetch_assoc($result)) {
        $i++;
        if ($_POST["$i"]) {
            $productID = $i;
            $aantal = $_POST["$i"];
            addBestelregels($orderID, $productID, $aantal);
        }
    }
    header("location: ../klant.php");
    exit();
} else {
    header("location: ../index.php");
    exit();
}