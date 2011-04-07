<?php
/**
 * Katharsis View
 * Controls anything related to the display level
 *
 * @author Karl Pannek <info@katharsis.in>
 * @version 0.5.2
 * @package Katharsis
 */
class Katharsis_View
{
	/**
	 * @var Katharsis_View
	 */
	protected static $_instance = null;
	
	/**
	 * @var array
	 */
	protected $_params = array();

	/**
	 * Singleton. Returns the same instance every time
	 * 
	 * @return Katharsis_View
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
	 * Sets base application path
	 *
	 * @return void
	 */
	protected function __construct()
	{
		$base = preg_replace('/(.+)\/[^\/]+/', '\1', $_SERVER['SCRIPT_NAME']);
        $this->_params['base'] = $base != $_SERVER['SCRIPT_NAME'] ? $base : '';
	}

	/**
	 * Magical get method, gets specific param
	 *
	 * @param string $name
	 * @return string
	 */
	public function __get($name)
	{
		if(array_key_exists($name, $this->_params))
		{
			return $this->_params[$name];
		}
		return null;
	}

	/**
	 * Magical set method, sets specific param
	 *
	 * @param string name
	 * @param string value
	 */
	public function __set($name, $value)
	{
		$this->_params[$name] = $value;
	}

	/**
	 * Template rendering method
	 * 
	 * @param string $template
	 * @return string
	 */
	public function render($template)
	{
		ob_start();
		if(file_exists('application/view/' . $template . '.phtml'))
		{
			include('application/view/' . $template . '.phtml');
		}
		$output = ob_get_contents();
		ob_end_clean();

		return $output;
	}

	/**
	 * Sets Request params into View params
	 * 
	 * @return void
	 */
	public function requestHook()
	{
        $this->_params['params'] = Katharsis_Request::getParams();
	}
}