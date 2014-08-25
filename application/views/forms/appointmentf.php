<?php if(isset($validation_error)): ?>

    <p>You need to address the following issues:</p>
    <?php echo validation_errors(); ?>

<?php endif; ?>

<form action="<?php echo current_url()?>" method="post">

    <table>
        <tr>
            <td>Title: </td>
            <td><input type="text" name="title" value="<?php echo (isset($edit)) ? set_value('title', $data->title) : set_value('title'); ?>"/></td>
        </tr>
        <tr>
            <td>Location: </td>
            <td><input type="text" name="location" value="<?php echo (isset($edit)) ? set_value('location', $data->location) : set_value('location'); ?>"/></td>
        </tr>
        <tr>
            <td>Start Date: </td>
            <td><input type="date" name="start_date" value="<?php echo (isset($edit)) ? set_value('start_date', $data->start_date) : set_value('start_date'); ?>"/></td>
        </tr>
        <tr>
            <td>Start Time: </td>
            <td><input type="time" name="start_time" value="<?php echo (isset($edit)) ? set_value('start_time', $data->start_time) : set_value('start_time'); ?>"/></td>
        </tr>
        <tr>
            <td>End Date: </td>
            <td><input type="date" name="end_date" value="<?php echo (isset($edit)) ? set_value('end_date', $data->end_date) : set_value('end_date'); ?>"/></td>
        </tr>
        <tr>
            <td>End Time: </td>
            <td><input type="time" name="end_time" value="<?php echo (isset($edit)) ? set_value('end_time', $data->end_time) : set_value('end_time'); ?>"/></td>
        </tr>
        <tr>
            <td>Note: </td>
            <td><textarea name="note"><?php echo (isset($edit)) ? set_value('note', $data->note) : set_value('note'); ?></textarea></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit"/></td>
        </tr>
    </table>

</form>