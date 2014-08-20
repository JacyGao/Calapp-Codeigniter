<a href="admin/create">New Calendar</a>
<hr>
<table>
    <tr>
        <th>Name</th>
        <th>Actions</th>
    </tr>
    <?php foreach($data as $d):?>
    <tr>
        <td><?php echo $d->name?></td>
        <td><a href="admin/view/<?php echo $d->id?>">View</a> <a href="admin/update/<?php echo $d->id?>">Edit</a> <a href="admin/delete/<?php echo $d->id?>">Delete</a></td>
    </tr>
    <?php endforeach ?>
</table>