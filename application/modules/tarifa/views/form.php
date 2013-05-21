<div class="padded form-agregar">
    <?php $this->load->view('dashboard/system_messages'); ?>
    <form class="form-horizontal" method="post" id="form-tarifa" action="<?php echo site_url($this->uri->uri_string()); ?>">
        <dl>
            <input type="hidden" name="idtarifa" value="<?php echo $this->mdl_tarifa->form_value('idtarifa'); ?>" />
        </dl>
        <div class="control-group <?php echo form_error('porcentaje') != '' ? 'error' : '';?>">
            <label class="control-label">* porcentaje </label>
            <div class="controls">
                <input type="text" name="porcentaje" value="<?php echo $this->mdl_tarifa->form_value('porcentaje'); ?>" />
            </div>
        </div>
        <div class="control-group <?php echo form_error('descripcion') != '' ? 'error' : '';?>">
            <label class="control-label">* descripcion </label>
            <div class="controls">
                <input type="text" name="descripcion" value="<?php echo $this->mdl_tarifa->form_value('descripcion'); ?>" />
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
            <li><?php echo anchor('tarifa/index', '<i class=icon-list></i> Listado de tarifas');?></li>
        </ul>
    </div>
</div><!-- padded -->
