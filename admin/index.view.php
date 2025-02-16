<h1>Admin: Manage Pages</h1>
<?php //var_dump($_POST);?>
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
                    <a href="index.php?<?php 
                        echo http_build_query(['route' => 'admin/pages/edit', 'id' => $object->id]);
                    ?>">Edit</a>
                    
                    <form style="display: inline;" method="POST" action="index.php?<?php 
                        echo http_build_query(['route' => 'admin/pages/delete']);?>">
                        <input type="hidden" name="_csrf" value="<?php echo e(csrf_token());?>" />
                        <input type="hidden" name="id" value="<?php echo e($object->id);?>" />
                        <input type="submit" value="Delete" class="btn-link" />
                    </form>
                </td>
            </tr>
            <?php endforeach; ?>
    </tbody>
</table>

<a href="index.php?route=admin/pages/create">Create page</a>