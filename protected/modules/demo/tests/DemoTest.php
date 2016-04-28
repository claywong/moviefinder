<?php
namespace app\modules\demo\tests;


class DemoTest 
{
    public function testHelloWorld()
    {
        $this->assertTrue(is_string('helloworld'));
        $this->assertEquals(10, strlen('helloworld'));
    }
}
