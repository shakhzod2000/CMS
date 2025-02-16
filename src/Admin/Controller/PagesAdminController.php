<?php

namespace App\Admin\Controller;
// use specifies file and namespace directory
use App\Repository\PagesRepository;

use App\Admin\Support\AuthService;

class PagesAdminController extends AbstractAdminController {
    public function __construct(
        AuthService $authService,
        private PagesRepository $pagesRepository
        ) {
            parent::__construct($authService);
        }

    public function index() {
        $page = $this->pagesRepository->get();
        $this->render('index', [
            'page' => $page
        ]);
    }

    public function create() {
        $errors = [];

        if (!empty($_POST)) {
            $title = @(string) ($_POST['title'] ?? '');
            $slug = @(string) ($_POST['slug'] ?? '');
            $content = @(string) ($_POST['content'] ?? '');

            $slug = strtolower($slug);
            $slug = str_replace(['/', ' ', '.', '&'], ['-', '-', '-', '-'], $slug);
            $slug = preg_replace('/[^a-z0-9\-]/', '', $slug);

            if (!empty($title) and !empty($slug) and !empty($content)) {
                $slugExists = $this->pagesRepository->slugExists($slug);
                if (empty($slugExists)) {
                    $this->pagesRepository->insert($title, $slug, $content);
                    header('Location: index.php?route=admin/pages');
                    return;
                }
                else {
                    $errors[] = 'Slug already exists';
                }
            }
            else {
                $errors[] = 'Are all fields filled out?';
            }
        }

        
        $this->render('create', [
            'errors' => $errors
        ]);
    }

    public function delete() {
        $id = @(int) ($_POST['id'] ?? 0);
        $this->pagesRepository->delete($id);
        header('Location: index.php?route=admin/pages');
    }
    
    public function edit() {
        $errors = [];
        $id = @(int) ($_GET['id'] ?? 0);
        
        //var_dump($_POST);
        if (!empty($_POST)) {
            // var_dump($title);
            // var_dump($content);
            $title = @(string) ($_POST['title'] ?? '');
            $content = @(string) ($_POST['content'] ?? '');

            if (!empty($title) and !empty($content)) {
                $this->pagesRepository->edit($id, $title, $content);
                header('Location: index.php?route=admin/pages');
                return;
            }
            else $errors[] = 'Please fill out all fields';
        }
        
        $page = $this->pagesRepository->fetchById($id);
        $this->render('edit', [
            'page' => $page,
            'errors' => $errors
        ]);
    }

    function login() {
        
    }
}