<?php
namespace App\EventListener;

use App\Service\Page\VisitorStatistics;
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
    public function onKernelResponse(ResponseEvent $event): void
    {
        $clientIp = $event->getRequest()->getClientIp();
        $browser = $event->getRequest()->headers->get('User-Agent');
        $route = $event->getRequest()->getRequestUri();

        if($this->isCorrectRoute($route)) {
            $this->_visitorStatistics->addVisitor($clientIp, $browser, $route);
        }
    }

    private function isCorrectRoute(string $route): bool
    {
        return strpos($route, '_') === false
            && strpos($route, 'admin') === false
            && strpos($route, 'favicon') === false;
    }
}