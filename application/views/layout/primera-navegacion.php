<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="navbar-inner">
        <div class="container">
            <a class="btn btn-navbar" data-toggle="collapse"
               data-target=".nav-collapse"> <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

            <?php echo anchor('', '<i class="icon-home icon-white"></i> ' . $this->config->item('site_name'), array('class' => 'brand')) ?>
            <div class="nav-collapse collapse">

                <ul class="nav">
                    <li class="dropdown">
                        <?php echo anchor('#', '<i class="icon-calendar icon-white"></i> Eventos <b class="caret"></b>', array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown')) ?>
                        <ul class="dropdown-menu">
                            <li><?php echo anchor('eventos', '<i class="icon-list"></i> Todos los Eventos') ?></li>
                            <li class="divider"></li>
                            <li class="nav-header">Eventos</li>
                            <li><?php echo anchor('f_hoydia', '<i class="icon-time"></i> De hoy') ?></li>
                            <li><?php echo anchor('f_estasemana', '<i class="icon-time"></i> De esta semana') ?></li>
                            <li><?php echo anchor('f_estemes', '<i class="icon-time"></i> De este mes') ?></li>
                        </ul>
                    </li>
                    <li><?php echo anchor('evento/agregar', '<i class="icon-plus icon-white"></i> Publica tu Evento') ?></li>
                    <li><?php echo anchor('eventos/categoria', '<i class="icon-th icon-white"></i> Categorias') ?></li>
                </ul>

				<ul class="nav pull-right">
					<li class="dropdown"><?php echo anchor('#', '<i class="icon-search icon-white"></i> Buscar <b class="caret"></b>', array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown', 'id' => 'buscar')) ?>
						<ul class="dropdown-menu ul-buscar">
							<li class="dropdown-block">
							<form class="form-inline" action="<?php echo build_segment();?>" method="post">
								<div class="control-group buscar">
									<div class="controls">
										<input name="q" type="text" class="form-text form-searchi arrow validate[optional,Generic]" id="searchmenui_search" value="" placeholder="Buscar..." />
									</div>
								</div>
								<div class="control-group">
									<div class="controls">
										<button type="submit" class="btn btn-success entrar">Buscar</button>
									</div>
								</div>
							</form>
							</li>
						</ul>
					</li>
					<?php if ($this->milib->logueado()) :
					?>
					<li class="dropdown"><?php echo anchor('#', '<i class="icon-user icon-white"></i> ' . $this->milib->bienvenido_usuario() . ' <b class="caret"></b>', array('class' => 'dropdown-toggle', 'data-toggle' => 'dropdown')) ?>
						<ul class="dropdown-menu">
							<li class="nav-header">Eventos</li>
							<li><?php echo anchor('user', '<i class="icon-list"></i> Mis eventos') ?></li>
							<li><?php echo anchor('evento/agregar', '<i class="icon-plus"></i> Agregar evento') ?></li>
							<li class="divider"></li>
							<li class="nav-header">Suscripci&oacute;n</li>
							<li><?php echo anchor('user/suscripcion', '<i class="icon-pencil"></i> Suscribirme') ?></li>
							<li class="divider"></li>
							<li class="nav-header">Cuenta</li>
							<li><?php echo anchor('user/cuenta', '<i class="icon-cog"></i> Modificar cuenta'); ?></li>
							<li><?php echo anchor("user/logout", "<i class='icon-off'></i> Salir"); ?></li>
						</ul>
					</li>
					<?php
						else :
							// $this->load->view("user/login_bar");
							echo "logearse";
                		endif;
                	?>
				</ul>
            </div>
            <!--/.nav-collapse -->
        </div>
    </div>
</div>