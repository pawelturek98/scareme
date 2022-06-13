<?php

declare(strict_types=1);

namespace App\Service\Page;

use App\Entity\PageSettings;
use App\Repository\PageSettingsRepository;

class SiteSettings
{
    private $pageSettingsRepository;

    public function __construct(PageSettingsRepository $pageSettingsRepository)
    {
        $this->pageSettingsRepository = $pageSettingsRepository;
    }

    public function getSettings(): PageSettings
    {
        if (null === ($settings = $this->pageSettingsRepository->getSettings()))
        {
            $settings = (new PageSettings())
                ->setPageName('Default page name')
                ->setNewsletterEnabled(true)
                ->setPageDescription('Default page description')
                ->setShowMostPopularPost(true);
        }

        return $settings;
    }
}