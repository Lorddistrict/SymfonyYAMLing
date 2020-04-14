<?php
declare(strict_types=1);

namespace App\Controller;

use App\Manager\OrganizationManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Yaml\Yaml;

class HomeController extends AbstractController
{
    /**
     * @Route("/home", name="home")
     */
    public function index(OrganizationManager $organizationManager)
    {
        $organizations = Yaml::parseFile('data/organizations.yaml');

        $organizationsData = [];
        foreach ($organizations['organizations'] as $organization) {
            $organizationsData[] = $organizationManager->getProperties($organization);
        }

        return $this->render('home/home.html.twig', [
            'organizations' => $organizationsData,
        ]);
    }
}
