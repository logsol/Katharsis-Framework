<?php
/**
 * Autoloader
 * Loads class files automatically when they are needed.
 *
 * @author Karl Pannek <info@katharsis.in>
 * @version 0.5.2
 * @package Katharsis
 */
class Katharsis_Autoload
{
	/**
	 * @var array
	 */
	protected static $_classLocations = array(
		'library',
		'application/controller',
		'application/model'
	);

	/**
	 * Registering autoload method
	 * 
	 * @return void
	 */
	public static function init()
	{
		spl_autoload_register('Katharsis_Autoload::autoload');
	}

	/**
	 * Actual autoload method. Loads class files automatically when they are needed
	 * 
	 * @return void
	 */
	public static function autoload($classname)
	{
		$name = str_replace("_", DIRECTORY_SEPARATOR, $classname);

		foreach(self::$_classLocations as $location)
		{
			if(file_exists($location . DIRECTORY_SEPARATOR . $name . ".php"))
			{
				require_once $location . DIRECTORY_SEPARATOR . $name . ".php";
				return;
			}
		}
		
		die('Autoload: could not load class "' . $classname . '"');
	}
}