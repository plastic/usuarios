<?php
App::import('Model', 'Usuarios.Usuario');
App::import('Lib', 'Templates.AppTestCase');

class UsuarioTestCase extends AppTestCase 
{
	public $plugin = 'usuarios';
	protected $_testsToRun = array();

	public function startTest($method) 
	{
		parent::startTest($method);
		$this->Usuario = AppMock::getTestModel('Usuario');
		$fixture = new UsuarioFixture();
		$this->record = array('Usuario' => $fixture->records[0]);
	}

	public function endTest($method) 
	{
		parent::endTest($method);
		unset($this->Usuario);
		ClassRegistry::flush();
	}

	public function testAdd() {
		$data = $this->record;
		unset($data['Usuario']['id']);
		$data['Usuario']['email'] = 'user2@example.com';
		$result = $this->Usuario->add($data);
		$this->assertTrue($result);
	}

	public function testAddValidation() {
		$this->expectException(new OutOfBoundsException(__('Could not save the usuario, please check your inputs.', true)));

		$data = $this->record;
		unset($data['Usuario']['id']);
		unset($data['Usuario']['nome']);
		$this->Usuario->add($data);
	}

	public function testEdit() {
		$result = $this->Usuario->edit(1, null);

		$expected = $this->Usuario->read(null, 1);
		$this->assertEqual($result['Usuario'], $expected['Usuario']);

		// put invalidated data here
		$data = $this->record;
		//$data['Usuario']['title'] = null;

		$result = $this->Usuario->edit(1, $data);
		$this->assertEqual($result, $data);

		$data = $this->record;

		$result = $this->Usuario->edit(1, $data);
		$this->assertTrue($result);

		$result = $this->Usuario->read(null, 1);

		// put record specific asserts here for example
		// $this->assertEqual($result['Usuario']['title'], $data['Usuario']['title']);

		try {
			$this->Usuario->edit('wrong_id', $data);
			$this->fail('No exception');
		} catch (OutOfBoundsException $e) {
			$this->pass('Correct exception thrown');
		}
	}

/**
 * Test viewing a single Usuario 
 *
 * @return void
 * @access public
 */
	public function testView() {
		$result = $this->Usuario->view(1);
		$this->assertTrue(isset($result['Usuario']));
		$this->assertEqual($result['Usuario']['id'], 1);

		try {
			$result = $this->Usuario->view('wrong_id');
			$this->fail('No exception on wrong id');
		} catch (OutOfBoundsException $e) {
			$this->pass('Correct exception thrown');
		}
	}

/**
 * Test ValidateAndDelete method for a Usuario 
 *
 * @return void
 * @access public
 */
	public function testValidateAndDelete() {
		try {
			$postData = array();
			$this->Usuario->validateAndDelete('invalidUsuarioId', $postData);
		} catch (OutOfBoundsException $e) {
			$this->assertEqual($e->getMessage(), 'Invalid Usuario');
		}
		try {
			$postData = array(
				'Usuario' => array(
					'confirm' => 0));
			$result = $this->Usuario->validateAndDelete(1, $postData);
		} catch (Exception $e) {
			$this->assertEqual($e->getMessage(), 'You need to confirm to delete this Usuario');
		}

		$postData = array(
			'Usuario' => array(
				'confirm' => 1));
		$result = $this->Usuario->validateAndDelete(1, $postData);
		$this->assertTrue($result);
	}
	
}
?>