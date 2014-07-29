<?php $this->load->view('dashboard/btn_add', array('btn_value'=> 'agregar tcliente')); ?>
<div style="clear:both">
<?php $this->load->view('dashboard/system_messages'); ?>
</div>
<table class="table table-striped table-hover form-agregar" style="margin: 0px auto;">
	<tr>
		<?php
                foreach ($table_headers as $key => $value) { ?>
                <th><?php echo $table_headers[$key]; ?></th>
                <?php } ?>
                <th><?php echo $this->lang->line('actions'); ?></th>

	</tr>

	<?php foreach ($tclientes as $tcliente) { ?>
	<tr>
		<?php foreach ($tcliente as $value) { ?>
		<td>
			<?php echo $value; ?>
		</td>
		<?php } ?>

		<td>
			<a href="<?php echo site_url('tcliente/form/CodCliente/' . $tcliente->CodCliente); ?>"
                title="<?php echo $this->lang->line('edit'); ?>"
            >
			<?php echo icon('edit'); ?>
			</a>
			<a href="<?php echo site_url('tcliente/delete/CodCliente/' . $tcliente->CodCliente); ?>"
                title="<?php echo $this->lang->line('delete'); ?>"
                class="delete-record"
            >
			<?php echo icon('delete'); ?>
			</a>
		</td>
	</tr>
	<?php } ?>
</table>
<?php if ($this->mdl_tcliente->page_links) { ?>
    <div id="loading" style="position: relative"></div>
        <ul class="pagination">
            <?php echo $this->mdl_tcliente->page_links; ?>
        </ul>
<?php } ?>