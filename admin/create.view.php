<h1>Create a page</h1>

<?php if (!empty($errors)): ?>
    <ul>
        <?php foreach($errors as $error): ?>
            <li><?php echo e($error);?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<form method="POST" action="index.php?route=admin/pages/create">
    <input type="hidden" name="_csrf" value="<?php echo e(csrf_token()); ?>" />
    <label for="title">Title:</label>
    <input type="text" 
        name="title"
        value="<?php if (!empty($_POST['title'])) echo e($_POST['title']);?>"
        id="title" />

    <label for="Slug">Slug:</label>
    <input type="text" 
        name="slug" 
        value="<?php if (!empty($_POST['slug'])) echo e($_POST['slug']);?>" 
        id="slug" />

    <label for="content">Content:</label>
    <textarea name="content" id="content"><?php 
        if (!empty($_POST['content'])) echo e($_POST['content']);
    ?></textarea>

    <input type="submit" value="Submit!" />
</form>