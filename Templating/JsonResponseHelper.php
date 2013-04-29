<?php

namespace Bu\JsonResponseBundle\Templating;

use Symfony\Component\Templating\Helper\Helper;

/**
 * JsonResponse helper for templates.
 *
 * @author Lebedinsky Vladimir <Lebedinsky@qarea.com>
 */
class JsonResponseHelper extends Helper
{
    //@deprecated? looks like not used
    public function getName()
    {
        return 'bu';
    }

    public function output($data)
    {
        echo json_encode($data);
    }
}
