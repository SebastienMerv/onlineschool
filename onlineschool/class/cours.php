<?php

class Cours
{
    function createCour($label, $description, $teacher, $date)
    {
        $pdo = new PDO('mysql:host=localhost;dbname=onlineschool', 'root', 'root');
        $pdo->exec("SET  NAMES UTF8");
        $sql = "INSERT INTO cours(`libelle`, `description`, `teacher_id`, `date`) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$label, $description, $teacher, $date]);
        header('Location: index.php');
        date_default_timezone_set('Europe/Paris');
        $date = date("Y-m-d h:m:s");
        $logs = "[$date] Création du cours $label, avec comme description $description\r\n";
        $files = fopen('logs.txt', 'r');
        fputs($files, $logs);
        fclose($files);
        
        
    }

    function addEleveCour($user, $cour)
    {
        $pdo = new PDO('mysql:host=localhost;dbname=onlineschool', 'root', 'root');
        $pdo->exec("SET  NAMES UTF8");
        $sql = "INSERT INTO inscription(`student_id`, `cours_id`) VALUES (?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$user, $cour]);
        date_default_timezone_set('Europe/Paris');
        $date = date("Y-m-d h:m:s");
        $logs = "[$date] Ajout de l'élève ayant comme id $user au cours ayant l'id $cour\r\n";
        $files = fopen('logs.txt', 'r');
        fputs($files, $logs);
        fclose($files);
    }
    function removeEleveCour($uid)
    {
        $pdo = new PDO('mysql:host=localhost;dbname=onlineschool', 'root', 'root');
        $pdo->exec("SET  NAMES UTF8");
        $query = "DELETE from inscription where student_id = :student";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['student' => $uid]);
        date_default_timezone_set('Europe/Paris');
        $date = date("Y-m-d h:m:s");
        $logs = "[$date] Erreur à corriger je te laisse trouver chackal\r\n";
        $files = fopen('logs.txt', 'r');
        fputs($files, $logs);
        fclose($files);
        header('Location: #');

    }
    function updateCour($label, $description, $teacher, $date)
    {
        $pdo = new PDO('mysql:host=localhost;dbname=onlineschool', 'root', 'root');
        $pdo->exec("SET  NAMES UTF8");
        $sql = "UPDATE cours(`libelle`, `description`, `teacher_id`, `date`) SET (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$label, $description, $teacher, $date]);
        date_default_timezone_set('Europe/Paris');
        $date = date("Y-m-d h:m:s");
        $logs = "[$date] Mise à jour du cours $label\r\n";
        $files = fopen('logs.txt', 'r');
        fputs($files, $logs);
        fclose($files);
        header('Location: index.php');
    }
    function SelectCours($uid)
    {
        
        $pdo = new PDO('mysql:host=localhost;dbname=onlineschool', 'root', 'root');
        $pdo->exec("SET  NAMES UTF8");
        $query = "SELECT * from cours WHERE teacher_id = :tid";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['tid' => $uid]);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    function oneCour($pid)
    {
        $pdo = new PDO('mysql:host=localhost;dbname=onlineschool', 'root', 'root');
        $pdo->exec("SET  NAMES UTF8");
        $query = "SELECT * from cours where id = :cid";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['cid' => $pid]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data;
    }
    function StudentInscris($coursid)
    {
        $pdo = new PDO('mysql:host=localhost;dbname=onlineschool', 'root', 'root');
        $pdo->exec("SET  NAMES UTF8");
        $query = "SELECT * FROM inscription INNER JOIN cours ON cours.id = inscription.cours_id INNER JOIN users ON users.id = inscription.student_id WHERE inscription.cours_id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$coursid]);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    function SetPresence($coursid, $uid) {
        $pdo = new PDO('mysql:host=localhost;dbname=onlineschool', 'root', 'root');
        $pdo->exec("SET  NAMES UTF8");
        $sql = "UPDATE inscription SET absence = 0 WHERE student_id = ? AND cours_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$uid, $coursid]);
        date_default_timezone_set('Europe/Paris');
        $date = date("Y-m-d h:m:s");
        $logs = "[$date] Set présent l'élève ayant l'id $uid au cours ayant l'id $coursid\r\n";
        $files = fopen('logs.txt', 'r');
        fputs($files, $logs);
        fclose($files);
        header('Location: #');
    }
    function SetAbsence($coursid, $uid) {
        $pdo = new PDO('mysql:host=localhost;dbname=onlineschool', 'root', 'root');
        $pdo->exec("SET  NAMES UTF8");
        $sql = "UPDATE inscription SET absence = 1 WHERE student_id = ? AND cours_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$uid, $coursid]);
        date_default_timezone_set('Europe/Paris');
        $date = date("Y-m-d h:m:s");
        $logs = "[$date] Set absence l'élève ayant l'id $uid au cours ayant l'id $coursid\r\n";
        $files = fopen('logs.txt', 'r');
        fputs($files, $logs);
        fclose($files);
        header('Location: #');
    }
}
