<?php
require_once 'Db.php';

class Model_Admin extends Model_Db{

	public function validateAdmin($user, $pass){
	
		$sql = "SELECT * FROM administradores WHERE usuario = '$user' AND password = '$pass';";
		$resource = mysql_query($sql, $this->_link);
		return mysql_fetch_assoc($resource);
	}
	public function getMuebles(){
	
		$sql = "SELECT * FROM productos";
		$resource = mysql_query($sql, $this->_link);
		while($row = mysql_fetch_assoc($resource)) {
			$rows[] = $row;	
		}
		return is_array($rows) ? $rows : array();
	}
}
?>
