<?php 

namespace Yo4o\tests;

class DeadQueryKiller{

    public function test() {
        $test = new dqk\DeadQueryKiller();
        $test->killDeadQs();
    }
}