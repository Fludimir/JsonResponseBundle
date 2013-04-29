<?php

namespace Bu\JsonResponseBundle\Configuration;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * @JsonResponseTemplate annotation.
 *
 * @author Lebedinsky Vladimir <Fludimir@gmail.com>
 *
 * @Annotation
 */
class JsonResponseTemplate extends Template
{
    protected $engine = 'php';
}
