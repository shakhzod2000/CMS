<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="./simple.css" />
        <link rel="stylesheet" type="text/css" href="./custom.css" />
        <title>CMS Project</title>
    </head>
    <body>
        <header>
            <h1>
                <a href="index.php">CMS Project</a>
            </h1>
            <p>A custom-made CMS system</p>
        <?php //var_dump($page);?>
        <nav>
            <?php foreach($navig as $navPage): ?>
                <a href="index.php?<?php echo http_build_query(['page' => $navPage->slug]);?>"
                    <?php if (!empty($page) && !empty($page->id) && $page instanceof App\Model\PageModel && $navPage->id === $page->id): ?>
                        class="active"
                    <?php endif; ?>
                >
                    <?php echo e($navPage->title);?>
                </a>
            <?php endforeach; ?>
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