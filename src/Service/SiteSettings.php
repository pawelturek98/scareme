<?php

declare(strict_types=1);

namespace App\Service;

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
        return $this->pageSettingsRepository->getSettings();
    }
}