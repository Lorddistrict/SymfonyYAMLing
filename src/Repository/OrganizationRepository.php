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
        foreach ($organizations['organizations'] as $key => $organization) {
            $organizationsData[] = $organizationManager->getProperties($key, $organization);
        }

        return $organizationsData;
    }

    /**
     * @param Organization[] $organizations
     * @param int            $idOrganization
     */
    public function deleteOrganization(
        array $organizations,
        int $idOrganization
    )
    {
        $organizationsData = [];
        foreach ($organizations['organizations'] as $key => $organization) {
            if ($key !== $idOrganization) {
                $organizationsData[] = $organization;
            }
        }

        return $organizationsData;
    }
}
