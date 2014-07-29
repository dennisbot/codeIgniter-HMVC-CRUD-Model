<div class="padded form-agregar">
    <?php $this->load->view('dashboard/system_messages'); ?>
    <form class="form-horizontal" role="form" method="post" action="<?php echo site_url($this->uri->uri_string()); ?>">

                <div class="form-group <?php echo form_error('Nombres') != '' ? 'has-error has-feedback' : '';?>">
            <label class="col-sm-3 control-label" for="Nombres">* Nombres </label>
            <div class="col-sm-9">
                <input type="text" name="Nombres" id="Nombres" class="form-control" value="<?php echo $this->mdl_tcliente->form_value('Nombres'); ?>" />            <?php if (form_error('Nombres') != ''): ?>

                    <span class="glyphicon glyphicon-remove form-control-feedback"></span>

                <?php endif ?>
            </div>
        </div>
        <div class="form-group <?php echo form_error('Direccion') != '' ? 'has-error has-feedback' : '';?>">
            <label class="col-sm-3 control-label" for="Direccion"> Direccion </label>
            <div class="col-sm-9">
                <input type="text" name="Direccion" id="Direccion" class="form-control" value="<?php echo $this->mdl_tcliente->form_value('Direccion'); ?>" />            <?php if (form_error('Direccion') != ''): ?>

                    <span class="glyphicon glyphicon-remove form-control-feedback"></span>

                <?php endif ?>
            </div>
        </div>
        <div class="form-group <?php echo form_error('RUC') != '' ? 'has-error has-feedback' : '';?>">
            <label class="col-sm-3 control-label" for="RUC">* RUC </label>
            <div class="col-sm-9">
                <input type="text" name="RUC" id="RUC" class="form-control" value="<?php echo $this->mdl_tcliente->form_value('RUC'); ?>" />            <?php if (form_error('RUC') != ''): ?>

                    <span class="glyphicon glyphicon-remove form-control-feedback"></span>

                <?php endif ?>
            </div>
        </div>


        <div class="form-group">
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-offset-4 col-sm-4">
                        <input type="submit" class="btn btn-danger form-control" name="btn_cancel" value="<?php echo $this->lang->line('cancel'); ?>" />
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-offset-4 col-sm-4">
                        <input type="submit" class="btn btn-success form-control" name="btn_submit" value="<?php echo $this->lang->line('submit'); ?>" />
                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="controles">
        <ul class="nav nav-list">
            <li><?php echo anchor('tcliente/index', '<i class=icon-list></i> Listado de tclientes');?></li>
        </ul>
    </div>
</div><!-- padded -->
