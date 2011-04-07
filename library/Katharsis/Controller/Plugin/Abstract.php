<?php
/**
 * Abstract Controller Plugin
 * All controller plugins must extend this class.
 *
 * @author Karl Pannek <info@katharsis.in>
 * @version 0.5.2
 * @package Katharsis
 */
abstract class Katharsis_Controller_Plugin_Abstract
{
	/**
	 * Overwrite this method, if you want something to be processed 
	 * _before_ the controller is called
	 * 
	 * @return void
	 */
	public function preController()
	{
	}

	/**
	 * Overwrite this method, if you want something to be processed 
	 * _after_ the controller was called
	 * 
	 * @return void
	 */
	public function postController()
	{
	}
}