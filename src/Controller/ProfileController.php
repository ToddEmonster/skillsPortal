<?php

namespace App\Controller;

use App\Entity\Profile;
use App\Form\ProfileType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/profile/all", name="all_profiles")
     */
    public function index(): Response
    {
        $profile = $this->entityManager->getRepository(Profile::class)->findAll();

        return $this->render('profile/index.html.twig', [
            'controller_name' => 'ProfileController',
        ]);
    }

    /**
     * @Route(
     *     "/profile/{id}",
     *     name="my_profile",
     *     methods={"GET"},
     *     requirements={"id"="\d+"}
     * )
     */
    public function read(int $id = 1): Response
    {
        $profile = $this->entityManager->getRepository(Profile::class)->findOneByUser($id);

        return $this->render('profile/my_profile.html.twig', [
            'controller_name' => 'ProfileController',
            'profile_name' => $profile->getFirstName() . ' ' . $profile->getLastName()
        ]);
    }

    /**
     * @Route("/profile/new", name="new_profile")
     */
    public function new(Request $request): Response
    {
        $profile = new Profile();
        $form = $this->createForm(ProfileType::class, $profile);

        return $this->render(
            'profile/new.html.twig',
            ['form' => $form->createView()]
        );
    }
}
