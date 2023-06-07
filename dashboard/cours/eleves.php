<!DOCTYPE html>
<html lang="fr">
<?php (require_once('../../function.php'));


$pdo = new PDO('mysql:host=localhost;dbname=onlineschool', 'root', 'root');
$pdo->exec("SET  NAMES UTF8");
$id = $_GET["pid"];
$query = "SELECT * from cours where id = :id";
$stmt = $pdo->prepare($query);
$stmt->execute(['id' => $id]);
$data = $stmt->fetch(PDO::FETCH_ASSOC);
$courref = $data;

date_default_timezone_set('Europe/Paris');

$date = $courref["date"];





$pdo = new PDO('mysql:host=localhost;dbname=onlineschool', 'root', 'root');
$pdo->exec("SET  NAMES UTF8");
$query = "SELECT * from users where student = 1";
$stmt = $pdo->prepare($query);
$stmt->execute([]);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
$eleves = $data;

$pdo = new PDO('mysql:host=localhost;dbname=onlineschool', 'root', 'root');
$pdo->exec("SET  NAMES UTF8");
$query = "SELECT * FROM inscription INNER JOIN cours ON cours.id = inscription.cours_id INNER JOIN users ON users.id = inscription.student_id WHERE inscription.cours_id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$courref["id"]]);
$data = $stmt->fetchAll(PDO::FETCH_ASSOC);
$inscris = $data;

if(isset($_POST["submit"])) {
    addEleveCour($_POST["student"], $courref["id"]);
    header('Location: #');
}

if(isset($_POST["Remove"])) {
    removeEleveCour($_POST["id"]);
}

if(isset($_POST["finish"])) {
    header('Location: index.php');
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
        .list {
            display: flex;
            flex-direction: column;
        }
    </style>
</head>

<body>
    <?php (include_once('../../sidebar.php')); ?>


    <div class="title">
        <h5>Bonjour Sébastien,</h5>

        <h7>Ajoute des élèves au cours : <?=$courref["libelle"]?></h7>
    </div>
    <div class="body">
        <form action="" method="post">
            <label for="student">Ajout d'élèves au cours</label>
            <select name="student" id="student">
            <?php foreach($eleves as $row) :?>
                <option value="<?= $row["id"]?>"><?= $row["name"]?> <?= $row["surname"]?></option>
                <?php endforeach ?>
            </select>
            <br><br>
            <button class="kevin" name="submit">Ajouter</button>
            <button class="kevin" name="finish">Terminer</button>
        </form>
        
                <div class="list">
        <h4>Liste des élèves déjà inscrit au cours :</h4>
        <?php foreach($inscris as $row) :?>
            <h5><?=$row["name"]?> <?=$row["surname"]?><form method="post" action=""><input id="id" name="id" type="hidden" value="<?=$row["id"]?>"> <button class="kevin" name="Remove">Retirer</button></form>
            <?php endforeach ?>
            </div>
    </div>
</body>

</html>