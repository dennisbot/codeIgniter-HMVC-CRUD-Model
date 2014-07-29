<div class="padded form-agregar">
    <?php $this->load->view('dashboard/system_messages'); ?>
    <form class="form-horizontal" role="form" method="post" action="<?php echo site_url($this->uri->uri_string()); ?>">

        {fields_form}

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
            <li><?php echo anchor('{entity}/index', '<i class=icon-list></i> Listado de {entity}s');?></li>
        </ul>
    </div>
</div><!-- padded -->
