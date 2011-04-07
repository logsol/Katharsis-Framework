<?php
/**
 * Abstract Model
 * All models must extend this class.
 *
 * @author Karl Pannek <info@katharsis.in>
 * @version 0.5.2
 * @package Katharsis
 */
abstract class Katharsis_Model_Abstract
{
	/**
	 * @var Katharsis_Db5
	 */
	protected $_con;

	/**
	 * Instances class attributes, calles init method
	 * 
	 * @return void
	 */
	public final function __construct()
	{
		$this->_con = Katharsis_DatabaseConnector::getConnection();
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
}