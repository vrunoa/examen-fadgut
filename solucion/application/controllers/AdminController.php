<?php
class AdminController extends Zend_Controller_Action {

	private $admin_model, $productos_model;

	public function init(){
		
		$this->admin_model = new Model_Admin();
		$this->productos_model = new Model_Productos();
	}

	private function checkSession(){
	
		$auth = new Zend_Session_Namespace('auth');
		if(!$auth->usuario) $this->_redirect('/admin/logout');
	}
	
	public function logoutAction(){
	
		Zend_Session::destroy();
		$this->_redirect('/admin/login');
	}

	public function loginAction() { 

		$form = new Form_Admin();
		$this->view->assign('form', $form);

		if(!$this->_request->isPost()) return;

		if(!$form->isValid($this->_request->getPost())){
			$form->reset();	
			$this->view->assign('form', $form);
			return;
		}
		$usuario = $form->getElement('usuario')->getValue();
		$password = $form->getElement('password')->getValue();

		$admin = $this->admin_model->validateAdmin($usuario, $password);
		if(!$admin){
			$this->view->assign('error', true);
			return;
		}

		$auth = new Zend_Session_Namespace('auth');
		$auth->usuario = $admin;
		$this->_redirect('/admin/listado');
	}	

	public function altaAction(){
	
		$this->checkSession();

		if(!$this->_request->isPost()) return;

		$nombre = $this->_request->getPost('nombre');
		$desc   = $this->_request->getPost('descripcion');
		$tipo   = $this->_request->getPost('tipo');
		$stock  = (int) $this->_request->getPost('stock');
		$estado = $this->_request->getPost('estado') == 'on' ? 1 : 0;

		$this->productos_model->alta(
			$nombre,
			$desc,
			$tipo,
			$stock,
			$estado
		);
		$this->_redirect('/admin/listado');
	}

	public function deleteAction(){
	
		$this->checkSession();
		
		$id = $this->_request->getParam('id');
		$this->productos_model->baja($id);
		$this->_redirect('/admin/listado');
	}

	public function editAction(){
	
		$this->checkSession();
		$id = $this->_request->getParam('id');

		$producto = $this->productos_model->getProducto($id);	
		if(!$producto) $this->_redirect('/admin/listado');

		$this->view->assign('producto', $producto);
		if(!$this->_request->isPost()) return;

		$producto['nombre']      = $this->_request->getPost('nombre');
		$producto['descripcion'] = $this->_request->getPost('descripcion');
		$producto['tipo']        = $this->_request->getPost('tipo');
		$producto['stock']       = (int) $this->_request->getPost('stock');
		$producto['estado']      = $this->_request->getPost('estado') == 'on' ? 1 : 0;

		$this->productos_model->modificar($id, $producto);
		$this->_redirect('/admin/listado');
	}

	public function listadoAction(){
		
		$this->checkSession();
		$listado = $this->admin_model->getMuebles();

		$this->view->assign('listado', $listado);
	}
}
?>
