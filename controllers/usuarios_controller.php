<?php
class UsuariosController extends UsuariosAppController 
{
	public $name = 'Usuarios';
	public $scaffold = 'admin';
	
	public function beforeFilter()
	{
		#parent::beforeFilter();
		#$this->Auth->allow('*');
	}
}