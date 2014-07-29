<?php if (function_exists('validation_errors') && validation_errors()) { ?>
<div id="1box-errors" class="alert alert-warning">
	<button type="button" class="close" data-dismiss="alert">&times;</button>
	<span>Por favor corrija los siguientes campos:</span>
	<ul><?php echo validation_errors(); ?></ul>
</div>

<?php } ?>

<?php if ($this->session->flashdata('alert_success')) { ?>
<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button><strong><?php echo $this->session->flashdata('alert_success'); ?></strong></div>
<?php } ?>
<?php if ($this->session->flashdata('success_save')) { ?>
<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button><strong><?php echo $this->lang->line('this_item_has_been_saved'); ?></strong></div>
<?php } ?>

<?php if ($this->session->flashdata('success_delete')) { ?>
<div class="alert alert-block"><button type="button" class="close" data-dismiss="alert">&times;</button><strong><?php echo $this->lang->line('this_item_has_been_deleted'); ?></strong></div>
<?php } ?>

<?php if ($this->session->flashdata('custom_warning')) { ?>
<div class="alert alert-block"><button type="button" class="close" data-dismiss="alert">&times;</button><strong><?php echo $this->session->flashdata('custom_warning'); ?></strong></div>
<?php } ?>

<?php if ($this->session->flashdata('custom_error')) { ?>
<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button><strong><?php echo $this->session->flashdata('custom_error'); ?></strong></div>
<?php } ?>
<?php if ($this->session->flashdata('custom_success')) { ?>
<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert">&times;</button><strong><?php echo $this->session->flashdata('custom_success'); ?></strong></div>
<?php } ?>

<?php if (isset($static_error) and $static_error) { ?>
<div class="alert alert-error"><button type="button" class="close" data-dismiss="alert">&times;</button><strong><?php echo $static_error; ?></strong></div>
<?php } ?>