<?php
include_once ('Controller.php');

$controller = new UserController();
if($_SESSION['ID'] != null) header( 'Location: notes.php', true);
if($controller->CheckRememberHash()) header( 'Location: notes.php', true);

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $controller = new UserController();
    $pHash = hash('sha512',$_POST['password']);
    if($controller->ValidateAccount($_POST['email'],$pHash) == 1) {
        $_SESSION["ID"] = ($controller->GetIdByMail($_POST['email']));
        if ($_POST['remember'] == 1) {
            $controller->SetRememberHash($pHash, $_SESSION['ID']);
        }
        header( 'Location: notes.php', true);
    }
}

include_once ('html/header.html');
include_once ('html/login.html');

