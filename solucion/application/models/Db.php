<?php
class Model_Db {
		
	protected $_link;

	public function __construct(){
	
		$config = new Zend_Config_Ini(APPLICATION_PATH . '/configs/config.ini');
		$this->_link = mysql_connect($config->db_host, $config->db_user, $config->db_pass);
		
		$db = mysql_select_db($config->db_name, $this->_link);
	}
}
