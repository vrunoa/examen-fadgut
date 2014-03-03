<?php
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{

    protected function _initAutoload()
    {
		$autoloader = new Zend_Application_Module_Autoloader(
			array(
	            'namespace' => '',
				'basePath'  => APPLICATION_PATH,
				'resourceTypes' =>
				array(
					'model' =>
					array(
						'path' => 'models',
						'namespace' => 'Model'
					),
					'form' =>
					array(
						'path' => 'forms',
						'namespace' => 'Form'
					)	
				)
			)
		);
		return $autoloader;
 
    }

}
?>
