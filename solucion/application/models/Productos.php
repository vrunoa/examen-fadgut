<?php
require_once 'Db.php';

class Model_Productos extends Model_Db{

	public function getMuebles($tipo = 'estandar'){

		$tipo = $tipo == 'amedida' ? 'amedida' : 'estandar'; 
		$sql = "SELECT * FROM productos WHERE tipo = '$tipo' AND estado = 1;";
		while($row = mysql_fetch_assoc($resource)) {
			$rows[] = $row;	
		}
		return $rows;
	}

	public function alta($nombre, $desc, $tipo, $estado, $stock){
	
		$tipo = $tipo == 'amedida' ? 'amedida' : 'estandar'; 
		$sql = "INSERT INTO productos(nombre, descripcion, tipo, stock, estado) VALUES('$nombre', '$desc', '$tipo', $estado, $stock);";
		mysql_query($sql, $this->_link);
	}

	public function baja($id){

		$id = (int) $id;
		$sql = "DELETE FROM productos WHERE id = $id;";
		mysql_query($sql, $this->_link);
	}

	public function getProducto($id){
	
		$id = (int) $id;
		$sql = "SELECT * FROM productos WHERE id = $id";
		$resource = mysql_query($sql, $this->_link);
		return mysql_fetch_assoc($resource);
	}

	public function modificar($id, $producto){
	
		$id = (int) $id;
		$sql = "UPDATE productos SET 
				nombre      = '".$producto['nombre']."',
				descripcion = '".$producto['descripcion']."',
				stock       = ".$producto['stock'].",
				tipo        = '".$producto['tipo']."',
				estado      = ".$producto['estado']."
				WHERE id = $id;";
		mysql_query($sql, $this->_link);
	}

	public function listar($tipo = null){

		$sql = "SELECT * FROM productos WHERE estado = 1 ";
		if($tipo) {
			$sql.= " AND tipo = '$tipo'";
		}
		$sql.= " ORDER BY nombre;";
		$resource = mysql_query($sql, $this->_link);

		while($row = mysql_fetch_assoc($resource)) {
			$rows[] = $row;	
		}
		return $rows;
	}
}
?>
