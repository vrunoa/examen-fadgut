<?php
class Form_Admin extends Zend_Form{

	public function init(){
		
		$obj = new Zend_Form_Element_Text('usuario');
		$obj->setRequired(true)
			->setlabel('Usuario');

		$this->addElement($obj);

		$obj = new Zend_Form_Element_Password('password');
		$obj->setRequired(true)
			->setlabel('Password');

		$this->addElement($obj);

		$obj = new Zend_Form_Element_Submit('submit');
		$obj->setLabel('Ingresar');
		
		$this->addElement($obj);
	}
}
?>
