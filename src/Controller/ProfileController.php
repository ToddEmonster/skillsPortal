<?php

namespace App\Controller;

use App\Entity\Profile;
use App\Entity\User;
use App\Form\ProfileType;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
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
    public function index(LoggerInterface $logger): Response
    {
        $logger->info('Look! I just used a service');
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
        // id is the USER id not the PROFILE id
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
        /**@var User $user */
        $user = $this->getUser();
//        $userEmail = $this->getUser()->getUserIdentifier();
//        $user = $this->entityManager->getRepository(User::class)->findOneBy(["email" => $userEmail]);

        if ($user->hasProfile()) {
            return $this->redirectToRoute('home');
        }

//        if ($user->hasProfile()) {
//            $url = $this->urlGenerator->generate('single_profile', ['id' => $user->getProfile()->getId()]);
//        } else {
//            $url = $this->urlGenerator->generate('new_profile');
//        }

        $profile = new Profile();
        $form = $this->createForm(ProfileType::class, $profile);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $profile = $form->getData();

            $profile->setCreationDate(new \DateTime());
            $profile->setLastEditDate(new \DateTime());
            $profile->setIsCollaborator(false);
            $profile->setUser($user);
            
            $this->entityManager->persist($profile);

            // Update user profile
            $user->setProfile($profile);

            $this->entityManager->flush();
            return $this->redirectToRoute('single_profile',["id" => $user->getId()]);
        }

        return $this->render(
            'profile/new.html.twig',
            ['form' => $form->createView()]
        );
    }
}
