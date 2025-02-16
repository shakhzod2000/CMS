<?php

namespace App\Support;

class CsrfHelper {
    public function handle() {
        $this->ensureSession();
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if ($_POST['_csrf'] and $_SESSION['csrfToken'] and 
                $_POST['_csrf'] === $_SESSION['csrfToken']) {
                unset($_SESSION['csrfToken']);
                return;
            }

            http_response_code(419);
            echo "ERROR: CSRF Token mismatch<br>";
            // var_dump($_POST);
            // echo "<br>";
            // var_dump($_SESSION);
            die();
        }
    }

    public function ensureSession() {
        if (empty(session_id())) {
            session_start();
        }
    }
    
    public function generateToken() {
        if (empty($_SESSION['csrfToken'])) {
            $token = bin2hex(random_bytes(16));
            $_SESSION['csrfToken'] = $token;
        }
        return $_SESSION['csrfToken'];
    }
}