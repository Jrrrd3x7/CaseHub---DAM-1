<?php
session_start();

class UserController
{

    private $conn;

    public function __construct()
    {
        $this->conn = new mysqli("localhost", "root", "", "tienda_fundas");

        if ($this->conn->connect_error) {
            die("Error de conexión: " . $this->conn->connect_error);
        }
    }

    // REGISTER
    public function register($nombre, $email, $password)
    {

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO usuarios (nombre, email, password)
                VALUES ('$nombre', '$email', '$passwordHash')";

        if ($this->conn->query($sql)) {
            $_SESSION['message'] = "Usuario registrado correctamente";
            header("Location: view/index.html");
            exit();
        } else {
            return "Error: " . $this->conn->error;
        }
    }

    // LOGIN
    public function login($email, $password)
    {

        $sql = "SELECT * FROM usuarios WHERE email = '$email'";
        $resultado = $this->conn->query($sql);

        if ($resultado->num_rows > 0) {

            $user = $resultado->fetch_assoc();

            if (password_verify($password, $user['password'])) {

                $_SESSION['user_id'] = $user['id'];
                $_SESSION['nombre'] = $user['nombre'];

                return true;
            } else {
                return "Contraseña incorrecta";
            }
        } else {
            return "Usuario no encontrado";
        }
    }

    // LOGOUT
    public function logout()
    {
        session_destroy();
        header("Location: view/login.php");
        exit();
    }

    // COMPROBAR LOGIN
    public function isLogged()
    {
        return isset($_SESSION['user_id']);
    }
}
