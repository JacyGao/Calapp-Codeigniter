<form action="<?php echo current_url()?>" method="post">

    <?php if(isset($validation_error)): ?>

        <p>You need to address the following issues:</p>
        <?php echo validation_errors(); ?>

    <?php endif; ?>

    <table>
        <tr>
            <td>Title: </td>
            <td><input type="text" name="title" value="<?php if(isset($edit)){echo $data->title;}?>"/></td>
        </tr>
        <tr>
            <td>Location: </td>
            <td><input type="text" name="location" value="<?php if(isset($edit)){echo $data->location;}?>"/></td>
        </tr>
        <tr>
            <td>Start Date: </td>
            <td><input type="date" name="start_date" value="<?php if(isset($edit)){echo $data->start_date;}?>"/></td>
        </tr>
        <tr>
            <td>Start Time: </td>
            <td><input type="time" name="start_time" value="<?php if(isset($edit)){echo $data->start_time;}?>"/></td>
        </tr>
        <tr>
            <td>End Date: </td>
            <td><input type="date" name="end_date" value="<?php if(isset($edit)){echo $data->end_date;}?>"/></td>
        </tr>
        <tr>
            <td>End Time: </td>
            <td><input type="time" name="end_time" value="<?php if(isset($edit)){echo $data->end_time;}?>"/></td>
        </tr>
        <tr>
            <td>Note: </td>
            <td><textarea name="note"><?php if(isset($edit)){echo $data->note;}?></textarea></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit"/></td>
        </tr>
    </table>

</form>