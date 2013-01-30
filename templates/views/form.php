<div class="padded" style="margin: 15px auto;width: 50%;padding: 10px;border: 1px solid #50AAC2;text-align: center;">
<form method="post" action="<?php echo site_url($this->uri->uri_string()); ?>">

	{fields_form}
	<input type="submit" id="btn_cancel" class="btn btn-danger" name="btn_cancel" value="<?php echo $this->lang->line('cancel'); ?>" />
	<input type="submit" id="btn_submit" class="btn btn-success" name="btn_submit" value="<?php echo $this->lang->line('submit'); ?>" />

</form>
<div class="controles">
	<ul class="nav nav-list">
		<li><?php echo anchor('{entity}/index', '<i class=icon-list></i> Listado de {entity}s');?></li>
	</ul>
</div>
</div><!-- padded -->
