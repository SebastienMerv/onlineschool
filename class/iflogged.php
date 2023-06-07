<?php

if(isset($_SESSION["logged_in"])) {
    if($_SESSION["logged_in"] == 0) {
        header('Location: ../../../../../onlineschool/');
    }
}