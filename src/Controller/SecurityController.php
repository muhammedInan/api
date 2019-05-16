<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use JMS\Serializer\SerializerInterface;
use JMS\Serializer\SerializationContext;
use App\Entity\User;

class SecurityController extends AbstractController
{
    private $userRepository;
    private $entityManager;
    private $serializer;

    public function __construct(
        UserRepository $userRepository,
        EntityManagerInterface $entityManager,
        SerializerInterface $serializer
    ) {
        $this->userRepository = $userRepository;
        $this->entityManager = $entityManager;
        $this->serializer = $serializer;
    }

    /**
     * @Route("/security", name="security")
     */
    public function index()
    {
        return $this->render('security/index.html.twig', [
            'controller_name' => 'SecurityController',
        ]);
    }

    /**
     * @Route("/api/signin", name="signin")
     */
    public function signin()
    {
        return $this->render('security/index.html.twig', [
            'controller_name' => 'SecurityController',
        ]);
    }



    /**
     * @Route("/login", name="login")
     */
    public function loginAction(AuthenticationUtils $authUtils)
    {
        $error = $authUtils->getLastAuthenticationError();
        $lastUsername = $authUtils->getLastUsername();
        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    }

    /**
     * @Route("api/users/{id}", name="user_show", methods="GET")
     */
    public function show(int $id, SerializerInterface $serializer)
    {
        // if ($client = $this->getUser()->getClient() !== null) {
        $user = $this->userRepository->find($id);

        $response = new Response($this->serializer->serialize($user, 'json', SerializationContext::create()->setGroups(array('details'))), Response::HTTP_OK);
        $response->setSharedMaxAge(3600);
        $response->headers->addCacheControlDirective('must-revalidate', true);
        if ($user == null) {
            return new JsonResponse(['User NOT FOUND'], Response::HTTP_NOT_FOUND);
        }

        return $response;
    }

    /**
     * @Route("/api/users", name="users", methods="GET")
     */
    public function users(SerializerInterface $serializer)
    {
        if ($this->getUser() !== null) {
            $users = $this->userRepository->findAll();
            $response = new Response($serializer->serialize($users, 'json'), Response::HTTP_OK);
            $response->setSharedMaxAge(3600);
            $response->headers->addCacheControlDirective('must-revalidate', true);
            return $response;
        }
        return new Response($serializer->serialize($users, 'json'), Response::HTTP_UNAUTHORIZED);
    }

    /**
     * @Route("api/users", name="user_create", methods="POST")
     */
    public function create(Request $request, SerializerInterface $serializer)
    {
        $user = $serializer->deserialize($request->getContent(), User::class, 'json');
        $client = $this->getUser();
        $user->setClient($client);


        $this->entityManager->persist($user);
        $this->entityManager->flush();

        $user = $this->userRepository->find($user->getId());
        return new Response($serializer->serialize($user, 'json', SerializationContext::create()->setGroups(array('details'))), Response::HTTP_CREATED);
    }

    /**
     * @Route("api/users/{id}", name="user_delete", methods="DELETE")
     */
    public function delete($id)
    {
        $client = $this->getUser();
        if ($client  !== null) {
            $user = $this->userRepository->find($id);

            if (!$user) {
                return new JsonResponse('User NOT FOUND', Response::HTTP_NOT_FOUND);
            }
            if ($user->getClient() !== $client) {
                dd($user, $client);
                return new JsonResponse('action non autorisé', Response::HTTP_FORBIDDEN);
            }
            $response = new Response(null, Response::HTTP_NO_CONTENT);
            $response->setSharedMaxAge(3600);
            $response->headers->addCacheControlDirective('must-revalidate', true);
            $this->entityManager->remove($user);
            $this->entityManager->flush();
            return $response;
        }
        return new JsonResponse('authentication required', Response::HTTP_UNAUTHORIZED);
    }
}
