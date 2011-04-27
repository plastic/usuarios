<?php 
/* usuarios schema generated on: 2011-04-27 18:29:04 : 1303939744*/
class usuariosSchema extends CakeSchema {
	var $name = 'usuarios';

	function before($event = array()) {
		return true;
	}

	function after($event = array()) {
	}

	var $usuarios = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'nome' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 200, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'email' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 200, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'senha' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 64, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'lembrar_senha_codigo' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 64, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'nascimento' => array('type' => 'date', 'null' => true, 'default' => NULL),
		'tipo' => array('type' => 'string', 'null' => true, 'default' => 'f', 'length' => 1, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'rg' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 15, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'cpf' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 15, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'cnpj' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 30, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'mailing' => array('type' => 'boolean', 'null' => true, 'default' => '0'),
		'ativo' => array('type' => 'boolean', 'null' => true, 'default' => '0'),
		'endereco' => array('type' => 'string', 'null' => true, 'default' => NULL, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'cidade' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 150, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'estado' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 30, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'telefone' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 20, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'celular' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 20, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')
	);
}
?>