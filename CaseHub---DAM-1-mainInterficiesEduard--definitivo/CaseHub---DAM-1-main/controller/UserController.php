<?php

class UserController
{
    private $conn;
    private $usuariosHasTelefono;

    public function __construct()
    {
        $dbConfig = require __DIR__ . '/../config/database.php';

        $this->conn = new mysqli(
            $dbConfig['host'],
            $dbConfig['username'],
            $dbConfig['password'],
            $dbConfig['database'],
            $dbConfig['port']
        );
        $this->conn->set_charset('utf8mb4');

        if ($this->conn->connect_error) {
            die("Error de conexion: " . $this->conn->connect_error);
        }

        $this->usuariosHasTelefono = $this->tableHasColumn('usuarios', 'telefono');
    }

    public function register($name, $surname, $email, $country, $phone, $password)
    {
        $name = trim($name);
        $surname = trim($surname);
        $email = trim($email);
        $country = trim($country);
        $phone = trim($phone);

        if ($name === '' || $surname === '' || $email === '' || $country === '' || $password === '') {
            return "Todos los campos son obligatorios.";
        }

        $checkStmt = $this->conn->prepare("SELECT id FROM usuarios WHERE email = ?");
        $checkStmt->bind_param("s", $email);
        $checkStmt->execute();
        $existingUser = $checkStmt->get_result();

        if ($existingUser->num_rows > 0) {
            return "Ya existe una cuenta con ese correo.";
        }

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        if ($this->usuariosHasTelefono) {
            if ($phone === '') {
                return "El telefono es obligatorio.";
            }

            $stmt = $this->conn->prepare(
                "INSERT INTO usuarios (nombre, apellidos, email, pais, telefono, contrasena) VALUES (?, ?, ?, ?, ?, ?)"
            );
            $stmt->bind_param("ssssss", $name, $surname, $email, $country, $phone, $passwordHash);
        } else {
            $stmt = $this->conn->prepare(
                "INSERT INTO usuarios (nombre, apellidos, email, pais, contrasena) VALUES (?, ?, ?, ?, ?)"
            );
            $stmt->bind_param("sssss", $name, $surname, $email, $country, $passwordHash);
        }

        if (!$stmt->execute()) {
            return "No se pudo registrar el usuario: " . $stmt->error;
        }

        $_SESSION['user_id'] = $stmt->insert_id;
        $_SESSION['user_name'] = $name;
        $_SESSION['user_surname'] = $surname;
        $_SESSION['user_email'] = $email;
        $_SESSION['user_country'] = $country;
        $_SESSION['user_phone'] = $this->usuariosHasTelefono ? $phone : '';

        return true;
    }

    public function login($email, $password)
    {
        $email = trim($email);

        if ($email === '' || $password === '') {
            return "Debes rellenar correo y contrasena.";
        }

        $stmt = $this->conn->prepare("SELECT * FROM usuarios WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            return "Usuario no encontrado.";
        }

        $user = $result->fetch_assoc();
        $storedPassword = $user['contrasena'];
        $validPassword = password_verify($password, $storedPassword) || $password === $storedPassword;

        if (!$validPassword) {
            return "Contrasena incorrecta.";
        }

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['nombre'];
        $_SESSION['user_surname'] = $user['apellidos'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_country'] = $user['pais'];
        $_SESSION['user_phone'] = $this->usuariosHasTelefono ? ($user['telefono'] ?? '') : '';

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
            'phone' => $_SESSION['user_phone'] ?? '',
        ];
    }

    private function tableHasColumn(string $table, string $column): bool
    {
        $table = $this->conn->real_escape_string($table);
        $column = $this->conn->real_escape_string($column);
        $result = $this->conn->query("SHOW COLUMNS FROM `$table` LIKE '$column'");

        return $result !== false && $result->num_rows > 0;
    }
}
