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
    public function read(): array
    {
        $organizations = Yaml::parseFile('data/organizations.yaml');

        return $organizations;
    }

    /**
     * @param array $toWrite
     */
    public function write(array $toWrite)
    {
        $yaml = Yaml::dump([
            'organizations' => $toWrite
        ]);

        file_put_contents('data/organizations.yaml', $yaml);
    }
}
