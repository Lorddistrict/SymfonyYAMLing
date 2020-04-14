<?php
declare(strict_types=1);

namespace App\Manager;

use App\Entity\Organization;
use Symfony\Component\Yaml\Yaml;

class YamlManager
{
    /**
     * Read the YAML file
     *
     * @return Organization[]
     */
    public function getFileData(): array
    {
        $organizations = Yaml::parseFile('data/organizations.yaml');

        return $organizations;
    }
}
