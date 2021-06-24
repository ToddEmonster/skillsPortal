<?php

namespace App\Controller;

use App\Entity\Profile;
use App\Form\ProfileType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ProfileController
 *
 * @IsGranted("ROLE_USER")
 *
 * @package App\Controller
 */
class ProfileController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager) {
        $this->entityManager = $entityManager;
    }

    /**
     * @IsGranted("ROLE_STRUCT")
     * @Route(
     *     "/profiles",
     *     name="profiles"
     * )
     */
    public function index(): Response
    {
        $profiles = $this->entityManager->getRepository(Profile::class)->findAll();

        return $this->render('profile/profiles.html.twig', [
            'controller_name' => 'ProfileController',
            'profiles' => $profiles
        ]);
    }

    /**
     * @Route(
     *     "/profile/{id}",
     *     name="single_profile",
     *     methods={"GET"},
     *     requirements={"id"="\d+"}
     * )
     */
    public function read(int $id): Response
    {
        $profile = $this->entityManager->getRepository(Profile::class)->findOneByUser($id);

        return $this->render('profile/my_profile.html.twig', [
            'controller_name' => 'ProfileController',
            'profile' => $profile
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
