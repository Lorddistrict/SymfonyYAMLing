<?php
declare(strict_types=1);

namespace App\Controller;

use App\Manager\OrganizationManager;
use App\Manager\YamlManager;
use App\Repository\OrganizationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     *
     * @param YamlManager $yamlManager
     * @param OrganizationManager $organizationManager
     * @return Response
     */
    public function index(
        YamlManager $yamlManager,
        OrganizationRepository $organizationRepository,
        OrganizationManager $organizationManager
    ): Response
    {
        $data = $yamlManager->read();
        $organizations = $organizationRepository->getOrganizationTextFields($data, $organizationManager);

        return $this->render('home/home.html.twig', [
            'organizations' => $organizations,
        ]);
    }

    /**
     * @Route("/home/delete/{id}", name="home_delete")
     *
     * @param Request $request
     * @param YamlManager $yamlManager
     * @param OrganizationRepository $organizationRepository
     */
    public function delete(
        Request $request,
        YamlManager $yamlManager,
        OrganizationRepository $organizationRepository,
        OrganizationManager $organizationManager
    )
    {
        $data = $yamlManager->read();
        $idOrganization = $request->get('id');
        $organizations = $organizationRepository->deleteOrganization($data, (int) $idOrganization);

        // Write the new file
        $yamlManager->write($organizations);

        // Need to regenerate ids
        $organizations = $organizationRepository->getOrganizationTextFields($data, $organizationManager);

        return $this->render('home/home.html.twig', [
            'organizations' => $organizations,
        ]);
    }
}
