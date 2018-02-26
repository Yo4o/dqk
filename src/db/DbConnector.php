<?php

namespace Yo4o\dqk\db;

/**
 * PDO Wrapper
 * 
 */
class DbConnector {

	/**
	 * instance of db connection
	 * @var resource
	 */
	private static $_instance;

	/**
	 * get current DB connection
	 * @return resource
	 */
	public static function getConnection() {
		if (!self::$_instance) {
			include_once('config.php');
			self::$_instance = new \PDO("mysql:host=$db_hostname", $db_username, $db_password);
			self::$_instance->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		}

		return self::$_instance;
	}

	/**
	 * a way to query connected DB
	 * @param  string $sql    SQL
	 * @param  array  $params
	 * @return mixed
	 */
	public static function executeQuery($sql, array $params = []) {
		$result = $rows = [];

		$db = self::getConnection();
		if (!$db || !$sql) {
			return $result;
		}

		$stmt = $db->prepare($sql);
		$stmt->execute($params);

		if ($stmt->rowCount()) {
			$result = $stmt->fetchall(\PDO::FETCH_ASSOC);
		}

		return $result;
	}
}