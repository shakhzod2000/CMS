<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="./simple.css" />
        <link rel="stylesheet" type="text/css" href="./admin.css" />
        <link rel="stylesheet" type="text/css" href="./custom.css" />
        <title>CMS Project</title>
    </head>
    <body>
        <header>
            <h1>
                <a href="index.php">CMS: Admin</a>
            </h1>
            <p>A custom-made CMS system</p>
        <?php //var_dump($page);?>
        <nav>
            <?php if ($isLoggedIn): ?>
                <a href="index.php?<?php echo http_build_query(['route' => 'admin/logout']); ?>">Logout</a>
            <?php endif; ?>
        </nav>
    </header>
    <main>
        <?php echo $contents; ?>
    </main>
    <footer>
        <p></p>
    </footer>
</body>
</html>