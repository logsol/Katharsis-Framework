<?php
/**
 * Abstract Controller
 * All controllers must extend this class.
 *
 * @author Karl Pannek <info@katharsis.in>
 * @version 0.5.2
 * @package Katharsis
 */
abstract class Katharsis_Controller_Abstract
{
	/**
	 * @var Katharsis_Db5
	 */
	protected $_con;
	
	/**
	 * @var Katharsis_View
	 */
	protected $_view;

	/**
	 * Instances class attributes, calles init method
	 * 
	 * @return void
	 */
	public final function __construct()
	{
		$this->_con = Katharsis_DatabaseConnector::getConnection();
		$this->_view = Katharsis_View::getInstance();
		$this->init();
	}

	/**
	 * Overwrite this method instead of using a constructor
	 * 
	 * @return void
	 */
	public function init()
	{
	}

	/**
	 * If subclass hasn't got a __call method, this exception will be thrown
	 * 
	 * @return void
	 */
	public function __call($action, $params)
	{
		throw new Katharsis_Exception('Action "' . $action . '" doesn\'t exist.');
	}

	/**
	 * Returns a specific request parameter
	 * 
	 * @param string $key
	 * @return mixed
	 */
	protected function _getParam($key)
	{
		$params = Katharsis_Request::getParams();
		if(array_key_exists($key,$params))
		{
			return $params[$key];
		}
		return null;
	}

	/**
	 * Returns all request parameters
	 * 
	 * @return array
	 */
	protected function _getAllParams()
	{
		return Katharsis_Request::getParams();
	}

	/**
	 * Forward to an other action
	 * 
	 * @param string $action
	 * @param string $controller
	 * @param array $getParams
	 * @return void
	 */
	protected function _location($action, $controller = null, $getParams = null)
	{
		if($controller === null)
		{
			$controller = Katharsis_Request::getControllerName();
		}

		$paramstring = "";
		if($getParams !== null)
		{
			foreach($getParams as $key => $value)
			{
				$paramstring .= "/" . (string) $key . "/" . (string) $value;
			}
		}

		header("location: " . $this->_view->base . "/" . $controller . "/" . $action . $paramstring);
	}
}