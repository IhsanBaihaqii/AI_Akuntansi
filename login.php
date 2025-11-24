<?php
require_once "config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $data = readJSON(USER_FILE);

    foreach($data as $k => $v){
        if ($username == $k) {
            if ($v["pass"] == $password){
                header('Location: dashboard.php');
                $_SESSION["username"] = $username;
                exit();
                break;
            }
        }
    }
    header('Location: index.php?error=1');
    exit();
}
?>