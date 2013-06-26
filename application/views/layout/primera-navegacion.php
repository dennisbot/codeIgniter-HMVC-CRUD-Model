<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>

			<?php echo anchor('', '<i class="icon-home icon-white"></i> ' . $this->config->item('site_name'), array('class' => 'brand')) ?>
			<div class="nav-collapse collapse">

				<ul class="nav">
					<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-book icon-white"></i> Entidad<b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="#"><i class="icon-th-list"></i> Listar Datos</a></li>
								<li class="divider"></li>
								<li class="nav-header">Gestion</li>
								<li><a href="#"><i class="icon-plus"></i> Nuevo Dato</a></li>
							</ul>
					</li>
				</ul>

				<ul class="nav pull-right">
					<?php if (!$this->milib->logueado()) : ?>
						<li><?php echo anchor('user/cuenta', '<i class="icon-cog"></i> Configuraci&oacute;n'); ?></li>
						<li><?php echo anchor("user/logout", "<i class='icon-off'></i> Salir"); ?></li>
					<?php endif ?>
				</ul>
			</div><!--/.nav-collapse -->
		</div>
	</div>
</div>