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
		
		if( !empty($this->data[$this->alias]['nascimento']) ) 
			$this->data[$this->alias]['nascimento'] = $this->dateFormatBeforeSave($this->data[$this->alias]['nascimento']);
		else
			unset($this->data[$this->alias]['nascimento']);
		return true;
	}
	
	public function equalFields($data = null, $field1 = null, $field2 = null) 
	{
		if (isset($field1) && isset($field2) && isset($this->data[$this->alias][$field2])) 
			return $data[$field1] == $this->data[$this->alias][$field2];
		else
			return false;
	}
	
	public function dateFormatBeforeSave($dateString) 
	{
		if ( !empty($dateString) ) 
		{
			return preg_replace('/(\d{2})\/(\d{2})\/(\d{4})/', '$3-$2-$1', $dateString);
		}
		return false;
	}
	
	public function afterFind($results) 
	{
		foreach ($results as $key => $val) 
		{
			if (!empty($val[$this->alias])) {
				if (isset($val[$this->alias]['created']) || !empty($val[$this->alias]['created'])) {
					$results[$key][$this->alias]['created'] = $this->dateFormatAfterFind($val[$this->alias]['created']);
				}
			}
		}
		return $results;
	}
	
	public function dateFormatAfterFind($dateString)
	{
		return date('d/m/Y', strtotime($dateString));
	}
	
}