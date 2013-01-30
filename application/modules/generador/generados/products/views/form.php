<div class="padded">
<form method="post" action="<?php echo site_url($this->uri->uri_string()); ?>">

	<dl>
                <input type="hidden" name="id" value="<?php echo $this->mdl_products->form_value('id'); ?>" />
                </dl>
                <dl>
                	<dt><label>* name </label></dt>
                <dd>
<input type="text" name="name" value="<?php echo $this->mdl_products->form_value('name'); ?>" />
                </dd>
                	</dl>
                <dl>
                	<dt><label>* shortdesc </label></dt>
                <dd>
<input type="text" name="shortdesc" value="<?php echo $this->mdl_products->form_value('shortdesc'); ?>" />
                </dd>
                	</dl>
                <dl>
                	<dt><label>* longdesc </label></dt>
                <dd>
<textarea cols="26" rows="8" name="longdesc" id="longdesc"><?php echo $this->mdl_products->form_value('longdesc'); ?></textarea>
                </dd>
                	</dl>
                <dl>
                	<dt><label>* thumbnail </label></dt>
                <dd>
<input type="text" name="thumbnail" value="<?php echo $this->mdl_products->form_value('thumbnail'); ?>" />
                </dd>
                	</dl>
                <dl>
                	<dt><label>* image </label></dt>
                <dd>
<input type="text" name="image" value="<?php echo $this->mdl_products->form_value('image'); ?>" />
                </dd>
                	</dl>
                <dl>
                	<dt><label>* grouping </label></dt>
                <dd>
<input type="text" name="grouping" value="<?php echo $this->mdl_products->form_value('grouping'); ?>" />
                </dd>
                	</dl>
                <dl>
                	<dt><label>* status </label></dt>
                <dd>
<select name="status">

                                            <option>status</option>

                               </select>

                </dd>
                	</dl>
                <dl>
                	<dt><label>* category_id </label></dt>
                <dd>
<input type="text" name="category_id" value="<?php echo $this->mdl_products->form_value('category_id'); ?>" />
                </dd>
                	</dl>
                <dl>
                	<dt><label>* featured </label></dt>
                <dd>
<select name="featured">

                                            <option>featured</option>

                               </select>

                </dd>
                	</dl>
                <dl>
                	<dt><label>* price </label></dt>
                <dd>
<input type="text" name="price" value="<?php echo $this->mdl_products->form_value('price'); ?>" />
                </dd>
                	</dl>


	<?php foreach ($custom_fields as $custom_field) { ?>
	<dl>
		<dt>
			<label><?php echo $custom_field->field_name; ?>: </label>
		</dt>
		<dd>
			<input type="text" name="<?php echo $custom_field->column_name; ?>"
				id="<?php echo $custom_field->column_name; ?>"
				value="<?php echo $this->mdl_empleado->form_value($custom_field->column_name); ?>" />
		</dd>
	</dl>
	<?php } ?>

	<input type="submit" id="btn_cancel" class="btn btn-danger" name="btn_cancel" value="<?php echo $this->lang->line('cancel'); ?>" />
	<input type="submit" id="btn_submit" class="btn btn-success" name="btn_submit" value="<?php echo $this->lang->line('submit'); ?>" />

</form>
</div><!-- padded -->

<div class="controles">
	<ul class="nav nav-list">
		<li><?php echo anchor('products/index', '<i class=icon-list></i> Listado de productss');?></li>
	</ul>
</div>