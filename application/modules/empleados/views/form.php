<div class="padded" style="margin: 15px auto;width: 50%;padding: 10px;border: 1px solid #50AAC2;text-align: center;">
<form method="post" action="<?php echo site_url($this->uri->uri_string()); ?>">

	<dl>
                <input type="hidden" name="idempleado" value="<?php echo $this->mdl_empleados->form_value('idempleado'); ?>" />
                </dl>
                <dl>
                	<dt><label>* nombres </label></dt>
                <dd>
<input type="text" name="nombres" value="<?php echo $this->mdl_empleados->form_value('nombres'); ?>" />
                </dd>
                	</dl>
                <dl>
                	<dt><label>* departamento </label></dt>
                <dd>
<input type="text" name="departamento" value="<?php echo $this->mdl_empleados->form_value('departamento'); ?>" />
                </dd>
                	</dl>
                <dl>
                	<dt><label>* sueldo </label></dt>
                <dd>
<input type="text" name="sueldo" value="<?php echo $this->mdl_empleados->form_value('sueldo'); ?>" />
                </dd>
                	</dl>

	<input type="submit" id="btn_cancel" class="btn btn-danger" name="btn_cancel" value="<?php echo $this->lang->line('cancel'); ?>" />
	<input type="submit" id="btn_submit" class="btn btn-success" name="btn_submit" value="<?php echo $this->lang->line('submit'); ?>" />

</form>
<div class="controles">
	<ul class="nav nav-list">
		<li><?php echo anchor('empleados/index', '<i class=icon-list></i> Listado de empleadoss');?></li>
	</ul>
</div>
</div><!-- padded -->
