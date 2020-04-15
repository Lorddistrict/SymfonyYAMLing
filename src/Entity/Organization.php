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
    public function __construct(int $id = null, string $name = null, string $description = null, array $users = [])
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->users = $users;
    }

    /**
     * @return int|null
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return User[]
     */
    public function getUsers(): array
    {
        return $this->users;
    }
}
