<div class="padded form-agregar">
    <?php $this->load->view('dashboard/system_messages'); ?>
    <form class="form-horizontal" method="post" id="form-servicio" action="<?php echo site_url($this->uri->uri_string()); ?>">
        <dl>
            <input type="hidden" name="idproveedor" value="<?php echo $this->mdl_servicio->form_value('idproveedor'); ?>" />
        </dl>
        <div class="control-group <?php echo form_error('nombre') != '' ? 'error' : '';?>">
            <label class="control-label">* nombre </label>
            <div class="controls">
                <input type="text" name="nombre" value="<?php echo $this->mdl_servicio->form_value('nombre'); ?>" />
            </div>
        </div>
        <div class="control-group <?php echo form_error('costo_confidencial') != '' ? 'error' : '';?>">
            <label class="control-label">* costo_confidencial </label>
            <div class="controls">
                <input type="text" name="costo_confidencial" value="<?php echo $this->mdl_servicio->form_value('costo_confidencial'); ?>" />
            </div>
        </div>
        <div class="control-group <?php echo form_error('costo_base') != '' ? 'error' : '';?>">
            <label class="control-label">* costo_base </label>
            <div class="controls">
                <input type="text" name="costo_base" value="<?php echo $this->mdl_servicio->form_value('costo_base'); ?>" />
            </div>
        </div>
        <div class="control-group <?php echo form_error('indicador_costo') != '' ? 'error' : '';?>">
            <label class="control-label">* indicador_costo </label>
            <div class="controls">
                <input type="text" name="indicador_costo" value="<?php echo $this->mdl_servicio->form_value('indicador_costo'); ?>" />
            </div>
        </div>
        <div class="control-group <?php echo form_error('status') != '' ? 'error' : '';?>">
            <label class="control-label">* status </label>
            <div class="controls">
                <select name="status">

                                            <option>status</option>

                               </select>

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
            <li><?php echo anchor('servicio/index', '<i class=icon-list></i> Listado de servicios');?></li>
        </ul>
    </div>
</div><!-- padded -->
