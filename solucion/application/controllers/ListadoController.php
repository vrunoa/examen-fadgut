<?php
class ListadoController extends Zend_Controller_Action {

	private $productos_model;

	public function init(){

		require_once APPLICATION_PATH .'/models/Productos.php';
		$this->productos_model = new Model_Productos();
	}	

	public function indexAction() { 
		
		$tipo = $this->_request->getPost('tipo');
		$this->view->assign('tipo', $tipo);
		
		if($tipo != 'estandar' && $tipo != 'amedida') $tipo = null;
		$listado = $this->productos_model->listar($tipo);
		$this->view->assign('listado', $listado);
	}	
}
?>
