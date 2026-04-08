<?php
session_start();

class UserController
{
    private $conn;

    public function __construct()
    {
        $this->conn = new mysqli("localhost", "root", "1234567890", "CaseHub");

        if ($this->conn->connect_error) {
            die("Error de conexion: " . $this->conn->connect_error);
        }
    }

    public function register($name, $surname, $email, $country, $password)
    {
        $email = trim($email);

        $checkStmt = $this->conn->prepare("SELECT ID FROM Users WHERE Email = ?");
        $checkStmt->bind_param("s", $email);
        $checkStmt->execute();
        $existingUser = $checkStmt->get_result();

        if ($existingUser->num_rows > 0) {
            return "Ya existe una cuenta con ese correo.";
        }

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->conn->prepare(
            "INSERT INTO Users (Name, Surname, Email, Country, Password) VALUES (?, ?, ?, ?, ?)"
        );
        $stmt->bind_param("sssss", $name, $surname, $email, $country, $passwordHash);

        if (!$stmt->execute()) {
            return "No se pudo registrar el usuario.";
        }

        $_SESSION['user_id'] = $stmt->insert_id;
        $_SESSION['user_name'] = $name;
        $_SESSION['user_surname'] = $surname;
        $_SESSION['user_email'] = $email;
        $_SESSION['user_country'] = $country;

        return true;
    }

    public function login($email, $password)
    {
        $email = trim($email);

        $stmt = $this->conn->prepare("SELECT * FROM Users WHERE Email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return "Usuario no encontrado.";
        }

        $user = $result->fetch_assoc();
        $storedPassword = $user['Password'];
        $validPassword = password_verify($password, $storedPassword) || $password === $storedPassword;

        if (!$validPassword) {
            return "Contrasena incorrecta.";
        }

        $_SESSION['user_id'] = $user['ID'];
        $_SESSION['user_name'] = $user['Name'];
        $_SESSION['user_surname'] = $user['Surname'];
        $_SESSION['user_email'] = $user['Email'];
        $_SESSION['user_country'] = $user['Country'];

        return true;
    }

    public function logout()
    {
        $_SESSION = [];

        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
        }

        session_destroy();
    }

    public function isLogged()
    {
        return isset($_SESSION['user_id']);
    }

    public function getCurrentUser()
    {
        if (!$this->isLogged()) {
            return null;
        }

        return [
            'id' => $_SESSION['user_id'],
            'name' => $_SESSION['user_name'] ?? '',
            'surname' => $_SESSION['user_surname'] ?? '',
            'email' => $_SESSION['user_email'] ?? '',
            'country' => $_SESSION['user_country'] ?? '',
        ];
    }
}
