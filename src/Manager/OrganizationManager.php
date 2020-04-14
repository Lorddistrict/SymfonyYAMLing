<?php
declare(strict_types=1);

namespace App\Manager;

use App\Entity\Organization;

class OrganizationManager
{
    /**
     * Get properties of an Organization
     *
     * @param array $organization
     * @return Organization
     */
    public function getProperties(int $key, array $organization): Organization
    {
        return new Organization($key, $organization['name'], $organization['description']);
    }
}
