<?php
/**
 *
 * Template: Pagina de Inicio
 *
 */
?>

<?php $this->load->view('layout/header'); ?>

<?php $this->load->view('layout/primera-navegacion'); ?>

<div class="container">
	<?php if ($title != '') : ?>
    <h1><?php echo $title ?></h1>
	<?php endif; ?>
    <div class="span12 background-white shadow" style="min-height: 400px">
    <?php echo $content ?>
    </div>
<?php $this->load->view('layout/footer'); ?>