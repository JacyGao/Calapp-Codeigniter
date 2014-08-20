<form action="<?php echo current_url()?>" method="post">

    <?php if(isset($validation_error)): ?>

        <p>You need to address the following issues:</p>
        <p style="color:red;"><?php echo validation_errors(); ?></p>

    <?php endif; ?>

    <table>
        <tr>
            <td>Name: </td>
            <td><input type="text" name="name" value="<?php if(isset($edit)){echo $data->name;}?>"/></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit"/></td>
        </tr>
    </table>

</form>