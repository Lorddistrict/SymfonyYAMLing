<?php
declare(strict_types=1);

namespace App\Entity;

class Role
{
    private $name;
    private $users;

    public function __construct(string $name, array $users)
    {
        $this->name = $name;
        $this->users = $users;
    }
}
