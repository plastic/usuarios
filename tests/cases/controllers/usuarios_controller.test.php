<?php
App::import('Controller', 'Usuarios.Usuarios');
App::import('Lib', 'Templates.AppTestCase');

class UsuariosControllerTestCase extends AppTestCase 
{
	public $plugin = 'usuarios';
	protected $_testsToRun = array();

	public function startTest($method) 
	{
		parent::startTest($method);
		$this->Usuarios = AppMock::getTestController('UsuariosController');
		$this->Usuarios->constructClasses();
		$this->Usuarios->params = array(
			'named' => array(),
			'pass' => array(),
			'url' => array()
		);
		$fixture = new UsuarioFixture();
		$this->record = array('Usuario' => $fixture->records[0]);
	}

	public function endTest($method) 
	{
		parent::endTest($method);
		unset($this->Usuarios);
		ClassRegistry::flush();
	}

	public function assertFlash($message) {
		$flash = $this->Usuarios->Session->read('Message.flash');
		$this->assertEqual($flash['message'], $message);
		$this->Usuarios->Session->delete('Message.flash');
	}

	public function testInstance() 
	{
		$this->assertIsA($this->Usuarios, 'UsuariosController');
	}
	
}