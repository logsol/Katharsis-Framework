<?php
/**
 * Autorender Controller Plugin
 *
 * @author Karl Pannek <info@katharsis.in>
 * @version 0.5.2
 * @package Katharsis
 */
class Katharsis_Controller_Plugin_Autorender extends Katharsis_Controller_Plugin_Abstract
{
	/**
	 * Renders a controller/action.phtml template automaticly after processing controller
	 * 
	 * @return void
	 */
	public function postController()
	{
		$view = Katharsis_View::getInstance();

		$view->controllerAction = false;

		$templateName = strtolower(Katharsis_Request::getControllerName()) . DIRECTORY_SEPARATOR . strtolower(Katharsis_Request::getActionName());

		if(file_exists('application/view' . DIRECTORY_SEPARATOR . $templateName . '.phtml'))
		{
			$view->controllerAction = $templateName;
		}

		$view = Katharsis_View::getInstance();
		echo $view->render('main');
	}
}