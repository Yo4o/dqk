<?php

namespace Yo4o\dqk;

/**
 * Simple way to stop dead/sleep queries and connections
 */
class DeadQueryKiller {

	/**
	 * kill dead (sleep) queries/connections
	 * @return bool
	 */
	public function killDeadQs() {
		$pids = $this->getPids();

		echo 'Found ' . count($pids) . ' sleeping queries' . "\n";

		foreach ($pids as $pid) {
			$this->killPid($pid);
		}

		return true;
	}

	/**
	 * get process ids what will be stopped
	 * @return array
	 */
	private function getPids() {
		$result = [];

		$query = '
			SELECT
				`id`
			FROM
				`information_schema`.`processlist`
			WHERE
				`command` = ?
			ORDER BY
				`id`
		';

		$rows = db\DbConnector::executeQuery($query, ['Sleep']);

		foreach ($rows as $row) {
			$result[$row['id']] = $row['id'];
		}

		return $result;
	}

	/**
	 * send kill query for specific process id
	 * @param  int    $pid
	 * @return bool
	 */
	private function killPid(int $pid) {
		$query = 'kill' . ' ' . $pid;

		echo 'Killing ID: ' . $pid;

		return db\DbConnector::executeQuery($query);
	}
}