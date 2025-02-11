<?php

require __DIR__ . '/all.php';

$container = new App\Support\Container();
$container->bind('pdo', function() {
    return require __DIR__ . '/db-connect.php';
});

$container->bind('pagesRepository', function() use($container) {
    $pdo = $container->get('pdo');
    return new App\Repository\PagesRepository($pdo);
});

$container->bind('pagesController', function() use($container) {
    $pagesRepository = $container->get('pagesRepository');
    return new App\Frontend\Controller\PagesController($pagesRepository);
});

$container->bind('notFoundController', function() use($container) {
    $pagesRepository = $container->get('pagesRepository');
    return new App\Frontend\Controller\NotFoundController($pagesRepository);
});

$container->bind('pagesAdminController', function() use($container) {
    $pagesRepository = $container->get('pagesRepository');
    return new App\Admin\Controller\PagesAdminController($pagesRepository);
});

$route = @(string) ($_GET['route'] ?? 'pages');

if ($route === 'pages') {
    $page = @(string) ($_GET['page'] ?? 'index');
    
    $pagesController = $container->get('pagesController');
    $pagesController->showPage($page);
}
else if ($route === 'admin/pages') {
    $pagesAdminController = $container->get('pagesAdminController');
    $pagesAdminController->index();
}
else if ($route === 'admin/pages/create') {
    $pagesAdminController = $container->get('pagesAdminController');
    $pagesAdminController->create();
}
else if ($route === "admin/pages/delete") {
    //$id = @(int) ($_GET['id'] || 0);
    $pagesAdminController = $container->get('pagesAdminController');
    $pagesAdminController->delete();
}
else {
    $notFoundController = $container->get('notFoundController');
    $notFoundController->error404();
}