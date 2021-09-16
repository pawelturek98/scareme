<?php
namespace App\Service;

use App\Entity\VisitorsStatistics;
use Doctrine\ORM\EntityManagerInterface;

class VisitorStatistics
{
    private $_entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->_entityManager = $entityManager;
    }

    /**
     * @param string $ip_address
     * @param string $browser
     * @param string $route
     */
    public function addVisitor(string $ip_address, string $browser, string $route): void
    {
        $visitorStatistic = (new VisitorsStatistics())
            ->setIpAddress($ip_address)
            ->setBrowser($browser)
            ->setRoute($route)
            ->setVisitedAt(new \DateTime('now'));

        $this->_entityManager->persist($visitorStatistic);
        $this->_entityManager->flush();
    }
}