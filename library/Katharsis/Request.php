<?php
/**
 * Katharsis Request
 * Represents a http call
 *
 * @author Karl Pannek <info@katharsis.in>
 * @version 0.5.2
 * @package Katharsis
 */
class Katharsis_Request
{
	/**
	 * @var string
	 */
	protected static $_controller;
	
	/**
	 * @var string
	 */
	protected static $_action;
	
	/**
	 * @var array
	 */
	protected static $_params = array();

	/**
	 * Set name of controller
	 * 
	 * @param string $name
	 * @return void
	 */
	public static function setControllerName($name)
	{
		self::$_controller = $name;
	}

	/**
	 * Set name of action
	 * 
	 * @param string $name
	 * @return void
	 */
	public static function setActionName($name)
	{
		self::$_action = $name;
	}

	/**
	 * Set parameters
	 * 
	 * @param array $params
	 * @return void
	 */
	public static function setParams($params)
	{
		foreach($_POST as $key => $value)
		{
			$params[$key] = $value;
		}
		self::$_params = $params;
	}

	/**
	 * Get controller name
	 * 
	 * @return string
	 */
	public static function getControllerName()
	{
		return self::$_controller;
	}

	/**
	 * Get action name
	 * 
	 * @return string
	 */
	public static function getActionName()
	{
		return self::$_action;
	}

	/**
	 * Get parameter array
	 * 
	 * @return array
	 */
	public static function getParams()
	{
		return self::$_params;
	}
}