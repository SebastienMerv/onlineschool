<!DOCTYPE html>
<html lang="en">
<?php

// Dependances
require_once("../class/user.php");
require_once("../class/cours.php");
require_once("../class/iflogged.php");
// Dépendances


// Session
session_start();
// Session 


// Objets 
$users = New User;
$cours = New Cours;
// Objets


// Données demandées pour les foreachs
$allUsers = $users->SelectAllActiveUsers();

$userdata = $users->DataOfUser($_SESSION["email"]);
$uid = $userdata["id"];
$coursteacher = $cours->SelectCours($uid);
// Données demandées pour les foreachs


// Bouton pour gérer les présences 
$coursstudent = $users->CoursStudent($uid);
if(isset($_POST["presence"])) {
    header('Location: cours/absence.php?pid='.$_POST["cid"]);
}
// Bouton pour gérer les présences
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
            box-shadow: 4px 4px 4px black;
            transition: box-shadow 0.3s;
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

        .lien {
            width: 10px;
            justify-self: center;
        }
    </style>
</head>

<body>
    <?php (include_once('../sidebar.php')); ?>


    <div class="title">
        <h5>Bonjour <?= $_SESSION["surname"] ?>, bienvenue dans l'interface Online School</h5>
        <?php if ($userdata["teacher"] == 1) { ?>
            <h7>Ici tu peux les utilisateurs et les différents cours</h7>
        <?php } ?>
        <?php if ($userdata["student"] == 1) { ?>
            <h7>Ici tu peux gérer les présences à tes cours de la journée !</h7>
        <?php } ?>
    </div>
    <div class="body">

        <?php if ($userdata["teacher"] == 1) { ?>
            <div class="rectangle">
                <!-- Prochain Cours ENSEIGNANT -->
                <h5>Mes prochains cours :</h5><br>
                <?php
                $i = 0;
                foreach ($coursteacher as $row) :
                    $i++; ?>
                    <div class="gestioncour">
                        <h6><?= $row["libelle"] ?> -
                        <?= $row["date"] ?></h6>
                        <form action="" method="post">
                        <input id="prodId" name="cid" type="hidden" value="<?=$row["id"]?>">
                        <button type="submit" class="gerer" name="presence">Présences</button>
                        </form>
                    </div>
                    <?php if ($i == 8) {
                        break;
                    }
                    ?>
                    
                <?php endforeach ?>
                <a href="cours/index.php" class="lien">Voir tous les cours</a>
            </div>

            <!-- Derniers utilisateurs activés ENSEIGNANT -->
            <div class="rectangle">
                <h5>Derniers utilisateurs activés :</h5>
                <?php
                $u = 0;
                foreach ($allUsers as $row) : ?>
                    <h6><?= $row["name"] ?> <?= $row["surname"] ?></h6>
                    <?php if ($u == 5) {
                        break;
                    } ?>
                <?php endforeach ?>
            </div>
        <?php } ?>


        <?php if ($userdata["student"] == 1) {
        ?>
            <div class="rectangle">

                <!-- Prochains Cours ELEVES -->
                <h5>Mes prochains cours :</h5><br>
                <?php
                $i = 0;
                foreach ($coursstudent as $row) :
                    $i++; ?>
                    <div class="gestioncour">
                        <h6><?= $row["libelle"] ?> - <?= $row["date"] ?></h6>
                        <button class="gerer">Prévenir de mon absence</button>
                    </div>
                    <?php if ($i == 3) {
                        break;
                    } ?>
                <?php endforeach ?>
                <a href="cours.php" class="lien">Voir tous mes cours</a>
            </div>

            <!-- Dernières absences ELEVES  -->
            <div class="rectangle">
                <h5>Mes dernières absences :</h5>
                <?php
                $datauser = $users->DataOfUser($_SESSION["email"]);
                $absences = $users->myAbsence($datauser["id"]);
                $u = 0;
                foreach ($absences as $row) : ?>
                    <h6><?= $row["libelle"] ?> - <?= $row["date"] ?></h6>
                    <?php if ($u == 10) {
                        break;
                    } ?>
                <?php endforeach ?>
            </div>

        <?php } ?>
        <?php if($userdata["teacher"] == 1) { ?>
        <img src="../assets/teacher.png">
        <?php } ?>
        <?php if($userdata["student"] == 1) { ?>
        <img src="../assets/student.png">
        <?php } ?>
    </div>
</body>

</html>