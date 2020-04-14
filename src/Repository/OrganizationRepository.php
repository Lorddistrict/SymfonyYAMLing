<?php

namespace App\Repository;

use App\Entity\Organization;
use App\Manager\OrganizationManager;

class OrganizationRepository
{
    /**
     * @param Organization[] $organizations
     */
    public function getOrganizationTextFields(array $organizations, OrganizationManager $organizationManager)
    {
        $organizationsData = [];
        foreach ($organizations['organizations'] as $organization) {
            $organizationsData[] = $organizationManager->getProperties($organization);
        }

        return $organizationsData;
    }
}
