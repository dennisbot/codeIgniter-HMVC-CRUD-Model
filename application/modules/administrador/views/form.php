<div class="padded form-agregar">
    <?php $this->load->view('dashboard/system_messages'); ?>
    <form class="form-horizontal" method="post" action="<?php echo site_url($this->uri->uri_string()); ?>">
        <dl>
            <input type="hidden" name="idadministrador" value="<?php echo $this->mdl_administrador->form_value('idadministrador'); ?>" />
        </dl>
        <div class="control-group <?php echo form_error('nombre') != '' ? 'error' : '';?>">
            <label class="control-label">* nombre </label>
            <div class="controls">
                <input type="text" name="nombre" value="<?php echo $this->mdl_administrador->form_value('nombre'); ?>" />
            </div>
        </div>
        <div class="control-group <?php echo form_error('apellidos') != '' ? 'error' : '';?>">
            <label class="control-label">* apellidos </label>
            <div class="controls">
                <input type="text" name="apellidos" value="<?php echo $this->mdl_administrador->form_value('apellidos'); ?>" />
            </div>
        </div>
        <div class="control-group <?php echo form_error('email') != '' ? 'error' : '';?>">
            <label class="control-label">* email </label>
            <div class="controls">
                <input type="text" name="email" value="<?php echo $this->mdl_administrador->form_value('email'); ?>" />
            </div>
        </div>
        <div class="control-group <?php echo form_error('clave') != '' ? 'error' : '';?>">
            <label class="control-label">* clave </label>
            <div class="controls">
                <input type="text" name="clave" value="<?php echo $this->mdl_administrador->form_value('clave'); ?>" />
            </div>
        </div>
        <div class="control-group <?php echo form_error('status') != '' ? 'error' : '';?>">
            <label class="control-label">* status </label>
            <div class="controls">
                <input type="text" name="status" value="<?php echo $this->mdl_administrador->form_value('status'); ?>" />
            </div>
        </div>
        <div class="control-group <?php echo form_error('created_at') != '' ? 'error' : '';?>">
            <label class="control-label">* created_at </label>
            <div class="controls">
                <input type="text" name="created_at" value="<?php echo $this->mdl_administrador->form_value('created_at'); ?>" />
            </div>
        </div>
        <div class="control-group <?php echo form_error('es_super') != '' ? 'error' : '';?>">
            <label class="control-label">* es_super </label>
            <div class="controls">
                <input type="text" name="es_super" value="<?php echo $this->mdl_administrador->form_value('es_super'); ?>" />
            </div>
        </div>
        <div class="control-group <?php echo form_error('id_admin') != '' ? 'error' : '';?>">
            <label class="control-label">* id_admin </label>
            <div class="controls">
                <input type="text" name="id_admin" value="<?php echo $this->mdl_administrador->form_value('id_admin'); ?>" />
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
            <li><?php echo anchor('administrador/index', '<i class=icon-list></i> Listado de administradors');?></li>
        </ul>
    </div>
</div><!-- padded -->
