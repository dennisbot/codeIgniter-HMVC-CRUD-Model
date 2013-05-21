<div class="padded form-agregar">
    <?php $this->load->view('dashboard/system_messages'); ?>
    <form class="form-horizontal" method="post" id="form-empleados" action="<?php echo site_url($this->uri->uri_string()); ?>">
        <dl>
            <input type="hidden" name="idempleado" value="<?php echo $this->mdl_empleados->form_value('idempleado'); ?>" />
        </dl>
        <div class="control-group <?php echo form_error('nombres') != '' ? 'error' : '';?>">
            <label class="control-label">* nombres </label>
            <div class="controls">
                <input type="text" name="nombres" value="<?php echo $this->mdl_empleados->form_value('nombres'); ?>" />
            </div>
        </div>
        <div class="control-group <?php echo form_error('departamento') != '' ? 'error' : '';?>">
            <label class="control-label">* departamento </label>
            <div class="controls">
                <input type="text" name="departamento" value="<?php echo $this->mdl_empleados->form_value('departamento'); ?>" />
            </div>
        </div>
        <div class="control-group <?php echo form_error('sueldo') != '' ? 'error' : '';?>">
            <label class="control-label">* sueldo </label>
            <div class="controls">
                <input type="text" name="sueldo" value="<?php echo $this->mdl_empleados->form_value('sueldo'); ?>" />
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
            <li><?php echo anchor('empleados/index', '<i class=icon-list></i> Listado de empleadoss');?></li>
        </ul>
    </div>
</div><!-- padded -->
