<?php
declare(strict_types=1);

namespace App\Controller;

use App\Manager\OrganizationManager;
use App\Manager\YamlManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
    public function index(YamlManager $yamlManager, OrganizationManager $organizationManager): Response
    {
        $organizations = $yamlManager->getPartialYamlData($organizationManager);

        return $this->render('home/home.html.twig', [
            'organizations' => $organizations,
        ]);
    }
}
