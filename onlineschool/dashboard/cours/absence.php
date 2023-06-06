<!DOCTYPE html>
<html lang="fr">
<?php (require_once('../../function.php'));
require_once("../../class/cours.php");
require_once("../../class/user.php");
require_once("../../class/iflogged.php");
require_once("../../class/ifteacher.php");
$cours = new Cours;
$user = new User;
$courref = $cours->oneCour($_GET["pid"]);

$inscris = $cours->StudentInscris($_GET["pid"]);


if (isset($_POST["finish"])) {
    header('Location: index.php');
}

if(isset($_POST["presence"])) {
    $cours->SetPresence($_GET["pid"], $_POST["uid"]);
}
if(isset($_POST["absence"])) {
    $cours->SetAbsence($_GET["pid"], $_POST["uid"]);
}

?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel d'administration</title>
    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

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
            flex-direction: column;
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

        .list {
            display: flex;
            flex-direction: column;
        }

        .gerer {
            font-family: monospace;
            background-color: #f3f7fe;
            color: #3b82f6;
            border: none;
            border-radius: 8px;
            width: 350px;
            height: 45px;
            transition: .3s;
            margin-left: 10px;
        }
        
        
    </style>
</head>

<body>
    <?php include_once('../../sidebar.php'); ?>


    <div class="title">
        <h5>Bonjour Sébastien,</h5>

        <h7>Absences des élèves au cours de : <?= $courref["libelle"] ?></h7>
    </div>
    <div class="body">
        <?php foreach ($inscris as $row) : ?>
            <form action="" method="post">
                <h3><?= $row["surname"] ?> <?= $row["name"] ?></h3>
                <?php if ($row["absence"] == 0) { ?>
                    <input id="prodId" name="uid" type="hidden" value="<?= $row["id"] ?>">
                    <button class="gerer" name="absence" type="submit">Absent</button>
                <?php } ?>
                <?php if ($row["absence"] == 1) { ?>
                    <input id="prodId" name="uid" type="hidden" value="<?= $row["id"] ?>">
                    <button class="gerer" name="presence" type="submit">Présent</button>

                <?php } ?>
            </form>
        <?php endforeach ?>
        <a name="finish" href="index.php">Terminer</a>
    </div>
</body>

</html>