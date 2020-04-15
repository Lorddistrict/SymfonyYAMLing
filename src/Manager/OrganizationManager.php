<?php
declare(strict_types=1);

namespace App\Manager;

use App\Entity\Organization;
use App\Repository\OrganizationRepository;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

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

    /**
     * Return a new Collection of Organizations
     *
     * @param OrganizationRepository $organizationRepository
     * @param array                  $data
     * @param OrganizationManager    $organizationManager
     * @return array
     */
    public function getAll(
        OrganizationRepository $organizationRepository,
        YamlManager $yamlManager
    )
    {
        $organizations = $organizationRepository->getAll($yamlManager->read());

        return $organizations;
    }

    /**
     * @param OrganizationRepository $organizationRepository
     * @param array                  $data
     * @param OrganizationManager    $organizationManager
     * @return array
     */
    public function getAllTextFields(
        OrganizationRepository $organizationRepository,
        array $data,
        OrganizationManager $organizationManager
    )
    {
        $organizations = $organizationRepository->getAllTextFields($data, $organizationManager);

        return $organizations;
    }

    /**
     * @param OrganizationRepository $organizationRepository
     * @param YamlManager            $yamlManager
     * @param int                    $organizationId
     * @return Organization|mixed|void
     */
    public function getOneById(
        OrganizationRepository $organizationRepository,
        YamlManager $yamlManager,
        int $organizationId
    )
    {
        $organizations = $this->getAll($organizationRepository, $yamlManager);
        $organization = $organizationRepository->getOneById($organizations, $organizationId);

        return $organization;
    }

    /**
     * @param OrganizationRepository $organizationRepository
     * @param YamlManager            $yamlManager
     * @param Organization           $organization
     * @param SerializerInterface    $serializer
     */
    public function setOrganization(
        OrganizationRepository $organizationRepository,
        YamlManager $yamlManager,
        Organization $organization,
        SerializerInterface $serializer
    )
    {
        $organizations = $this->getAll($organizationRepository, $yamlManager);
        $newOrganizations = $organizationRepository->setOrganization($organizations, $organization);

        $yamlManager->write($serializer->normalize(
            $newOrganizations,
            null,
            [AbstractNormalizer::ATTRIBUTES => [
                'name',
                'description',
                'users'
            ]]
        ));

        return;
    }

    /**
     * @param OrganizationRepository $organizationRepository
     * @param Organization           $organization
     * @param YamlManager            $yamlManager
     * @param SerializerInterface    $serializer
     * @return Organization[]
     */
    public function add(
        OrganizationRepository $organizationRepository,
        Organization $organization,
        YamlManager $yamlManager,
        SerializerInterface $serializer
    )
    {
        $currentOrganizations = $this->getAll($organizationRepository, $yamlManager);
        $length = count($currentOrganizations);
        $organization->setId($length);
        $organizations = $organizationRepository->add($currentOrganizations, $organization);

        $yamlManager->write($serializer->normalize(
            $organizations,
            null,
            [AbstractNormalizer::ATTRIBUTES => [
                'name',
                'description',
                'users'
            ]]
        ));

        return $organizations;
    }

    /**
     * @param OrganizationRepository $organizationRepository
     * @param array                  $data
     * @param int                    $id
     * @return array
     */
    public function delete(OrganizationRepository $organizationRepository, array $data, int $id)
    {
        $organizations = $organizationRepository->delete($data, $id);

        return $organizations;
    }
}
