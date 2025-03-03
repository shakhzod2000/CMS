<?php

namespace App\Admin\Support;

use PDO;

class AuthService {
    public function __construct(private PDO $pdo) {}

    private function ensureSession() {
        if (empty(session_id())) {
            session_start();
        }
    }
    
    public function logout() {
        $this->ensureSession();
        unset($_SESSION['adminUserId']);
        session_regenerate_id();
    }

    public function handleLogin(string $username, string $password): bool {
        if (empty($username) or empty($password)) return false;

        $stmt = $this->pdo->prepare('SELECT `id`, `password` FROM `users` WHERE `username` = :username');
        $stmt->bindValue(':username', $username);
        $bool = $stmt->execute();
        $entry = $stmt->fetch(PDO::FETCH_ASSOC);
        if (empty($entry)) return false;
        $hash = $entry['password'];
        $passwordOk = password_verify($password, $hash);
        if (empty($passwordOk)) return false;
        
        $this->ensureSession();
        $_SESSION['adminUserId'] = $entry['id'];
        session_regenerate_id();
        return true;
    }

    public function isLoggedIn(): bool {
        $this->ensureSession();
        return !empty($_SESSION['adminUserId']);
    }

    public function ensureLogin() {
        $isLoggedIn = $this->isLoggedIn();
        if (empty($isLoggedIn)) {
            header('Location: index.php?' . http_build_query(['route' => 'admin/login']));
            die();
        }
    }
}