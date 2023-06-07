<?php

class Protocole
{
    function login($email, $password)
    {
        session_start();
        $pdo = new PDO('mysql:host=localhost;dbname=onlineschool', 'root', 'root');
        $pdo->exec("SET  NAMES UTF8");
        $query = "SELECT * from users where email = :email";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['email' => $email]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if (password_verify($password, $data["password"])) {
            $query = "SELECT * from users where email = :email";
            $stmt = $pdo->prepare($query);
            $stmt->execute(['email' => $email]);
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($data["active"] == 1) {
                $_SESSION["logged_in"] = true;
                $_SESSION["email"] = $email;
                $_SESSION["name"] = $data["name"];
                $_SESSION["surname"] = $data["surname"];

                header('Location: dashboard/index.php');
            }
        } else {
            echo "Mot de passe incorrect";
        }
    }
    function createUser($email, $name, $surname, $role)
    {
        // Créer une conexion
        $pdo = new PDO('mysql:host=localhost;dbname=onlineschool', 'root', 'root');
        $pdo->exec("SET  NAMES UTF8");
        $sql = "INSERT INTO users(`name`, `surname`, `email`) VALUES (?, ?, ?)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $surname, $email]);


        $query = "SELECT * from users where email = :email";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['email' => $email]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        $uid = $data["id"];
        if ($role == 'teacher') {
            $query = "UPDATE `users` SET `teacher`=true WHERE email = ?";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$email]);
        }
        if ($role == 'student') {
            $query = "UPDATE `users` SET `student`=true WHERE email = ?";
            $stmt = $pdo->prepare($query);
            $stmt->execute([$email]);
        }
        $tohash = rand(1, 10000);
        $newactivation = password_hash($tohash, PASSWORD_BCRYPT);

        $sql = "INSERT INTO activation(`code`, `user_id`) VALUES (?, ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$newactivation, $uid]);
        header('Location: ../mailsetprofil.php?activation=' . $newactivation);
    }
    function accountDelete($account)
    {
        $pdo = new PDO('mysql:host=localhost;dbname=onlineschool', 'root', 'root');
        $pdo->exec("SET  NAMES UTF8");
        $query = "DELETE from users where id = :account";
        $stmt = $pdo->prepare($query);
        $stmt->execute(['account' => $account]);
    }
}
