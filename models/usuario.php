<?php

class Usuario extends UsuariosAppModel 
{
	public $name = 'Usuario';
	public $acts = array('Auth');

	public $validate = array(
		'nome' => array(
			'rule' => 'notEmpty',
			'message' => 'Nome é obrigatório'
		),
		'email' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty'
			),
			'unique' => array(
				'rule' => 'isUnique',
				'message' => 'E-mail já cadastrado',
				'on' => 'create'
			),
			'email' => array(
				'rule' => 'email',
				'message' => 'Digite um e-mail valido'
			)
		),
		'senha' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty'
			),
			'minLength' => array(
				'rule' => array('minLength', '6')
			),
			/*
			'confirm' => array(
				'rule' => array('equalFields', 'senha', 'confirm'),
				'message' => 'Senhas diferentes'
			)
			*/
		)
		
	);
	
	public function beforeSave()
	{
		if (!empty($this->data[$this->alias]['senha'])) 
		{
			App::import('Component', 'Auth');
			$this->Auth = new AuthComponent(null);
			$this->data[$this->alias]['senha'] = $this->Auth->password($this->data[$this->alias]['senha']);
		}
		return true;
	}
	
	public function add($data = null) 
	{
		if (!empty($data)) 
		{
			$this->create();
			$result = $this->save($data);
			if ($result !== false) {
				$this->data = array_merge($data, $result);
				return true;
			} else {
				throw new OutOfBoundsException(__('Could not save the usuario, please check your inputs.', true));
			}
			return $return;
		}
	}

	public function edit($id = null, $data = null) 
	{
		$usuario = $this->find('first', array(
			'conditions' => array(
				"{$this->alias}.{$this->primaryKey}" => $id,
			)
		));
	
		if (empty($usuario)) {
			throw new OutOfBoundsException(__('Invalid Usuario', true));
		}
		
		$this->set($usuario);
		
		if (!empty($data)) 
		{
			$this->set($data);
			$result = $this->save(null, true);
			if ($result) {
				$this->data = $result;
				return true;
			} else {
				return $data;
			}
		} else {
			return $usuario;
		}
	}

	public function view($id = null) 
	{
		$usuario = $this->find('first', array(
			'conditions' => array(
				"{$this->alias}.{$this->primaryKey}" => $id
			)
		));
		
		if (empty($usuario)) {
			throw new OutOfBoundsException(__('Invalid Usuario', true));
		}
		
		return $usuario;
	}

	public function validateAndDelete($id = null, $data = array()) 
	{
		$usuario = $this->find('first', array(
			'conditions' => array(
				"{$this->alias}.{$this->primaryKey}" => $id,
				)
		));
		
		if (empty($usuario)) {
			throw new OutOfBoundsException(__('Invalid Usuario', true));
		}
		
		$this->data['usuario'] = $usuario;
		if (!empty($data)) {
			$data['Usuario']['id'] = $id;
			$tmp = $this->validate;
			$this->validate = array(
				'id' => array('rule' => 'notEmpty'),
				'confirm' => array('rule' => '[1]')
			);
			
			$this->set($data);
			if ($this->validates()) {
				if ($this->delete($data['Usuario']['id'])) {
					return true;
				}
			}
			$this->validate = $tmp;
			throw new Exception(__('You need to confirm to delete this Usuario', true));
		}
	}
	
	public function equalFields($data = null, $field1 = null, $field2 = null) 
	{
		if (isset($field1) && isset($field2) && isset($this->data[$this->alias][$field2])) 
			return $data[$field1] == $this->data[$this->alias][$field2];
		else
			return false;
	}
	
}