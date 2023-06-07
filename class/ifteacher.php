<?php

require_once('user.php');

$user = New User;

$data = $user->DataOfUser($_SESSION["email"]);

if($data["teacher"] = 0) {
    header('Location: ../../../../../onlineschool');
}