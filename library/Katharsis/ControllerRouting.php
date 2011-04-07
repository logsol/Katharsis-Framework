<?php
/**
 * Controller Router
 * Specific routing entity
 *
 * @author Karl Pannek <info@katharsis.in>
 * @version 0.5.2
 * @package Katharsis
 */
class Katharsis_ControllerRouting
{
	/**
	 * @var Katharsis_ControllerRouting
	 */
	protected static $_instance = null;

	/**
	 * Singleton. Returns the same instance every time
	 * 
	 * @return Katharsis_ControllerRouting
	 */
	public static function getInstance()
	{
		if(self::$_instance === null)
		{
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	/**
	 * Sets default controller and action names
	 * 
	 * @return void
	 */
	protected function __construct()
	{
		Katharsis_Request::setControllerName('index');
		Katharsis_Request::setActionName('index');
	}

	/**
	 * Initiates routing process
	 * 
	 * @return void
	 */
	public function init()
	{
		$paramstring = "";
		$baseUrl = preg_replace('#(.*/)[^/]+#', '\1', $_SERVER['SCRIPT_NAME']);
		
		if(preg_match("~.*" . $baseUrl . "([^/\?]+)/([^/\?]+)/*([^\?]*)~", $_SERVER['REQUEST_URI'], $matches))
		{
			$controller = $matches[1];
			$action = $matches[2];
			$paramstring = $matches[3];
			$params = $this->_buildParams($paramstring);

			Katharsis_Request::setControllerName($controller);
			Katharsis_Request::setActionName($action);
		} else if(preg_match("~.*" . $baseUrl . "([^/\?]+)/*([^\?]*)~", $_SERVER['REQUEST_URI'], $matches))
		{
			$controller = $matches[1];
			$paramstring = $matches[2];
			$params = $this->_buildParams($paramstring);

			Katharsis_Request::setControllerName($controller);
		} else 
		{
			if(array_key_exists('controller', $_GET))
			{
				$controller = $_GET['controller'];
				Katharsis_Request::setControllerName($controller);
			}
			
			if(array_key_exists('action', $_GET))
			{
				$action = $_GET['action'];
				Katharsis_Request::setActionName($action);
			}
			
			$params = $_GET;
		}

		Katharsis_Request::setParams($params);

		Katharsis_View::getInstance()->requestHook();
	}

	
	/**
	 * Routing processing method
	 * 
	 * @return void
	 */
	public function route()
	{
		$controllerName = ucfirst(Katharsis_Request::getControllerName()) . 'Controller';
		$action = Katharsis_Request::getActionName() . 'Action';

		if(class_exists($controllerName))
		{
			$controllerObject = new $controllerName();

			$controllerObject->$action();
		}
	}

	
	/**
	 * Splits parameters to an array and returns them
	 * 
	 * @return array
	 */
	protected function _buildParams($string)
	{
		$params = array();
		if(trim($string) !== '')
		{
			$urlparams = explode("/", $string);

			for($i = 0; $i < count($urlparams); $i=$i+2)
			{
				if(array_key_exists($i+1, $urlparams))
				{
					$params[$urlparams[$i]] = $urlparams[$i+1];
				} else
				{
					$params[$urlparams[$i]] = null;
				}
			}
		}

		return $params;
	}
}