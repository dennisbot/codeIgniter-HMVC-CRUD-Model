<?php
/**
 *
 * Template: full width
 *
 */
?>

<?php $this->load->view('layout/header'); ?>

<?php $this->load->view('layout/navegacion'); ?>

<div class="container-fluid">
	
	<?php if ($title != '') : ?>
    	
    	<h1><?php echo $title ?></h1>

	<?php endif; ?>
    
    <div class="row-fluid">

		<div class="span12">

			<?php echo $content ?>

		</div>

    </div>

<?php $this->load->view('layout/footer'); ?>