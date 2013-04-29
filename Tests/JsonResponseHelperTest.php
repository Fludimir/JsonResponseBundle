<?php
namespace Bu\JsonResponseBundle;

use Bu\JsonResponseBundle\Templating\JsonResponseHelper;

class JsonResponseHelperTest extends \PHPUnit_Framework_TestCase
{
    public function testJsonHelper()
    {
        $data = array('error' => 123, 'message' => 'Smth broken');
        $expected = '{"error":123,"message":"Smth broken"}';

        $helper = new JsonResponseHelper();

        ob_start();
        $helper->output($data);
        $output = ob_get_clean();

        $this->assertEquals($expected, $output);

        $this->assertEquals('bu', $helper->getName());
    }
}