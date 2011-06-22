<?php 

Router::connect('/admin/usuarios/:action/*', array(
	'admin'      => true, 
	'prefix'     => 'admin',
	'plugin'     => 'usuarios', 
	'controller' => 'usuarios'
));

Router::connect('/usuarios/:action/*', array(
	'plugin'     => 'usuarios', 
	'controller' => 'usuarios'
));