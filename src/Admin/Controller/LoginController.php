<?php

namespace App\Admin\Controller;

class LoginController extends AbstractAdminController {

    public function logout() {
        $this->authService->logout();
        header('Location: index.php?' . http_build_query(['route' => 'admin/login']));

    }

    public function login() {
        if ($this->authService->isLoggedIn()) {
            header('Location: index.php?' . http_build_query(['route' => 'admin/pages']));
            return;
        }

        $loginError = false;
        if (!empty($_POST)) {
            $username = @(string) ($_POST['username'] ?? '');
            $password = @(string) ($_POST['password'] ?? '');

            if (!empty($username) and !empty($password)) {
                $loginOk = $this->authService->handleLogin($username, $password);
                if ($loginOk) {
                    header('Location: index.php?' . http_build_query(['route' => 'admin/pages']));
                    return;
                }
                else $loginError = true;
            }
            else $loginError = true;
        }
        $this->render('login', [
            'loginError' => $loginError
        ]);

    }
}