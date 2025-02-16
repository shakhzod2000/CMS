<?php

namespace App\Admin\Controller;

use App\Admin\Support\AuthService;

abstract class AbstractAdminController {

    public function __construct(protected AuthService $authService) {}
    
    protected function render($view, $params) {
        extract($params); //will assign str to var
    
        ob_start();
        require __DIR__ . '/../../../admin/' . $view . '.view.php';
        $contents = ob_get_clean();

        $isLoggedIn = $this->authService->isLoggedIn();
        
        require __DIR__ . '/../../../admin/main.view.php';
    }

    protected function error404() {
        http_response_code(404);
        $this->render('error404', []);
    }
}