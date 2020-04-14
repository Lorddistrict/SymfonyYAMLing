<?php
declare(strict_types=1);

namespace App\Manager;

use App\Entity\Organization;
use Symfony\Component\Yaml\Yaml;

class YamlManager
{
    /**
     * @param OrganizationManager $organizationManager
     * @return Organization[]
     */
    public function getPartialYamlData(OrganizationManager $organizationManager): array
    {
        $organizations = Yaml::parseFile('data/organizations.yaml');

        $organizationsData = [];
        foreach ($organizations['organizations'] as $organization) {
            $organizationsData[] = $organizationManager->getProperties($organization);
        }

        return $organizationsData;
    }
}
