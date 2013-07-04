<form action="<?php echo current_url();?>" method="post" class="form-horizontal">
    <div class="control-group">
        <label for="table" class="control-label">MySQL Table</label>
        <div class="controls">
        <?php
            echo form_dropdown('table', $table);
        ?>
        </div>
    </div>
    <div class="control group">
        <div class="controls">
            <input type="submit" name="table_data" value="Get Table Data" class="btn"/>
        </div>
    </div>
</form>
<?php
if(isset($alias)) {
?>
<form action="<?php echo current_url();?>" method="post" class="form-horizontal">
<input type="hidden" name="table" value="<?php echo $table ?>" />
<div class="control-group">
    <label for="controller" class="control-label">Controller Name:</label>
    <div class="controls">
        <input type="text" name="controller" value="<?php echo $table_name ?>" />
    </div>
</div>
<div class="control-group">
    <label for="view" class="control-label">View Name:</label>
    <div class="controls">
        <input type="text" name="view" value="<?php echo $table_name ?>" />
    </div>
</div>
<div class="control-group">
    <label for="" class="control-label">Validation Name:</label>
    <div class="controls">
        <input type="text" name="validation" value="<?php echo $table_name ?>" />
    </div>
</div>
<div class="control-group">
    <div class="controls">
        <input type="submit" name="generate" value="Generate!" class="btn" />
    </div>
</div>

<h3>Table Data</h3>
    <?php

    $type = array(
                'exclude'  =>'Do not include',
                'text' => 'text input',
                'password' => 'password',
                'textarea' => 'textarea' ,
                'dropdown' => 'dropdown'
            );


    $sel = '';
    foreach ($alias as $a) :
		// if ($a->Key == 'PRI' || $a->Key == 'MUL') {
        if ($a->Key == 'PRI') {
            echo form_hidden('primaryKey', $a->Field);
            continue;
        }
         $email_default = FALSE;

        if(strpos($a->Type,'enum') !== false){
            echo ' <br>Enum Values (CSV): <input size="50" type="text" value="'.htmlspecialchars ("'0'=>'Value','1'=>'Another Value'").'" name="'.$a->Field.'default">';
            $sel = 'dropdown';
        }elseif(strpos($a->Type,'blob') !== false || strpos($a->Type,'text') !== false) {
            $sel = 'textarea';
        }else if(strpos($a->Field,'password') !== false) {
            $sel = 'password';
        }else if(strpos($a->Field,'email') !== false) {
            $email_default = TRUE;
        }else{
             $sel = 'text';
        }
        if ($sel == 'exclude') continue;
    ?>
    <div class="control-group">
        <label class="control-label">Field:</label>
        <div class="controls"><?php echo $a->Field ?></div>
    </div>
    <div class="control-group">
        <label for="" class="control-label">Label:</label>
        <div class="controls">
            <?php echo form_input('field['.$a->Field.']', $a->Field).' '.$a->Type; ?>
        </div>
    </div>
    <div class="control-group">
        <label for="" class="control-label">Type:</label>
        <div class="controls">
            <?php
                echo form_dropdown('type['.$a->Field.']', $type, $sel);
                echo '<br>';
                echo '<label class="checkbox inline">' . form_checkbox('rules['.$a->Field.'][]', 'required', $a->Null == 'NO') . ' required :: </label>';
                echo '<label class="checkbox inline">' . form_checkbox('rules['.$a->Field.'][]', 'trim', TRUE) . ' trim :: </label> ';
                echo '<label class="checkbox inline">' . form_checkbox('rules['.$a->Field.'][]', 'valid_email', $email_default) . ' email :: </label> ';
                echo '<label class="checkbox inline">' . form_checkbox('rules['.$a->Field.'][]', 'xss_clean', TRUE) . ' xss_clean :: </label>';
            ?>
        </div>
    </div>

<?php endforeach; ?>
</form>
<?php
}
?>