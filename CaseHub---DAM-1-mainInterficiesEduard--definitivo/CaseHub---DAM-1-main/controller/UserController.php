<?php

class UserController
{
    private $conn;
    private $usuariosHasTelefono;
    private $usuariosHasRol;
    private const REMEMBER_COOKIE_LIFETIME = 2592000;

    public function __construct()   
    {
        $dbConfig = require __DIR__ . '/../config/database.php';
        require_once __DIR__ . '/../config/session.php';

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

        $this->ensureUserRoleColumn();
        $this->usuariosHasTelefono = $this->tableHasColumn('usuarios', 'telefono');
        $this->usuariosHasRol = $this->tableHasColumn('usuarios', 'rol');
        $this->restoreSessionFromCookies();
    }

    public function register($name, $surname, $email, $country, $phone, $password, $role = 'standard')
    {
        $name = trim($name);
        $surname = trim($surname);
        $email = trim($email);
        $country = trim($country);
        $phone = trim($phone);
        $role = in_array($role, ['admin', 'premium', 'standard'], true) ? $role : 'standard';

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

            if ($this->usuariosHasRol) {
                $stmt = $this->conn->prepare(
                    "INSERT INTO usuarios (nombre, apellidos, email, pais, telefono, rol, contrasena) VALUES (?, ?, ?, ?, ?, ?, ?)"
                );
                $stmt->bind_param("sssssss", $name, $surname, $email, $country, $phone, $role, $passwordHash);
            } else {
                $stmt = $this->conn->prepare(
                    "INSERT INTO usuarios (nombre, apellidos, email, pais, telefono, contrasena) VALUES (?, ?, ?, ?, ?, ?)"
                );
                $stmt->bind_param("ssssss", $name, $surname, $email, $country, $phone, $passwordHash);
            }
        } else {
            if ($this->usuariosHasRol) {
                $stmt = $this->conn->prepare(
                    "INSERT INTO usuarios (nombre, apellidos, email, pais, rol, contrasena) VALUES (?, ?, ?, ?, ?, ?)"
                );
                $stmt->bind_param("ssssss", $name, $surname, $email, $country, $role, $passwordHash);
            } else {
                $stmt = $this->conn->prepare(
                    "INSERT INTO usuarios (nombre, apellidos, email, pais, contrasena) VALUES (?, ?, ?, ?, ?)"
                );
                $stmt->bind_param("sssss", $name, $surname, $email, $country, $passwordHash);
            }
        }

        if (!$stmt->execute()) {
            return "No se pudo registrar el usuario: " . $stmt->error;
        }

        session_regenerate_id(true);
        $_SESSION['user_id'] = $stmt->insert_id;
        $_SESSION['user_name'] = $name;
        $_SESSION['user_surname'] = $surname;
        $_SESSION['user_email'] = $email;
        $_SESSION['user_country'] = $country;
        $_SESSION['user_phone'] = $this->usuariosHasTelefono ? $phone : '';
        $_SESSION['user_role'] = $this->usuariosHasRol ? $role : 'standard';
        $this->storeRememberCookies([
            'id' => $stmt->insert_id,
            'nombre' => $name,
            'apellidos' => $surname,
            'email' => $email,
            'pais' => $country,
            'telefono' => $phone,
            'rol' => $role,
            'contrasena' => $passwordHash,
        ]);

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

        session_regenerate_id(true);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['nombre'];
        $_SESSION['user_surname'] = $user['apellidos'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_country'] = $user['pais'];
        $_SESSION['user_phone'] = $this->usuariosHasTelefono ? ($user['telefono'] ?? '') : '';
        $_SESSION['user_role'] = $this->usuariosHasRol ? ($user['rol'] ?? 'standard') : 'standard';
        $this->storeRememberCookies($user);

        return true;
    }

    public function logout()
    {
        $_SESSION = [];

        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'], $params['httponly']);
        }

        $this->clearRememberCookies();
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
            'role' => $_SESSION['user_role'] ?? 'standard',
        ];
    }

    private function ensureUserRoleColumn(): void
    {
        if (!$this->tableHasColumn('usuarios', 'rol')) {
            $this->conn->query("ALTER TABLE usuarios ADD COLUMN rol VARCHAR(20) NOT NULL DEFAULT 'standard' AFTER pais");
        }
    }

    private function restoreSessionFromCookies(): void
    {
        if ($this->isLogged()) {
            return;
        }

        $userId = isset($_COOKIE['casehub_user_id']) ? (int) $_COOKIE['casehub_user_id'] : 0;
        $rememberToken = $_COOKIE['casehub_remember'] ?? '';

        if ($userId <= 0 || $rememberToken === '') {
            return;
        }

        $stmt = $this->conn->prepare("SELECT * FROM usuarios WHERE id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 0) {
            $this->clearRememberCookies();
            return;
        }

        $user = $result->fetch_assoc();
        $expectedToken = $this->buildRememberToken($user);

        if (!hash_equals($expectedToken, $rememberToken)) {
            $this->clearRememberCookies();
            return;
        }

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['nombre'];
        $_SESSION['user_surname'] = $user['apellidos'];
        $_SESSION['user_email'] = $user['email'];
        $_SESSION['user_country'] = $user['pais'];
        $_SESSION['user_phone'] = $this->usuariosHasTelefono ? ($user['telefono'] ?? '') : '';
        $_SESSION['user_role'] = $this->usuariosHasRol ? ($user['rol'] ?? 'standard') : 'standard';
    }

    private function storeRememberCookies(array $user): void
    {
        $options = caseHubCookieOptions(self::REMEMBER_COOKIE_LIFETIME);
        setcookie('casehub_user_id', (string) $user['id'], $options);
        setcookie('casehub_remember', $this->buildRememberToken($user), $options);
    }

    private function clearRememberCookies(): void
    {
        $expired = caseHubCookieOptions(-3600);
        setcookie('casehub_user_id', '', $expired);
        setcookie('casehub_remember', '', $expired);
    }

    private function buildRememberToken(array $user): string
    {
        $userId = (string) ($user['id'] ?? '');
        $email = (string) ($user['email'] ?? '');
        $passwordHash = (string) ($user['contrasena'] ?? '');

        return hash_hmac('sha256', $userId . '|' . $email . '|' . $passwordHash, caseHubRememberSecret());
    }

    private function tableHasColumn(string $table, string $column): bool
    {
        $table = $this->conn->real_escape_string($table);
        $column = $this->conn->real_escape_string($column);
        $result = $this->conn->query("SHOW COLUMNS FROM `$table` LIKE '$column'");

        return $result !== false && $result->num_rows > 0;
    }
}
