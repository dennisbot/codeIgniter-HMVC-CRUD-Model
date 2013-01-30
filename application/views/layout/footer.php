<?php
/**
 *
 * Footer Template
 *
 */
?>
		<hr>
		<footer>
                    <p style="text-align: center">&copy;<?php echo date("Y") . " " . $this->config->item('site_name') ?></p>
		</footer>

    </div><!-- /end .container -->
    <script src="<?php echo base_jquery();?>jquery-1.7.2.min.js"></script>
    <script src="<?php echo bootstrap_js(); ?>bootstrap.min.js"></script>
	<?php echo $_scripts ?>
  </body>
</html>