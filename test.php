<?php

require_once __DIR__ . '/vendor/autoload.php';

$dqk = new Yo4o\dqk\DeadQueryKiller();
$dqk->killDeadQs();