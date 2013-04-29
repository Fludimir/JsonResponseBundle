<?php
namespace Bu\JsonResponseBundle;

use Bu\JsonResponseBundle\Configuration\JsonResponseTemplate;

class JsonResponseConfigurationTest extends \PHPUnit_Framework_TestCase
{
    public function testConfiguration()
    {
        $configuration = new JsonResponseTemplate(array());

        $this->assertEquals('php', $configuration->getEngine());
    }
}