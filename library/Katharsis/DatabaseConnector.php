<?php
/**
 * Database Connector
 * controls database connections
 *
 * @author Karl Pannek <info@katharsis.in>
 * @version 0.5.2
 * @package Katharsis
 */
class Katharsis_DatabaseConnector
{
	/**
	 * @var array
	 */
	public static $_conns = array();

	/**
	 * Reading ini file information and connecting
	 * 
	 * @param string $requestedName
	 * @return Katharsis_Db5
	 */
	protected static function connect($requestedName = null)
	{
		$ini = parse_ini_file('config/database.config.ini', true);
		if($ini !== array())
		{
			$conInformation = self::_selectConnection($ini, $requestedName);
			return self::_realConnect($conInformation);
		} else
		{
			return null;
		}
	}

	/**
	 * Connects to all connections in config file
	 * 
	 * @param string $requestedName
	 * @return void
	 */
	public static function connectAll()
	{
		$groups = parse_ini_file('config/database.config.ini',  true);

		foreach($groups as $iniName => $conInformation)
		{
			if(preg_match("~^connection:([^:]+)~", $iniName, $matches))
			{
				self::getConnection($matches[1]);
			}
		}
	}

	/**
	 * Calling Katharsis Db connecting method
	 * 
	 * @param string $requestedName
	 * @return Katharsis_Db5
	 */
	protected static function _realConnect($conInformation)
	{
		$con = new Katharsis_Db5($conInformation['host'], $conInformation['user'], $conInformation['password'], $conInformation['database']);

		self::$_conns[$conInformation['name']]['connection'] = $con;
		self::$_conns[$conInformation['name']]['info'] = $conInformation;

		return $con;
	}

	/**
	 * Returns specified or default connection
	 * 
	 * @param string $requestedName
	 * @return Katharsis_Db5
	 */
	public static function getConnection($requestedName = null)
	{
		if($requestedName === null)
		{
			foreach(self::$_conns as $con)
			{
				if($con['info']['default'] === true)
				{
					return $con['connection'];
				}
			}
			return self::connect(null);
		} else
		{
			if(in_array($requestedName, array_keys(self::$_conns)))
			{
				return self::$_conns[$requestedName]['connection'];
			}
			return self::connect($requestedName);
		}
	}

	/**
	 * Returns an array of connection information
	 * 
	 * @param array $ini
	 * @param string $requestedName
	 * @return array
	 */
	protected static function _selectConnection($ini, $requestedName = null)
	{
		foreach($ini as $name => $connectionInfo)
		{
			if($requestedName === null)
			{
				if(preg_match("~^connection:([^:]+):default~", $name, $matches))
				{
					$connectionInfo['name'] = $matches[1];
					$connectionInfo['default'] = true;
					return $connectionInfo;
				}
			} else
			{
				if(preg_match("~^connection:" . $requestedName . ".*~", $name))
				{
					$connectionInfo['default'] = false;
					$connectionInfo['name'] = $requestedName;
					return $connectionInfo;
				}
			}
		}
		throw new Katharsis_Exception('Could not find database connection information for "' . $requestedName . '"');
	}
}