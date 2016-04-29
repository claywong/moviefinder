<?php
namespace app\modules\demo\tests;

use pgc\tests\PTest;

class DemoTest extends PTest
{
    public function testHelloWorld()
    {
        $this->assertTrue(is_string('helloworld'));
        $this->assertEquals(10, strlen('helloworld'));
    }
}
