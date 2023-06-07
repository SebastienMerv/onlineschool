<!DOCTYPE html>
<html lang="en">
<?php
require_once("../../class/cours.php");
require_once("../../class/iflogged.php");
require_once("../../class/ifteacher.php");

session_start();

$cours = New Cours;

date_default_timezone_set('Europe/Paris');
$date = date("Y-m-d");


$coursteacher = $cours->SelectAfterCours();
?>

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
            width: 95%;
            height: 79%;
            border-radius: 8px;
            margin-left: 2%;
            margin-right: 2%;
            display: flex;
            flex-direction: row;
            justify-content: space-around;
        }

        .rectangle {
            padding: 10px;
            border-radius: 5px;
            border: solid 2px black;
            width: 30%;
            margin-right: 10px;
            height: 100%;
            background-color: #D9D9D9;
        }

        .rectangle:hover {
            box-shadow: 2px 2px 2px black;
        }
        
        @media screen and (max-width: 1600px) {
            img {
                visibility: hidden;
                width: 1px;
                height: 1px;
            }
        }
        .gestioncour {
            display: flex;
            flex-direction: row;
            margin-bottom: 20px;
        }

        .gerer {
            font-family: monospace;
            background-color: #f3f7fe;
            color: #3b82f6;
            border: none;
            border-radius: 8px;
            width: 200px;
            height: 45px;
            transition: .3s;
        }

        .gerer:hover {
            background-color: #3b82f6;
            box-shadow: 0 0 0 5px #3b83f65f;
            color: #fff;
        }
    </style>
</head>

<body>
    <?php (include_once('../../sidebar.php')); ?>


    <div class="title">
        <h5>Bonjour <?= $_SESSION["surname"] ?>, bienvenue dans l'interface Online School</h5>
        <h7>Ici tu peux gérer les présences à tes cours de la journée !</h7>
    </div>
    <div class="body">
        <!-- Derniers utilisateurs activés ENSEIGNANT -->
        <div class="rectangle">
                <!-- Prochain Cours ENSEIGNANT -->
                <h5>Mes prochains cours :</h5><br>
                <?php
                foreach ($coursteacher as $row) : ?>
                    <div class="gestioncour">
                        <h6><?= $row["libelle"] ?> -
                        <?= $row["date"] ?></h6>
                        <button class="gerer">Présences</button>
                    </div>
                <?php endforeach ?>
            </div>
        <img src="../../assets/search.png">
    </div>
</body>

</html>