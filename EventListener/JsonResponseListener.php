<?php

namespace Bu\JsonResponseBundle\EventListener;

use Sensio\Bundle\FrameworkExtraBundle\EventListener\TemplateListener;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Doctrine\Common\Annotations\Reader;
use Doctrine\Common\Util\ClassUtils;
use Bu\JsonResponseBundle\Configuration\JsonResponseTemplate;

/**
 * Handles the @JsonResponse annotation setting request format to json.
 *
 * @author Lebedinsky Vladimir <Fludimir@gmail.com>
 */
class JsonResponseListener extends TemplateListener
{
    protected $reader;

    public function __construct(Reader $reader)
    {
        $this->reader = $reader;
    }

    public function onKernelController(FilterControllerEvent $event)
    {
        if (!is_array($controller = $event->getController())) {
            return;
        }

        $className = class_exists('Doctrine\Common\Util\ClassUtils') ? ClassUtils::getClass($controller[0]) : get_class($controller[0]);
        $object    = new \ReflectionClass($className);
        $method    = $object->getMethod($controller[1]);

        $request = $event->getRequest();
        foreach ($this->reader->getMethodAnnotations($method) as $configuration) {
            if ($configuration instanceof JsonResponseTemplate) {
                $request->setRequestFormat('json');
            }
        }
    }
}
