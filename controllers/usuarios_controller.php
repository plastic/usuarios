<?php
class UsuariosController extends UsuariosAppController 
{
	public $name = 'Usuarios';
	
	public function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allow('login', 'logout');
	}
	
	public function login()
	{
		if ( $this->Auth->user() )
			$this->redirect('/');
		else
			$this->redirect('/');
			
		if ($this->Session->check('Message.auth'))
			$this->set('error', $this->Session->read('Message.auth.message'));
	}
	
	public function logout()
	{
		$this->autoRender = false;
		$this->redirect($this->Auth->logout());
	}
	
	public function index() 
	{
		$this->Usuario->recursive = 0;
		$this->set('usuarios', $this->paginate());
	}

	public function view() 
	{
		if (!$this->Session->check('Auth.Usuario.id')) {
			$this->Session->setFlash(__('Invalid usuario', true));
			$this->redirect('/');
		}
		$this->set('usuario', $this->Usuario->read(null, $this->Session->read('Auth.Usuario.id')));
	}

	public function add() 
	{
		if (!empty($this->data)) {
			$this->Usuario->create();
			if ($this->Usuario->save($this->data)) {
				$this->Session->setFlash(__('Usuario adicionado com sucesso!', true), 'default', array('success' => true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The usuario could not be saved. Please, try again.', true));
			}
		}
	}

	public function edit() 
	{
		if (!$this->Session->check('Auth.Usuario.id')) {
			$this->redirect('/');
		}
		
		if (!empty($this->data)) {
			if ($this->Usuario->save($this->data)) {
				$this->Session->setFlash(__('Usuario alterado com sucesso!', true), 'default', array('success' => true));
				$this->redirect(array('action' => 'view'));
			} else {
				$this->Session->setFlash(__('Não foi possível alterar!', true), 'default', array('error' => true));
			}
		}
		
		if (empty($this->data)) {
			$this->data = $this->Usuario->read(null, $this->Session->read('Auth.Usuario.id'));
		}
	}
	
	public function admin_index() 
	{
		$this->paginate = array(
			'limit' => 20,
			'order' => array(
				'Usuario.created' => 'DESC'
			)
		);
		$this->set('usuarios', $this->paginate('Usuario'));
	}

	public function admin_view($id = null) 
	{
		if (!$id) {
			$this->Session->setFlash(__('Invalid usuario', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('usuario', $this->Usuario->read(null, $id));
	}

	public function admin_add() 
	{
		if (!empty($this->data)) {
			
			$this->Usuario->create();
			
			if( !empty($this->data['Usuario']['confirm']) && !empty($this->data['Usuario']['senha'])) {
				$this->data['Usuario']['senha'] = $this->Auth->password($this->data['Usuario']['senha']);
				$this->data['Usuario']['confirm'] = $this->Auth->password($this->data['Usuario']['confirm']);
			}
			if ($this->Usuario->save($this->data)) {
				$this->Session->setFlash(__('The usuario has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The usuario could not be saved. Please, try again.', true));
			}
		}
	}

	public function admin_edit($id = null) 
	{
		$this->Usuario->id = $id;
		
		if (!$this->Usuario->exists()) {
			return;
		}
		
		if (empty($this->data)) 
		{
			$this->data = $this->Usuario->read();
			if (!empty($this->data['Usuario']['entrada'])) 
			{
				$this->data['Usuario']['entrada'] = $this->Usuario->dateFormatAfterFind($this->data['Usuario']['entrada']);
			}
			unset($this->data['Usuario']['senha']);
		} 
		else 
		{
			if( empty($this->data['Usuario']['confirm']) && empty($this->data['Usuario']['senha'])) {
				unset($this->data['Usuario']['senha']);
				unset($this->data['Usuario']['confirm']);
			} else {
				$this->data['Usuario']['senha'] = $this->Auth->password($this->data['Usuario']['senha']);
				$this->data['Usuario']['confirm'] = $this->Auth->password($this->data['Usuario']['confirm']);
			}
			
			if( !isset($this->data['Usuario']['senha']) || empty($this->data['Usuario']['senha']) ) {
				unset($this->Usuario->validate['senha']);
			}
			
			if ($this->Usuario->save($this->data)) {
				$this->Session->setFlash(__('Usuario alterado com sucesso!', true), 'default', array('success' => true));
				$this->redirect('/admin/usuarios');
			} else 
				$this->Session->setFlash(__('Usuario não alterado. Verifique os dados e tente novamente!', true), 'default', array('error' => true));
				
			unset($this->data['Usuario']['senha']);
			unset($this->data['Usuario']['confirm']);
		}
	}

	public function admin_delete($id = null) 
	{
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for usuario', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Usuario->delete($id)) {
			$this->Session->setFlash(__('Usuario deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Usuario was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	
	public function alterar($codigo = null) 
	{
		if (is_null($codigo)) {
			if (!empty($this->data['Usuario']['lembrar_senha_codigo'])) {
				$codigo = $this->data['Usuario']['lembrar_senha_codigo'];
			}
		} else {
			$this->data['Usuario']['lembrar_senha_codigo'] = $codigo;
		}
		
		$usuario = $this->Usuario->find('first', array('conditions' => array('Usuario.lembrar_senha_codigo' => $codigo)));
		if (!$usuario) {
			$this->Session->setFlash(__('Usuário inválido!', true), 'default', array('error' => true));
			return;
		} 
		
		if (!empty($this->data['Usuario']['senha'])) 
		{
			if( !empty($this->data['Usuario']['confirm']) && !empty($this->data['Usuario']['senha'])) {
				$this->data['Usuario']['senha'] = $this->Auth->password($this->data['Usuario']['senha']);
				$this->data['Usuario']['confirm'] = $this->Auth->password($this->data['Usuario']['confirm']);
			}
			$this->data['Usuario']['id'] = $usuario['Usuario']['id'];
			if ($this->Usuario->save($this->data, true, array('senha'))) {
				$this->Usuario->saveField('lembrar_senha_codigo', NULL, false);
				$this->Session->setFlash(__('Senha alterada com sucesso!', true), 'default', array('success' => true));
				$this->data = null;
			} else {
				unset($this->data['Usuario']['id']);
				unset($this->data['Usuario']['senha']);
				unset($this->data['Usuario']['confirm']);
			}
		}
	}
	
	public function lembrar_senha() 
	{
		if (!empty($this->data)) 
		{
			$this->Usuario->validate = array(
				'email' => array(
					'notEmpty' => array(
						'rule' => 'notEmpty'
					),
					'email' => array(
						'rule' => 'email',
						'message' => 'Digite um e-mail válido'
					)
				)
			);
			
			$conditions = array('Usuario.email' => $this->data['Usuario']['email']);
			$usuario = $this->Usuario->find('first', array('conditions' => $conditions));
			
			if ($this->Usuario->validates($this->data) && !empty($usuario)) {
				$this->data['Usuario']['id'] = $usuario['Usuario']['id'];
				if (empty($usuario['Usuario']['lembrar_senha_codigo'])) {
					$this->data['Usuario']['lembrar_senha_codigo'] = md5(uniqid(microtime()));
				} else {
					$this->data['Usuario']['lembrar_senha_codigo'] = $usuario['Usuario']['lembrar_senha_codigo'];
				}
				
				$this->Usuario->set($this->data);
				
				if ($this->Usuario->save($this->data, false)) {
					$this->notifica_usuario($this->data, 'lembrar', 'Esqueci minha senha');
					$this->Session->setFlash(__('Enviamos um link no e-mail indicado para criar uma nova senha!', true), 'default', array('success' => true));
					$this->data = null;
				} else {
					$this->Session->setFlash(__('Ocorreu um erro no servidor, tente novamente mais tarde!', true), 'default', array('error' => true));
				}
			}
		}
	}
	
}