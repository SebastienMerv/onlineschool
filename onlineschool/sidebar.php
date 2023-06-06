<?php
include_once( 'C:\UwAmp\www\onlineschool\class/user.php');

$users = New User;

$userdata = $users->DataOfUser($_SESSION["email"]);


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
<style>
body {
    height: 100vh;
    background-color: #ABABBD;
}

.sidebar {
    display: flex;
    justify-content: space-between;
    margin-left: 20px;
    margin-right: 20px;
    align-items: center;

}
.link {
    text-decoration: none;
    font-size: 25px;
}
.icon-button {
  position: relative;
  display: flex;
  align-items: center;
  justify-content: center;
  width: 50px;
  height: 50px;
  color: #333333;
  background: #dddddd;
  border: none;
  outline: none;
  border-radius: 50%;
}

.icon-button:hover {
  cursor: pointer;
}

.icon-button:active {
  background: #cccccc;
}

.icon-button__badge {
  position: absolute;
  top: -10px;
  right: -10px;
  width: 25px;
  height: 25px;
  background: red;
  color: #ffffff;
  display: flex;
  justify-content: center;
  align-items: center;
  border-radius: 50%;
}
.flexend {
    margin-top: 10px;
    display: flex;
    flex-direction: row;
}
.space {
    margin-left: 20px;
}
.links {
    display: flex;
    flex-direction: column;
}

.profil {
  text-decoration: none;
  color: black;
  background-color: grey;
  padding: 10px;
  border-radius: 5px;
}
</style>

</head>
<body>

<!-- Sidebar -->
<div class="offcanvas offcanvas-start" data-bs-backdrop="static" tabindex="-1" id="staticBackdrop" aria-labelledby="staticBackdropLabel">
  <div class="offcanvas-header">
    <h3 class="offcanvas-title" id="staticBackdropLabel">Online School</h3>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <div class="links">
    <a  class="link" href="../../../../../onlineschool/dashboard/index.php">Accueil</a>
    <?php if($userdata["teacher"] == 1) {?>
    <a  class="link" href="../../../../../onlineschool/dashboard/cours/index.php">Gestion des cours</a>
    <a  class="link" href="../../../../../onlineschool/dashboard/students.php">Gestion des élèves</a>
    <a  class="link" href="../../../../../onlineschool/dashboard/teachers.php">Gestion des enseignants</a>
<?php 
}
    ?>
    </div>
  </div>
</div>
</div>
<!-- Side bar -->



<div class="sidebar">
<!-- Boutton de menu  -->
<button class="btn" data-bs-toggle="offcanvas" data-bs-target="#staticBackdrop" aria-controls="staticBackdrop">
    <span class="icon">
        <svg viewBox="0 0 175 80" width="40" height="40">
            <rect width="80" height="15" fill="black" rx="10"></rect>
            <rect y="30" width="80" height="15" fill="black" rx="10"></rect>
            <rect y="60" width="80" height="15" fill="black" rx="10"></rect>
        </svg>
    </span>
    <span class="text">MENU</span>
</button>
<!-- Bouton de menu -->
<div class="flexend">
  <a class="profil"><?=$_SESSION["surname"]?> <?=$_SESSION["name"]?></a>
</div>
</div>


</body>
</html>


