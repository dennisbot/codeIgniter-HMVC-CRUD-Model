<div class="padded form-agregar">
    <?php $this->load->view('dashboard/system_messages'); ?>
    <form class="form-horizontal" method="post" id="form-docente" action="<?php echo site_url($this->uri->uri_string()); ?>">
                <div class="control-group <?php echo form_error('paterno') != '' ? 'error' : '';?>">
            <label class="control-label"> paterno </label>
            <div class="controls">
                <input type="text" name="paterno" value="<?php echo $this->mdl_docente->form_value('paterno'); ?>" />
            </div>
        </div>
        <div class="control-group <?php echo form_error('materno') != '' ? 'error' : '';?>">
            <label class="control-label"> materno </label>
            <div class="controls">
                <input type="text" name="materno" value="<?php echo $this->mdl_docente->form_value('materno'); ?>" />
            </div>
        </div>
        <div class="control-group <?php echo form_error('nombres') != '' ? 'error' : '';?>">
            <label class="control-label"> nombres </label>
            <div class="controls">
                <input type="text" name="nombres" value="<?php echo $this->mdl_docente->form_value('nombres'); ?>" />
            </div>
        </div>
        <div class="control-group <?php echo form_error('dni') != '' ? 'error' : '';?>">
            <label class="control-label"> dni </label>
            <div class="controls">
                <input type="text" name="dni" value="<?php echo $this->mdl_docente->form_value('dni'); ?>" />
            </div>
        </div>
        <div class="control-group <?php echo form_error('telefono') != '' ? 'error' : '';?>">
            <label class="control-label"> telefono </label>
            <div class="controls">
                <input type="text" name="telefono" value="<?php echo $this->mdl_docente->form_value('telefono'); ?>" />
            </div>
        </div>
        <div class="control-group <?php echo form_error('direccion') != '' ? 'error' : '';?>">
            <label class="control-label"> direccion </label>
            <div class="controls">
                <input type="text" name="direccion" value="<?php echo $this->mdl_docente->form_value('direccion'); ?>" />
            </div>
        </div>
        <div class="control-group <?php echo form_error('tipo_docente') != '' ? 'error' : '';?>">
            <label class="control-label"> tipo_docente </label>
            <div class="controls">
                <input type="text" name="tipo_docente" value="<?php echo $this->mdl_docente->form_value('tipo_docente'); ?>" />
            </div>
        </div>
        <div class="control-group <?php echo form_error('email') != '' ? 'error' : '';?>">
            <label class="control-label"> email </label>
            <div class="controls">
                <input type="text" name="email" value="<?php echo $this->mdl_docente->form_value('email'); ?>" />
            </div>
        </div>
        <div class="control-group <?php echo form_error('sexo') != '' ? 'error' : '';?>">
            <label class="control-label"> sexo </label>
            <div class="controls">
                <input type="text" name="sexo" value="<?php echo $this->mdl_docente->form_value('sexo'); ?>" />
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
            <li><?php echo anchor('docente/index', '<i class=icon-list></i> Listado de docentes');?></li>
        </ul>
    </div>
</div><!-- padded -->
