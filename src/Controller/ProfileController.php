<?php

namespace App\Controller;

use App\Entity\Experience;
use App\Entity\Profile;
use App\Entity\User;
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
    public function index(LoggerInterface $logger): Response
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
     *     name="read_profile",
     *     methods={"GET"},
     *     requirements={"id"="\d+"}
     * )
     */
    public function read(int $id): Response
    {
        // id is the USER id not the PROFILE id
        $profile = $this->entityManager->getRepository(Profile::class)->findOneByUser($id);
        $experiences = $this->entityManager->getRepository(Experience::class)->findBy(["profile"=>$profile]);

        return $this->render(
            'profile/read_profile.html.twig', [
            'controller_name' => 'ProfileController',
            'profile' => $profile,
            'experiences' => $experiences,
        ]);
    }

    /**
     * @Route(
     *     "/profile/{id}/edit",
     *     name="profile_edit",
     *     methods={"GET","POST"},
     *     requirements={"id"="\d+"}
     * )
     */
    public function update(Request $request): Response
    {
        /**@var User $user */
        $user = $this->getUser();

        $profile = $user->getProfile();

        $form = $this->createForm(ProfileType::class, $profile);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $profile = $form->getData();
            $profile->setLastEditDate(new \DateTime());

            $this->entityManager->persist($profile);

            $this->entityManager->flush();

            return $this->redirectToRoute('read_profile',["id" => $user->getId()]);
        }

        return $this->render('profile/edit_profile.html.twig', [
            'profile' => $profile,
            'edit_profile_form' => $form->createView()
        ]);
    }

    /**
     * @Route("/profile/new", name="new_profile")
     */
    public function new(Request $request): Response
    {
        /**@var User $user */
        $user = $this->getUser();

        if ($user->hasProfile()) {
            return $this->redirectToRoute('home');
        }

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

            return $this->redirectToRoute('read_profile',["id" => $user->getId()]);
        }

        return $this->render(
            'create_profile.html.twig',
            ['form' => $form->createView()]
        );
    }
}
