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

        $this->conn = new PDO(
            "mysql:host={$dbConfig['host']};dbname={$dbConfig['database']};charset=utf8mb4",
            $dbConfig['username'],
            $dbConfig['password'],
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]
        );

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

        $checkStmt = $this->conn->prepare(
            "SELECT id FROM usuarios WHERE email = :email"
        );
        $checkStmt->execute([':email' => $email]);

        if ($checkStmt->fetch()) {
            return "Ya existe una cuenta con ese correo.";
        }

        if ($this->usuariosHasTelefono && $phone === '') {
            return "El telefono es obligatorio.";
        }


        $passwordHash = password_hash($password, PASSWORD_DEFAULT);


        $sql = "INSERT INTO usuarios (nombre, apellidos, email, pais, contrasena";
        $values = "VALUES (:nombre, :apellidos, :email, :pais, :contrasena";

        $params = [
            ':nombre' => $name,
            ':apellidos' => $surname,
            ':email' => $email,
            ':pais' => $country,
            ':contrasena' => $passwordHash
        ];

        if ($this->usuariosHasTelefono) {
            $sql .= ", telefono";
            $values .= ", :telefono";
            $params[':telefono'] = $phone;
        }

        if ($this->usuariosHasRol) {
            $sql .= ", rol";
            $values .= ", :rol";
            $params[':rol'] = $role;
        }

        $sql .= ") " . $values . ")";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);

        $userId = $this->conn->lastInsertId();

        session_regenerate_id(true);
        $_SESSION['user_id'] = $userId;
        $_SESSION['user_name'] = $name;
        $_SESSION['user_surname'] = $surname;
        $_SESSION['user_email'] = $email;
        $_SESSION['user_country'] = $country;
        $_SESSION['user_phone'] = $this->usuariosHasTelefono ? $phone : '';
        $_SESSION['user_role'] = $this->usuariosHasRol ? $role : 'standard';

        $this->storeRememberCookies([
            'id' => $userId,
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


        $stmt = $this->conn->prepare(
            "SELECT * FROM usuarios WHERE email = :email"
        );


        $stmt->execute([':email' => $email]);
        $user = $stmt->fetch();



        if (!$user) {
            return "Usuario no encontrado.";
        }



        if (!password_verify($password, $user['contrasena'])) {
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
            $this->conn->exec(
                "ALTER TABLE usuarios ADD COLUMN rol VARCHAR(20) NOT NULL DEFAULT 'standard' AFTER pais"
            );
        }
    }


    private function restoreSessionFromCookies(): void
    {
        if ($this->isLogged()) {
            return;
        }


        $userId = (int) ($_COOKIE['casehub_user_id'] ?? 0);
        $rememberToken = $_COOKIE['casehub_remember'] ?? '';

        if ($userId <= 0 || $rememberToken === '') {
            return;
        }



        $stmt = $this->conn->prepare(
            "SELECT * FROM usuarios WHERE id = :id"
        );
        $stmt->execute([':id' => $userId]);
        $user = $stmt->fetch();

        if (!$user) {
            $this->clearRememberCookies();
            return;
        }



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
        return hash_hmac(
            'sha256',
            $user['id'] . '|' . $user['email'] . '|' . $user['contrasena'],
            caseHubRememberSecret()
        );
    }



    private function tableHasColumn(string $table, string $column): bool
    {
        $stmt = $this->conn->prepare(
            "SHOW COLUMNS FROM `$table` LIKE :column"
        );
        $stmt->execute([':column' => $column]);

        return (bool) $stmt->fetch();
    }
    public function updateUser(
        int $id,
        string $name,
        string $surname,
        string $email,
        string $country,
        string $phone = ''
    ) {
        $name = trim($name);
        $surname = trim($surname);
        $email = trim($email);
        $country = trim($country);
        $phone = trim($phone);

        if ($name === '' || $surname === '' || $email === '' || $country === '') {
            return "Todos los campos obligatorios deben estar rellenados.";
        }

        // Evitar email duplicado
        $stmt = $this->conn->prepare(
            "SELECT id FROM usuarios WHERE email = :email AND id != :id"
        );
        $stmt->execute([
            ':email' => $email,
            ':id' => $id
        ]);

        if ($stmt->fetch()) {
            return "El correo ya está en uso.";
        }

        $sql = "UPDATE usuarios 
            SET nombre = :nombre,
                apellidos = :apellidos,
                email = :email,
                pais = :pais";

        $params = [
            ':nombre' => $name,
            ':apellidos' => $surname,
            ':email' => $email,
            ':pais' => $country,
            ':id' => $id
        ];

        if ($this->usuariosHasTelefono) {
            $sql .= ", telefono = :telefono";
            $params[':telefono'] = $phone;
        }

        $sql .= " WHERE id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);

        // refrescar sesión
        $_SESSION['user_name'] = $name;
        $_SESSION['user_surname'] = $surname;
        $_SESSION['user_email'] = $email;
        $_SESSION['user_country'] = $country;
        if ($this->usuariosHasTelefono) {
            $_SESSION['user_phone'] = $phone;
        }

        return true;
    }
}

