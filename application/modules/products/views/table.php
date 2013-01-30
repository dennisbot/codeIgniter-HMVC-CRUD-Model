<table>
	<tr>
		<?php
                foreach ($table_headers as $key => $value) { ?>
                <th><?php echo $table_headers[$key]; ?></th>
                <?php } ?>
                <th><?php echo $this->lang->line('actions'); ?></th>

	</tr>
	
	<?php foreach ($productss as $products) { ?>
	<tr>
		<?php foreach ($products as $value) { ?>
		<td>
			<?php echo $value; ?>
		</td>
		<?php } ?>
	
		<td>
			<a href="<?php echo site_url('products/form/id/' . $products->id); ?>" title="<?php echo $this->lang->line('edit'); ?>">
			<?php echo icon('edit'); ?>
			</a>
			<a href="<?php echo site_url('products/delete/id/' . $products->id); ?>" title="<?php echo $this->lang->line('delete'); ?>" onclick="javascript:if(!confirm('<?php echo $this->lang->line('confirm_delete'); ?>')) return false">
			<?php echo icon('delete'); ?>
			</a>
		</td>
	</tr>
	<?php } ?>
</table>

<?php if ($this->mdl_products->page_links) { ?>
    <div id="pagination">
        <?php echo $this->mdl_products->page_links; ?>
    </div>
<?php } ?>