<?php
/**
 * @var PDO $pdo
 */
require "Model/login.php";

if (isset($_POST["login_button"])) {
    $username = !empty($_POST["username"])?$_POST["username"]:null;
    $pass = !empty($_POST["pass"])?$_POST["pass"]:null;

    if (
        !empty($username) && !empty($pass)){
        $username = cleanString($username);
        $pass = cleanString($pass);

        $user = getUser($pdo, $username);
        $isMatchPassword = is_array($user) && password_verify($pass, $user["pass"]);
    }
}

require "View/login.php";
