<?php $this->load->view('dashboard/btn_add', array('btn_value'=> 'agregar {entity}')); ?>
<div style="clear:both">
<?php $this->load->view('dashboard/system_messages'); ?>
</div>
<table class="table table-striped table-hover form-agregar" style="margin: 0px auto;">
	<tr>
		{headers}
	</tr>

	<?php foreach (${entity}s as ${entity}) { ?>
	<tr>
		<?php foreach (${entity} as $value) { ?>
		<td>
			<?php echo $value; ?>
		</td>
		<?php } ?>

		<td>
			<a href="<?php echo site_url('{entity}/form/{identity}/' . ${entity}->{identity}); ?>"
                title="<?php echo $this->lang->line('edit'); ?>"
            >
			<?php echo icon('edit'); ?>
			</a>
			<a href="<?php echo site_url('{entity}/delete/{identity}/' . ${entity}->{identity}); ?>"
                title="<?php echo $this->lang->line('delete'); ?>"
                class="delete-record"
            >
			<?php echo icon('delete'); ?>
			</a>
		</td>
	</tr>
	<?php } ?>
</table>
<?php if ($this->mdl_{entity}->page_links) { ?>
    <div id="loading" style="position: relative"></div>
        <ul class="pagination">
            <?php echo $this->mdl_{entity}->page_links; ?>
        </ul>
<?php } ?>