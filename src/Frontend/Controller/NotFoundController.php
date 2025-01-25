<?php

// namespaces are directories where we can use same class name
namespace App\Frontend\Controller;

class NotFoundController extends AbstractController {
    public function error404() {
        return parent::error404();
    }
}