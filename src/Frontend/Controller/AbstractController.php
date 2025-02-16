<?php

namespace App\Frontend\Controller;

abstract class AbstractController {
    public function __construct(protected $pagesRepository) {}
    
    protected function render($view, $params) {
        extract($params); //will assign str to var
    
        ob_start();
        require __DIR__ . '/../../../frontend/' . $view . '.view.php';
        $contents = ob_get_clean();
        $navig = $this->pagesRepository->fetchForNavig();
        require __DIR__ . '/../../../frontend/main.view.php';
    }

    protected function error404() {
        http_response_code(404);
        $this->render('error404', []);
    }
}