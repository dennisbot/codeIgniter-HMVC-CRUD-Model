<?php
/**
 *
 * Footer Template
 *
 */
?>
	<hr>

	<footer class="row-fluid">
		
		<div class="span12">
			
			<p>&copy; <?php echo date("Y") . " " . $this->config->item('site_name') ?></p>
			
		</div>

	</footer>

	</div><!-- container -->
	
	<script src="<?php echo base_jquery();?>jquery-1.7.2.min.js"></script>
	<script src="<?php echo bootstrap_js(); ?>bootstrap.min.js"></script>
	
	<?php echo $_scripts ?>

	</body>
</html>