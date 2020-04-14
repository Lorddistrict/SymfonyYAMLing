<?php
declare(strict_types=1);

namespace App\Manager;

use App\Entity\Organization;

class OrganizationManager
{
    /**
     * Get properties of an Organization
     */
    public function getProperties(array $organization)
    {
        return new Organization($organization['name'], $organization['description']);
    }
}
