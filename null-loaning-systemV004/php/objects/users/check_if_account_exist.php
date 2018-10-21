<?php
    include "../../CLASSES/Users.php";
    $execute_check = new Users();

    $username = $_POST["username"];
    $password = $_POST["password"];
    $execute_check->check_if_account_exist($username, $password);