<?php
declare(strict_types=1);

namespace App\Entity;

class Organization
{
    private $id;
    private $name;
    private $description;
    private $users;

    /**
     * Organization constructor.
     * @param int $id
     * @param string $name
     * @param string $description
     * @param array $users
     */
    public function __construct(int $id, string $name, string $description, array $users = [])
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->users = $users;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
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
