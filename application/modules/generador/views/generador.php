<form action="<?php echo current_url();?>" method="post">
<p>MySQL Table
<?php
echo form_dropdown('table', $table);
?>
<input type="submit" name="table_data" value="Get Table Data" /></p>
</form>
<?php
if(isset($alias)) {
?>
<form action="<?php echo current_url();?>" method="post">
<input type="hidden" name="table" value="<?php echo $table ?>" />
<table>
<tr>
    <td>
        <p>Controller Name: <input type="text" name="controller" value="<?php echo $table_name ?>" />
        View Name: <input type="text" name="view" value="<?php echo $table_name ?>" />
        Validation Name: <input type="text" name="validation" value="<?php echo $table_name ?>" />
         <input type="submit" name="generate" value="Generate" /></p>
    </td>
</tr>
<tr>
    <td>
    <h3>Table Data</h3>
    <?php
    //p($alias);

    $type = array(
                'exclude'  =>'Do not include',
                'text' => 'text input',
                'password' => 'password',
                'textarea' => 'textarea' ,
                'dropdown' => 'dropdown'
                );


   $sel = '';
    if(isset($alias)){
        foreach($alias as $a){
             $email_default = FALSE;



            if(strpos($a->Type,'enum') !== false){
                echo ' <br>Enum Values (CSV): <input size="50" type="text" value="'.htmlspecialchars ("'0'=>'Value','1'=>'Another Value'").'" name="'.$a->Field.'default">';
                $sel = 'dropdown';
            }elseif(strpos($a->Type,'blob') !== false || strpos($a->Type,'text') !== false){
                $sel = 'textarea';
            }else if($a->Key == 'PRI' || $a->Key == 'MUL'){
                $sel = 'exclude';
                echo form_hidden('primaryKey', $a->Field);
            }else if(strpos($a->Field,'password') !== false) {
                $sel = 'password';
            }else if(strpos($a->Field,'email') !== false) {
                $email_default = TRUE;
            }else{
                 $sel = 'text';
            }
            if ($sel == 'exclude') continue;

            echo '<p> Field: '.$a->Field.'<br>Label:'.form_input('field['.$a->Field.']', $a->Field).' '.$a->Type;
            echo '<br> Type::'.form_dropdown('type['.$a->Field.']', $type,$sel);

            echo '<br>';
            echo form_checkbox('rules['.$a->Field.'][]', 'required', $a->Null == 'NO') . ' required :: ';
            echo form_checkbox('rules['.$a->Field.'][]', 'trim', TRUE) . ' trim :: ';
            echo form_checkbox('rules['.$a->Field.'][]', 'valid_email', $email_default) . ' email :: ';
            echo form_checkbox('rules['.$a->Field.'][]', 'xss_clean', TRUE) . ' xss_clean ::';
            //echo ':: custom rule '. form_input('rules['.$a->Field.'][]', '');
            echo '</p>';

        }
    }
    ?>
    </td>
</tr>
</table>

</form>
<?php
}
?>