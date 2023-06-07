<?php (require_once('../function.php'));

require_once("../class/protocole.php");
(include_once('../class/iflogged.php'));
require_once("../class/ifteacher.php");

$protocole = New Protocole;

if(isset($_POST["submit"])) {
    $protocole->createUser($_POST["email"], $_POST["name"], $_POST["surname"], $_POST["role"]);
    
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel d'administration</title>
    <style>
        .title {
            margin: 20px;
            margin-left: 40px;
        }

        .body {
            background-color: #D9D9D9;
            width: 95%;
            height: 79%;
            border-radius: 8px;
            margin-left: 2%;
            margin-right: 2%;
            display: flex;
            flex-direction: row;
            justify-content: space-around;
        }

        input {
            display: block;
            margin-top: 10px;
            margin: 5%;
            padding: 2%;
            text-align: center;
            border-radius: 8px;
            border-color: none;
            width: 350px;
        }

        form {
            margin-top: 20px;
            /* display: flex; */
            flex-direction: column;
        }

        .kevin {
            font-family: monospace;
            background-color: #f3f7fe;
            color: #3b82f6;
            border: none;
            border-radius: 8px;
            width: 100px;
            height: 45px;
            transition: .3s;
        }

        .kevin:hover {
            background-color: #3b82f6;
            box-shadow: 0 0 0 5px #3b83f65f;
            color: #fff;
        }
    </style>
</head>

<body>
    <?php (include_once('../sidebar.php')); ?>


    <div class="body">
        <form action="" method="post">
            <input placeholder="Adresse mail de l'utilisateur" name="email" required>
            <input placeholder="Nom" name="name" required>
            <input placeholder="Prénom" name="surname" required>
            <label for="role">Rôle</label>
            <select name="role" id="role">
                <option value="teacher">Professeur</option>
                <option value="student">Elève</option>
            </select><br><br>
            <button class="kevin" name="submit">Définir</button>
        </form>
    </div>
</body>

</html>