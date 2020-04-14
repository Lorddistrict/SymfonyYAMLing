<?php
declare(strict_types=1);

namespace App\Entity;

class Organization
{
    private $name;
    private $description;
    private $users;

    /**
     * Organization constructor.
     * @param string $name
     * @param string $description
     * @param User[] $users
     */
    public function __construct(string $name, string $description, array $users = [])
    {
        $this->name = $name;
        $this->description = $description;
        $this->users = $users;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }


}
