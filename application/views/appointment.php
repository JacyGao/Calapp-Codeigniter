<a href="/appointment/create">New Appointment</a> <a href="/admin">Back to Calendar</a>
<hr>

<table>

    <tr>
        <th>Title</th>
        <th>Location</th>
        <th>Start Date & Time</th>
        <th>End Date & Time</th>
        <th>Notes</th>
        <th>Action</th>
    </tr>
    <?php foreach($data as $d):?>
    <tr>
        <td><?php echo $d->title?></td>
        <td><?php echo $d->location?></td>
        <td><?php echo $d->start_date." ".$d->start_time?></td>
        <td><?php echo $d->end_date." ".$d->end_time?></td>
        <td><?php echo $d->note?></td>
        <td><a href="/appointment/update/<?php echo $d->id?>">Update</a> <a href="/appointment/delete/<?php echo $d->id?>">delete</a></td>
    </tr>
    <?php endforeach; ?>
</table>