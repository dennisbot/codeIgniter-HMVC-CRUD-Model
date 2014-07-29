<!DOCTYPE html>
<html lang="<?php echo $this->config->item('language_attributes') ?>" >
    <head>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,400,300,600' rel='stylesheet' type='text/css'>

        <meta charset="utf-8">

        <title><?php echo ($header_title) ? $header_title . " | " . $this->config->item('site_name') : "Proyecto | " . $this->config->item('site_name') ?></title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">

        <!-- Bootstrap -->
        <!-- <link rel="stylesheet" href="<?php echo base_css(); ?>normalize.css"> -->
        <!-- <link rel="stylesheet" href="<?php echo base_css(); ?>main.css"> -->
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>">
        <link rel="stylesheet" href="<?php echo font_awesome_css('font-awesome.min.css'); ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/fonts.css') ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/estilo.css') ?>">
        <link rel="stylesheet" href="<?php echo base_url('assets/css/template.css') ?>">
        <!-- <link rel="stylesheet" href="<?php echo base_css() ?>flat-ui.css"> -->
        <!-- Css -->
        <link rel="shortcut icon" href="<?php echo base_img(); ?>favicon.ico">

        <!-- Internal Css -->
        <?php echo $_styles ?>
        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
          <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    </head>
    <body>
    <div class="navbar navbar-inverse navbar-fixed-top navbar-qente">
        <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a href="<?php echo base_url("") ?>" class="navbar-brand">Administrar Sitio</a>
            </div>
            <div class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
                <li class="dropdown"><?php echo anchor('generador', '<i class="icon-screenshot icon-white"></i> Scaffolding Generator') ?></li>
                <li class="dropdown">
                  <?php echo anchor('#', '<i class="icon-check"></i> Listar Datos<b class="caret"></b>', 'class="dropdown-toggle" data-toggle="dropdown"'); ?>
                  <ul class="dropdown-menu nav nav-pills nav-stacked" role="menu">
                    <!-- <li class="divider"></li>
                    <li class="dropdown-header">etiqueta</li> -->
                    <li><?php echo anchor('#', '<i class="icon-file-alt"></i> Nuevo Dato') ?></li>
                    <li><?php echo anchor('#', '<i class="icon-calendar"></i> Nuevo Item'); ?></li>
                  </ul>
                </li>

              </ul>
              <ul class="nav navbar-nav pull-right">
                <li><a href="/" onclick="return false;"><i class="icon-user"></i> Usuario: <?php echo $this->session->userdata('Nombres') ?></a></li>
                <li class="dropdown">
                    <a href="/administrador/configuracion" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-cog"></i> Configuración <b class="caret"></b></a>
                    <ul class="dropdown-menu nav nav-pills nav-stacked">
                        <li><?php echo anchor('usuario/form/idusuario/' . $this->session->userdata('userId'), '<i class="icon-male"></i> Mis datos') ?></li>
                        <li><?php echo anchor('usuario/cambiar_clave', '<i class="icon-key"></i> Cambiar contraseña') ?></li>
                        <?php if ($this->session->userdata('tipo_usuario') == 'administrador'): ?>
                            <li><?php echo anchor('usuario/form', '<i class="icon-user"></i> Crear Usuario') ?></li>
                            <li><?php echo anchor('usuario', '<i class="icon-group"></i> Listado de Usuarios') ?></li>
                        <?php endif ?>
                        <li><?php echo anchor('logout', '<i class="icon-off"></i> Salir') ?></li>
                    </ul>
                </li>
              </ul>
            </div><!--/.navbar-collapse -->
        </div>
    </div>
    <div class="container container-qente">
        <div class="row" style="height: 100%; padding-bottom: 71px">
            <div class="col-sm-12<?php echo ($this->uri->uri_string() != "admin") ? ' marca' : '' ?> fondo-dashboard">
                <?php if ($title != '') : ?>
                    <h1><?php echo $title ?></h1>
                <?php endif; ?>
                <?php echo $content ?>
            </div>
            <footer class="row fondo-dashboard">
                <div class="col-sm-12">
                    <hr>
                    <p>&copy; <?php echo date("Y") . " - " . $this->config->item('site_name') ?></p>
                </div>
            </footer>
        </div>

    </div><!-- container -->

    <script>var base_url = '<?php echo base_url(); ?>';</script>
    <script src="<?php echo base_jquery('jquery-1.10.2.min.js');?>"></script>
    <script src="<?php echo bootstrap_js(); ?>bootstrap.min.js"></script>

    <?php echo $_scripts ?>

    </body>
</html>