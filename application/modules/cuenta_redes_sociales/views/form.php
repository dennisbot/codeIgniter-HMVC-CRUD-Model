<div class="padded form-agregar">
    <?php $this->load->view('dashboard/system_messages'); ?>
    <form class="form-horizontal" method="post" id="form-cuenta_redes_sociales" action="<?php echo site_url($this->uri->uri_string()); ?>">
        <dl>
            <input type="hidden" name="id" value="<?php echo $this->mdl_cuenta_redes_sociales->form_value('id'); ?>" />
        </dl>
        <div class="control-group <?php echo form_error('cuenta') != '' ? 'error' : '';?>">
            <label class="control-label">* cuenta </label>
            <div class="controls">
                <input type="text" name="cuenta" value="<?php echo $this->mdl_cuenta_redes_sociales->form_value('cuenta'); ?>" />
            </div>
        </div>
        <div class="control-group <?php echo form_error('usuario') != '' ? 'error' : '';?>">
            <label class="control-label">* usuario </label>
            <div class="controls">
                <input type="text" name="usuario" value="<?php echo $this->mdl_cuenta_redes_sociales->form_value('usuario'); ?>" />
            </div>
        </div>
        <div class="control-group <?php echo form_error('password') != '' ? 'error' : '';?>">
            <label class="control-label">* password </label>
            <div class="controls">
                <input type="text" name="password" value="<?php echo $this->mdl_cuenta_redes_sociales->form_value('password'); ?>" />
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
            <li><?php echo anchor('cuenta_redes_sociales/index', '<i class=icon-list></i> Listado de cuenta_redes_socialess');?></li>
        </ul>
    </div>
</div><!-- padded -->
