<?php

namespace App\Repository;

use App\Entity\Organization;
use App\Manager\OrganizationManager;

class OrganizationRepository
{
    /**
     * @param array $organizationsFromFile
     */
    public function getAll(array $organizationsFromFile)
    {
        /** @var Organization $organization */
        foreach ($organizationsFromFile['organizations'] as $key => $organization) {
            $organizations[] = new Organization(
                $key,
                $organization['name'],
                $organization['description'],
                $organization['users']
            );
        }

        return $organizations;
    }

    /**
     * @param Organization[] $organizations
     */
    public function getAllTextFields(array $organizations, OrganizationManager $organizationManager)
    {
        $organizationsData = [];
        foreach ($organizations['organizations'] as $key => $organization) {
            $organizationsData[] = $organizationManager->getProperties($key, $organization);
        }

        return $organizationsData;
    }

    /**
     * @param Organization[] $organizations
     * @param Organization   $organization
     */
    public function add(array $organizations, Organization $organization)
    {
        array_push($organizations, $organization);

        return $organizations;
    }

    /**
     * @param Organization[] $organizations
     * @param int            $idOrganization
     */
    public function delete(
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
