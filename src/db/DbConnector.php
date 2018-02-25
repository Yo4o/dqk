<?php

namespace Yo4o\dqk\db;

class DbConnector {

	private static $_instance;

	public static function getConnection() {
		if (!self::$_instance) {
			include_once('config.php');
			self::$_instance = new \PDO("mysql:host=$db_hostname", $db_username, $db_password);
			self::$_instance->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		}

		return self::$_instance;
	}

	public static function executeQuery($sql, array $params = []) {
		$db = self::getConnection();
		if (!$db || !$sql) {
			return false;
		}

		$result = $rows = [];

		$stmt = $db->prepare($sql);
		$stmt->execute($params);

		if ($stmt->rowCount()) {
			$result = $stmt->fetchall(\PDO::FETCH_ASSOC);
		}

		return $result;
	}
}