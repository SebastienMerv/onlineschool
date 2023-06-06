<!DOCTYPE html>
<html lang="en">
<?php (require_once('../function.php'));

require_once("../class/protocole.php");
require_once("../class/user.php");
require_once("../class/iflogged.php");
require_once("../class/ifteacher.php");

$protocole = New Protocole;


if(isset($_POST["submit"])) {
    $protocole->accountDelete($_POST["id"]);
    header('Location: #');
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
        }

        .rectangle {
            padding: 30px;
            border-radius: 5px;
            border: solid 2px black;
            width: 30%;
            margin-right: 10px;
            height: 70%;
        }

        .user {
            margin-left: 15px;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: space-around;
            margin-bottom: 15px;
        }

        .gerer {
            font-family: monospace;
            background-color: #f3f7fe;
            color: #3b82f6;
            border: none;
            border-radius: 8px;
            width: 150px;
            height: 35px;
            transition: .3s;
            margin-left: 10px;
        }


    </style>
</head>

<body>
    <?php (include_once('../sidebar.php')); ?>


    <div class="title">
        <h5>Bonjour Sébastien,</h5>

        <h7>Ici tu peux gérer les différents élèves du site internet !</h7><a href="Useradd.php">Ajouter un élève</a>
    </div>
    <div class="body">
        <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Elèves</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <?php 
                                $pdo = new PDO('mysql:host=localhost;dbname=onlineschool', 'root', 'root');
                                $pdo->exec("SET  NAMES UTF8");
                                $query = "SELECT * from users where student = 1";
                                $stmt = $pdo->prepare($query);
                                $stmt->execute([]);
                                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            
                            ?>
                            <tr>
                                <th>Nom</th>
                                <th>Prénom</th>
                                <th>Rôle</th>
                                <th>Gestion</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($data as $row) :?>
                            <tr>
                                <td><?= $row["name"]?></td>
                                <td><?= $row["surname"]?></td>
                                <td>Eleve</td>
                                <form method="post" action="">
                                <input type="hidden" id="id" name="id" value="<?= $row["id"]?>">
                                <td><button class="gerer" name="submit">Supprimer</button></td>
                                </form>
                            </tr>
                                <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
    </div>
</body>

</html>