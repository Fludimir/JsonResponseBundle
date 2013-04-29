<?php
namespace Bu\JsonResponseBundle;

use Bu\JsonResponseBundle\HttpFoundation\JsonResponse;

class JsonResponseTest extends \PHPUnit_Framework_TestCase
{
    public function testJsonResponse()
    {
        $data = array('error' => 123, 'message' => 'Smth broken');
        $expected = '{"error":123,"message":"Smth broken"}';

        $response = new JsonResponse($data);

        $this->assertEquals($expected, $response->getContent());
        $this->assertEquals(200, $response->getStatusCode());
        $this->assertEquals('application/json', $response->headers->get('Content-Type'));
    }
}