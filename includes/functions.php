<?php

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function emptyInputSignup($naam, $email, $wachtwoord)
{
    $result;
    if (empty($naam) || empty($email) || empty($wachtwoord)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}
