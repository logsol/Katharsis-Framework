<?php require_once('library/Katharsis/Autoload.php');
/**
 * Bootstrap Class
 * Central application routing entity
 *
 * @author Karl Pannek <info@katharsis.in>
 * @version 0.5.2
 * @package Katharsis
 */
class Katharsis_Bootstrap
{
	/**
	 * Central application routing method
	 * 
	 * @return void
	 */
	public static function run()
	{
		$router = Katharsis_ControllerRouting::getInstance();

		$router->init();

		Katharsis_Controller_Plugin::preControllerHook();

		$router->route();

		Katharsis_Controller_Plugin::postControllerHook();
	}
}