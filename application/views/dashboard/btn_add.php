<form method="post" action="<?php echo site_url($this->uri->uri_string()); ?>">
<input type="submit" name="<?php if (isset($btn_name)) { echo $btn_name; } else { ?>btn_add<?php } ?>" class="btn btn-info" value="<?php if (isset($btn_value)) { echo $btn_value; } else { echo $this->lang->line('add'); } ?>" />
</form>