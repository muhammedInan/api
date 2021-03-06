<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

class OAuthAuthenticator extends AbstractGuardAuthenticator
{
    private $repository;
    private $linkedinProvider;

    public function __construct(LinkedinProvider $linkedinProvider, ClientRepository $repository)
    {
        $this->linkedinProvider = $linkedinProvider;
        $this->repository = $repository;
    }

    public function supports(Request $request)
    {
        return $request->headers->get('authorization') || $request->query->get('code');
    }

    public function getCredentials(Request $request)
    {
        if ($request->headers->get('authorization')) {
            $bearer = str_replace("Bearer ", "", $request->headers->get('authorization'));
            return [
                'bearer' => $bearer
            ];
        }
    return ['code' => $request->get('code')];
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        if (isset($credentials['bearer'])) {
            $client = $this->repository->findOneBy(['token' => $credentials['bearer']]);
            if (null == $client) {
                return;
            }
            return $client;
        }
        if (null == $credentials['code']) {
            return;
        }
        $token =  $this->linkedinProvider->getAccessTokenFromAPI($credentials['code']);
        $client = $this->linkedinProvider->getUserFromAPI($token);

        return $client;
    }

    public function checkCredentials($credentials, UserInterface $client)
    {
        return true;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        $data = [
            'message' => strtr($exception->getMessageKey(), $exception->getMessageData())
        ];
        return new JsonResponse('You should be connect to access', Response::HTTP_FORBIDDEN);
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        return null;
    }

    public function start(Request $request, AuthenticationException $authException = null)
    {
        $data = [
            'message' => 'Authentication Required'
        ];
        return new JsonResponse($data, Response::HTTP_UNAUTHORIZED);
    }

    public function supportsRememberMe()
    {
        return false;
    }
}
