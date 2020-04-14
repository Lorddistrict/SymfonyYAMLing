<?php
declare(strict_types=1);

namespace App\Entity;

class User
{
    private $name;
    private $roles;

    public function __construct(string $name, array $roles)
    {
        $this->name = $name;
        $this->roles = $roles;
    }
}
