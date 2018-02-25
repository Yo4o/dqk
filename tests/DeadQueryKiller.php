<?php 

namespace Yo4o\tests;

/**
*  Corresponding Class to test YourClass class
*
*  For each class in your library, there should be a corresponding Unit-Test for it
*  Unit-Tests should be as much as possible independent from other test going on.
*
*  @author yourname
*/
class DeadQueryKiller{

    public function test() {
        $test = new dqk\DeadQueryKiller();
        $test->killDeadQs();
    }
}