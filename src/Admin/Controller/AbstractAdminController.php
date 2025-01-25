<?php

namespace App\Admin\Controller;

abstract class AbstractAdminController {
    public function __construct() {}
    
    protected function render($view, $params) {
        extract($params); //will assign str to var
    
        ob_start();
        require __DIR__ . '/../../../admin/' . $view . '.view.php';
        $contents = ob_get_clean();
        require __DIR__ . '/../../../admin/main.view.php';
    }

    protected function error404() {
        http_response_code(404);
        $this->render('error404', []);
    }
}