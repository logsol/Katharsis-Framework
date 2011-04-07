<?php
/**
 * Central Plugin Class
 *
 * @author Karl Pannek <info@katharsis.in>
 * @version 0.5.2
 * @package Katharsis
 */
class Katharsis_Controller_Plugin
{
	/**
	 * @var array
	 */
	protected static $_plugins;

	/**
	 * Register all plugins with this method
	 * Plugins will be called in the same order as they have been registered
	 * 
	 * @param object $object - an instance of your plugin
	 * @return void
	 */
	public static function registerPlugin($object)
	{
		self::$_plugins[] = $object;
	}

	/**
	 * Processes preController methods of all plugins
	 * 
	 * @return void
	 */
	public static function preControllerHook()
	{
		foreach(self::$_plugins as $plugin)
		{
			$plugin->preController();
		}
	}

	/**
	 * Processes postController methods of all plugins
	 * 
	 * @return void
	 */
	public static function postControllerHook()
	{
		foreach(self::$_plugins as $plugin)
		{
			$plugin->postController();
		}
	}
}