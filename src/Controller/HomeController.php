<?php
declare(strict_types=1);

namespace App\Controller;

use App\Entity\Organization;
use App\Form\AddOrganisationType;
use App\Manager\OrganizationManager;
use App\Manager\YamlManager;
use App\Repository\OrganizationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

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
        $organizations = $organizationRepository->getAllTextFields($data, $organizationManager);

        return $this->render('home/home.html.twig', [
            'organizations' => $organizations,
        ]);
    }

    /**
     * @Route("/home/add", name="home_add")
     *
     * @param Request $request
     */
    public function add(
        Request $request,
        OrganizationManager $organizationManager,
        OrganizationRepository $organizationRepository,
        YamlManager $yamlManager,
        SerializerInterface $serializer
    )
    {
        $organization = new Organization();
        $form = $this->createForm(AddOrganisationType::class, $organization);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $organization = $form->getData();
            $organizationManager->add(
                $organizationRepository,
                $organization,
                $yamlManager,
                $serializer
            );
        }

        return $this->render('organization/add.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/home/edit/{id}", name="home_edit")
     *
     * @param Request $request
     * @param YamlManager $yamlManager
     * @param OrganizationManager $organizationManager
     */
    public function edit(
        Request $request,
        OrganizationManager $organizationManager,
        OrganizationRepository $organizationRepository,
        YamlManager $yamlManager,
        SerializerInterface $serializer
    )
    {
        $data = $yamlManager->read();
        $organizationId = (int) $request->get('id');

        $organization = $organizationManager->getOneById(
            $organizationRepository,
            $yamlManager,
            $organizationId
        );

        $form = $this->createForm(AddOrganisationType::class, $organization);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $organization = $form->getData();
            $organizationManager->setOrganization(
                $organizationRepository,
                $yamlManager,
                $organization,
                $serializer
            );

            return $this->redirectToRoute('home');
        }

        return $this->render('organization/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/home/delete/{id}", name="home_delete")
     *
     * @param Request $request
     * @param YamlManager $yamlManager
     * @param OrganizationManager $organizationManager
     */
    public function delete(
        Request $request,
        YamlManager $yamlManager,
        OrganizationRepository $organizationRepository,
        OrganizationManager $organizationManager
    )
    {
        $data = $yamlManager->read();
        $organizationId = (int) $request->get('id');
        $organizations = $organizationManager->delete($organizationRepository, $data, $organizationId);

        // Write the new file
        $yamlManager->write($organizations);

        // Need to regenerate ids
        $organizations = $organizationManager->getAll($organizationRepository, $yamlManager);

        return $this->render('home/home.html.twig', [
            'organizations' => $organizations,
        ]);
    }
}
