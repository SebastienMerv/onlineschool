<?php

require_once("class/protocole.php");

$protocole = new Protocole;

if(isset($_POST["submit"])) {
    $protocole->login($_POST["email"], $_POST["password"]);
}


?>




<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OnlineSchool - Connexion</title>
    <style>
        .login {
            background-color: #D9D9D9;
            display: flex;
            justify-content: center;
            margin-top: 5%;
            margin-left: 10%;
            margin-right: 10%;
            flex-direction: column;
            text-align: center;
            border-radius: 8px;
        }



        input {
            display: block;
            margin-top: 10%;
            margin: 5%;
            padding: 2%;
            text-align: center;
            border-radius: 8px;
            border-color: none;
        }

        .cssbuttons-io-button {
            background: #A370F0;
            color: white;
            font-family: inherit;
            padding: 0.35em;
            padding-left: 1.2em;
            font-size: 17px;
            font-weight: 500;
            border-radius: 0.9em;
            border: none;
            letter-spacing: 0.05em;
            display: flex;
            align-items: center;
            box-shadow: inset 0 0 1.6em -0.6em #714da6;
            overflow: hidden;
            position: relative;
            height: 2.8em;
            padding-right: 3.3em;
            margin: 40px;
        }

        .cssbuttons-io-button .icon {
            background: white;
            margin-left: 1em;
            position: absolute;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 2.2em;
            width: 2.2em;
            border-radius: 0.7em;
            box-shadow: 0.1em 0.1em 0.6em 0.2em #7b52b9;
            right: 0.3em;
            transition: all 0.3s;
        }

        .cssbuttons-io-button:hover .icon {
            width: calc(100% - 0.6em);
        }

        .cssbuttons-io-button .icon svg {
            width: 1.1em;
            transition: transform 0.3s;
            color: #7b52b9;
        }

        .cssbuttons-io-button:hover .icon svg {
            transform: translateX(0.1em);
        }

        .cssbuttons-io-button:active .icon {
            transform: scale(0.95);
        }

        form {
            display: flex;
            justify-content: center;
            flex-direction: column;
        }
    </style>
</head>

<body>
    <div class="login">
        <h1>Online School</h1>
        <form action="" method="post">
            <input placeholder="Adresse éléctronique" name="email">
            <input placeholder="Mot de passe" name="password" type="password">
            <button class="cssbuttons-io-button" name="submit">Connexion
                <div class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                        <path fill="none" d="M0 0h24v24H0z"></path>
                        <path fill="currentColor" d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z"></path>
                    </svg>
                </div>
            </button>
        </form>
    </div>


</body>

</html>