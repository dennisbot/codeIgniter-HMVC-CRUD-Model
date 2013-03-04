<div class="padded form-agregar">
<?php $this->load->view('dashboard/system_messages'); ?>
<form class="form-horizontal" method="post" action="<?php echo site_url($this->uri->uri_string()); ?>">

	<dl>
                <input type="hidden" name="idguia" value="<?php echo $this->mdl_guia->form_value('idguia'); ?>" />
                </dl>
                <div class="control-group <?php echo form_error('tipo_documento') != '' ? 'error' : '';?>">
                	<label class="control-label">* tipo_documento </label>
                <div class="controls">
<select name="tipo_documento">

                                            <option>tipo_documento</option>

                               </select>

                </div>
                	</div>
                <div class="control-group <?php echo form_error('documento') != '' ? 'error' : '';?>">
                	<label class="control-label">* documento </label>
                <div class="controls">
<input type="text" name="documento" value="<?php echo $this->mdl_guia->form_value('documento'); ?>" />
                </div>
                	</div>
                <div class="control-group <?php echo form_error('nombres') != '' ? 'error' : '';?>">
                	<label class="control-label">* nombres </label>
                <div class="controls">
<input type="text" name="nombres" value="<?php echo $this->mdl_guia->form_value('nombres'); ?>" />
                </div>
                	</div>
                <div class="control-group <?php echo form_error('apellidos') != '' ? 'error' : '';?>">
                	<label class="control-label">* apellidos </label>
                <div class="controls">
<input type="text" name="apellidos" value="<?php echo $this->mdl_guia->form_value('apellidos'); ?>" />
                </div>
                	</div>
                <div class="control-group <?php echo form_error('telefono') != '' ? 'error' : '';?>">
                	<label class="control-label">* telefono </label>
                <div class="controls">
<input type="text" name="telefono" value="<?php echo $this->mdl_guia->form_value('telefono'); ?>" />
                </div>
                	</div>
                <div class="control-group <?php echo form_error('proveedor_idproveedor') != '' ? 'error' : '';?>">
                	<label class="control-label">* proveedor_idproveedor </label>
                <div class="controls">
<input type="text" name="proveedor_idproveedor" value="<?php echo $this->mdl_guia->form_value('proveedor_idproveedor'); ?>" />
                </div>
                	</div>

	<div class="control-group">
		<div class="controls">
			<input type="submit" class="btn btn-danger" name="btn_cancel" value="<?php echo $this->lang->line('cancel'); ?>" />
			<input type="submit" class="btn btn-success" name="btn_submit" value="<?php echo $this->lang->line('submit'); ?>" />
		</div>
	</div>
</form>
<div class="controles">
	<ul class="nav nav-list">
		<li><?php echo anchor('guia/index', '<i class=icon-list></i> Listado de guias');?></li>
	</ul>
</div>
</div><!-- padded -->
