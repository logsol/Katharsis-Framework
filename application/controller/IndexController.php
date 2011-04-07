<?php
/**
 * Example Controller
 * By specifying controllers you arrange the different parts of your application 
 * into groups of methods called actions
 *
 * @author Karl Pannek <info@katharsis.in>
 * @version 0.5.2
 * @package Katharsis
 */
class IndexController extends Katharsis_Controller_Abstract
{
	/**
	 * Controller init method, will be called on any action request, 
	 * before action method is called
	 * 
	 * @return void
	 */
	public function init()
	{
	}
	
	/**
	 * Action method, call url: /controller/action
	 *
	 * @return void
	 */
	public function indexAction()
	{
		$this->_view->someVariableName = 'Katharsis';
		echo $this->_view->render('welcome');
	}
	
	/**
	 * Fallback method, will be called, if requested action doesn't exist
	 *
	 * @param string $name
	 * @param array $args
	 * @return void
	 */ 
	public function __call($name, $args)
	{
	}
}