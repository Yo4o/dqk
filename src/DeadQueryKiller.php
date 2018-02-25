<?php

namespace Yo4o\dqk;

class DeadQueryKiller {

	public function killDeadQs() {
		$pids = $this->getPids();

		echo 'Found ' . count($pids) . ' sleeping queries' . "\n";

		foreach ($pids as $pid) {
			$this->killPid($pid);
		}
	}

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

	private function killPid(int $pid) {
		$query = 'kill' . ' ' . $pid;

		echo 'Killing ID: ' . $pid;

		$result = db\DbConnector::executeQuery($query);
	}
}