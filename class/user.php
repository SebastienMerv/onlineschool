<?php

class User
{
    function setProfil($phone, $password, $verification)
    {
        $hashpassword = password_hash($password, PASSWORD_BCRYPT);
        // Créer une conexion
        $pdo = new PDO('mysql:host=localhost;dbname=onlineschool', 'root', 'root');
        $pdo->exec("SET  NAMES UTF8");
        $query = "SELECT * from activation WHERE code = :code";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['code' => $verification]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $uid = $data["user_id"];
        $query = "UPDATE `users` SET `phone`=?, `password`=?, active=1 WHERE id = ?";
        $stmt = $pdo->prepare($query);
        $stmt->execute([$phone, $hashpassword, $uid]);
        var_dump($data);

        $query = "DELETE from activation where code = :code";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['code' => $_GET["account"]]);
        header('Location: index.php');
        date_default_timezone_set('Europe/Paris');
        $date = date("Y-m-d h:m:s");
        $logs = "[$date] Mise à jour des données du compte ayant pour numéro $phone\r\n";
        $files = fopen('logs.txt', 'r');
        fputs($files, $logs);
        fclose($files);
    }

    function SelectAllActiveUsers()
    {
        $pdo = new PDO('mysql:host=localhost;dbname=onlineschool', 'root', 'root');
        $pdo->exec("SET  NAMES UTF8");
        $query = "SELECT * from users WHERE active = 1";
        $stmt = $pdo->prepare($query);
        $stmt->execute([]);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    function DataOfUser($email)
    {
        $pdo = new PDO('mysql:host=localhost;dbname=onlineschool', 'root', 'root');
        $pdo->exec("SET  NAMES UTF8");
        $query = "SELECT * from users where email = :email";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['email' => $email]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        return $data;
    }
    function CoursStudent($uid)
    {
        $pdo = new PDO('mysql:host=localhost;dbname=onlineschool', 'root', 'root');
        $pdo->exec("SET  NAMES UTF8");
        $query = "SELECT * from users u INNER JOIN inscription i ON u.id = i.student_id INNER JOIN cours c ON i.cours_id = c.id WHERE id = :uid";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['uid' => $uid]);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    function accountDelete($uid)
    {
        $pdo = new PDO('mysql:host=localhost;dbname=onlineschool', 'root', 'root');
        $pdo->exec("SET  NAMES UTF8");
        $query = "DELETE FROM users :id";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['id' => $uid]);
        date_default_timezone_set('Europe/Paris');
        $date = date("Y-m-d h:m:s");
        $logs = "[$date] Suppression du compte ayant pour identifiant $uid\r\n";
        $files = fopen('logs.txt', 'r');
        fputs($files, $logs);
        fclose($files);
    }
    function allTeachers()
    {
        $pdo = new PDO('mysql:host=localhost;dbname=onlineschool', 'root', 'root');
        $pdo->exec("SET  NAMES UTF8");
        $query = "SELECT * from users where teacher = 1";
        $stmt = $pdo->prepare($query);
        $stmt->execute([]);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    function allStudents()
    {
        $pdo = new PDO('mysql:host=localhost;dbname=onlineschool', 'root', 'root');
        $pdo->exec("SET  NAMES UTF8");
        $query = "SELECT * from users where student = 1";
        $stmt = $pdo->prepare($query);
        $stmt->execute([]);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
    function myAbsence($uid)
    {
        $pdo = new PDO('mysql:host=localhost;dbname=onlineschool', 'root', 'root');
        $pdo->exec("SET  NAMES UTF8");
        $query = "SELECT * from inscription INNER JOIN cours ON cours.id = inscription.cours_id where student_id = :uid AND absence = 1";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['uid' => $uid]);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    }
}
