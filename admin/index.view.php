<h1>Admin: Manage Pages</h1>
<?php //var_dump($page);?>
<table style="min-width: 100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Slug</th>
            <th>Content</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($page as $object): ?>
            <tr>
                <td><?php echo e($object->id); ?></td>
                <td><?php echo e($object->title); ?></td>
                <td><?php echo e($object->slug); ?></td>
                <td><?php echo e($object->content); ?></td>
                <td>
                    <form method="POST" action="index.php?<?php 
                        echo http_build_query(['route' => 'admin/pages/delete']);?>">
                        <input type="hidden" name="id" value="<?php echo e($object->id);?>" />
                        <input type="submit" value="Delete" />
                    </form>
                    <!-- <a href="index.php?<?php //echo http_build_query(
                        // ['route' => 'admin/pages/delete', 'id' => $object->id]);?>"
                    >Delete</a> -->
                </td>
            </tr>
            <?php endforeach; ?>
    </tbody>
</table>

<a href="index.php?route=admin/pages/create">Create page</a>