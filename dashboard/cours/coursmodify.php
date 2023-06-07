<?php (require_once('../../function.php'));
require_once("../../class/cours.php");
require_once("../../class/user.php");
require_once("../../class/iflogged.php");
require_once("../../class/ifteacher.php");
$cours = New Cours;
$User = New User;


if(isset($_POST["submit"])) {
    $cours->updateCour($_POST["label"], $_POST["description"], $_POST["enseignant"], $_POST["date"]);
}


date_default_timezone_set('Europe/Paris');
$date = date('y-m-d');
$donnees = $User->allTeachers();
$reference = $cours->oneCour($_GET["pid"]);

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
    <?php (include_once('../../sidebar.php')); ?>


    <div class="body">
        <form action="" method="post">
            <input placeholder="Libellée du cours" name="label" value="<?=$reference["libelle"]?>" required>
            <input placeholder="Description du cours" name="description" value="<?=$reference["description"]?>" required>
            <input type="date" id="start" name="date" value="<?=$reference["date"]?>" min="2018-01-01" max="<?=$date?>">

            <label for="teacher">Choix du professeur</label>
            <select name="enseignant" id="teacher">
            <?php foreach($donnees as $row) :?>
                <option value="<?= $row["id"]?>"><?= $row["name"]?> <?= $row["surname"]?></option>
                <?php endforeach ?>
            </select><br><br>
            <button class="kevin" name="submit">Définir</button>
        </form>
    </div>
</body>

</html>