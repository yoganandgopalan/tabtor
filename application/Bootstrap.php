<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	protected function _initAutoload()
    {
        $autoloader = new Zend_Application_Module_Autoloader(array(
            'namespace' => 'Default_',
            'basePath'  => dirname(__FILE__),
        ));
		Zend_Loader_Autoloader::getInstance()->registerNamespace('extension_');
		Zend_Loader_Autoloader::getInstance()->registerNamespace('app_');
		Zend_Loader_Autoloader::getInstance()->registerNamespace('DbTable_');
        return $autoloader;
    } 
	
	protected function _initRestRoute()
	{
		$this->bootstrap('Request');	
		$front = $this->getResource('FrontController');
		$restRoute = new Zend_Rest_Route($front, array(), array(
			'default' => array('user')
		));
		$front->getRouter()->addRoute('rest', $restRoute);
	} 

	protected function _initRequest()
    {
        $this->bootstrap('FrontController');
        $front = $this->getResource('FrontController');
        $request = $front->getRequest();
    	if (null === $front->getRequest()) {
            $request = new Zend_Controller_Request_Http();
            $front->setRequest($request);
        }
    	return $request;        
    } 		

}

