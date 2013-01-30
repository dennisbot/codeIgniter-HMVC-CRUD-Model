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
    <h1><?php echo $title ?></h1>
    <?php echo $system_messages; ?>
    <div class="span12 background-white shadow">
    <?php echo $content ?>
    </div>
<?php $this->load->view('layout/footer'); ?>