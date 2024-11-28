<?php
require_once "functions.php";

session_start();
if (!isset($_SESSION["UserID"])) {
    header("location: ../login.php");
    exit();
}
$userID = $_SESSION["UserID"];
// echo $userID . "<br>";

if (isset($_POST["submit"])) {
    $row = addOrder($userID);
    $orderID = $row['id'];
    // echo $orderID. "<br>";

    $result = menuTable();
    $i=0;
    while ($row = mysqli_fetch_assoc($result)) {
        $i++;
        if ($_POST["$i"]) {
            $productID = $i;
            $aantal = $_POST["$i"];
            addBestelregels($orderID, $productID, $aantal);
        // echo $i .':'. $_POST["$i"].'<br>';	
        }
    }
    header("location ../gelukt.php");
    exit();
} else {
    header("location: ../index.php");
    exit();
}
exit();