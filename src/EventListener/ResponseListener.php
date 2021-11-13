<?php
namespace App\EventListener;

use App\Service\VisitorStatistics;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class ResponseListener
{
    /**
     * @var VisitorStatistics
     */
    private $_visitorStatistics;

    /**
     * ResponseListener constructor.
     *
     * @param VisitorStatistics $visitorStatistics
     */
    public function __construct(VisitorStatistics $visitorStatistics)
    {
        $this->_visitorStatistics = $visitorStatistics;
    }

    /**
     * @param ResponseEvent $event
     */
    public function onKernelResponse(ResponseEvent $event)
    {
        $client_ip = $event->getRequest()->getClientIp();
        $browser = $event->getRequest()->headers->get('User-Agent');
        $route = $event->getRequest()->getRequestUri();

        if(strpos($route, '_') === false && strpos($route, 'admin') === false && strpos($route, 'favicon') === false) {
            $this->_visitorStatistics->addVisitor($client_ip, $browser, $route);
        }
    }
}