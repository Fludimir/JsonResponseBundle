<?php
namespace Bu\JsonResponseBundle;

use Bu\JsonResponseBundle\EventListener\JsonResponseListener;

use Bu\JsonResponseBundle\Configuration\JsonResponseTemplate;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Doctrine\Common\Annotations\AnnotationReader;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\HttpKernelInterface;


class JsonResponseListenerTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->listener = new JsonResponseListener(new AnnotationReader());
        $this->request  = $this->getMock('Symfony\Component\HttpFoundation\Request');
    }

    public function testJsonResponseTemplateAnnotatedAction()
    {
        $this->request->expects($this->once())
            ->method('setRequestFormat')
            ->with('json');

        $event = $this->getFilterControllerEvent(array(new FooControllerFixture, 'jsonTemplateAction'), $this->request);
        $this->listener->onKernelController($event);
    }

    public function testNotAnnotatedAction()
    {
        $this->request->expects($this->never())
            ->method('setRequestFormat');

        $event = $this->getFilterControllerEvent(array(new FooControllerFixture, 'htmlAction'), $this->request);
        $this->listener->onKernelController($event);
    }

    public function testSensioTemplateAnnotatedAction()
    {
        $this->request->expects($this->never())
            ->method('setRequestFormat');

        $event = $this->getFilterControllerEvent(array(new FooControllerFixture, 'htmlTemplateAction'), $this->request);
        $this->listener->onKernelController($event);
    }

    public function testEmptyController()
    {
        $this->request->expects($this->never())
            ->method('setRequestFormat');

        $event = $this->getFilterControllerEvent(function(){}, $this->request);
        $this->listener->onKernelController($event);
    }

    protected function getFilterControllerEvent($controller, $request)
    {
        $mockKernel = $this->getMockForAbstractClass('Symfony\Component\HttpKernel\Kernel', array('', ''));

        return new FilterControllerEvent($mockKernel, $controller, $request, HttpKernelInterface::MASTER_REQUEST);
    }
}

class FooControllerFixture
{
    /**
     * @JsonResponseTemplate
     */
    public function jsonTemplateAction()
    {
    }

    public function htmlAction()
    {
    }

    /**
     * @Template
    */
    public function htmlTemplateAction()
    {
    }
}