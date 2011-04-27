<?php
/* Usuario Fixture generated on: 2011-04-15 12:04:00 : 1302880440 */
class UsuarioFixture extends CakeTestFixture {
/**
 * Name
 *
 * @var string
 * @access public
 */
	public $name = 'Usuario';

/**
 * Fields
 *
 * @var array
 * @access public
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'nome' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 200, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'email' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 200, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'senha' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 64, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'lembrar_senha_codigo' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 64, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
		'nascimento' => array('type' => 'date', 'null' => true, 'default' => NULL),
		'tipo' => array('type' => 'string', 'null' => false, 'default' => 'f', 'length' => 1, 'collate' => 'utf8_unicode_ci', 'charset' => 'utf8'),
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

/**
 * Records
 *
 * @var array
 * @access public
 */
	public $records = array(
		array(
			'id' => 1,
			'nome' => 'Lorem ipsum dolor sit amet',
			'email' => 'usuario@example.com',
			'senha' => 'Lorem ipsum dolor sit amet',
			'lembrar_senha_codigo' => 'Lorem ipsum dolor sit amet',
			'nascimento' => '2011-04-15',
			'tipo' => 'f',
			'rg' => 'Lorem ipsum d',
			'cpf' => 'Lorem ipsum d',
			'cnpj' => 'Lorem ipsum dolor sit amet',
			'mailing' => 1,
			'ativo' => 1,
			'endereco' => 'Lorem ipsum dolor sit amet',
			'cidade' => 'Lorem ipsum dolor sit amet',
			'estado' => 'Lorem ipsum dolor sit amet',
			'telefone' => 'Lorem ipsum dolor ',
			'celular' => 'Lorem ipsum dolor ',
			'created' => '2011-04-15 12:14:00',
			'modified' => '2011-04-15 12:14:00'
		),
	);

}
?>