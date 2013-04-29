<?php
namespace Bu\JsonResponseBundle\HttpFoundation;

use Symfony\Component\HttpFoundation\Response;

/**
 * Class for typical JSON Response.
 *
 * @author Lebedinsky Vladimir <Fludimir@gmail.com>
 */
class JsonResponse extends Response
{
    /**
     * {@inheritDoc}
     */
    public function __construct($content)
    {
        parent::__construct(json_encode($content), 200, array(
            'Content-Type' => 'application/json'
        ));
    }
}
