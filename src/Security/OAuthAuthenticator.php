<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Response;

class OAuthAuthenticator extends AbstractGuardAuthenticator
{
    private $repository;
    private $linkedinProvider;

    public function __construct(LinkedinProvider $linkedinProvider, UserRepository $repository)
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

    public function getUser($credentials)
    {
        if (isset($credentials['bearer'])) {
            $user = $this->repository->findOneBy(['token' => $credentials['bearer']]);
            if (null == $user) {
                return;
            }
            return $user;
        }
        if (null == $credentials['code']) {
            return;
        }
        $token =  $this->linkedinProvider->getAccessTokenFromAPI($credentials['code']);
        $user = $this->linkedinProvider->getUserFromAPI($token);

        return $user;
    }

    public function checkCredentials($credentials)
    {
        return true;
    }

    public function onAuthenticationFailure( AuthenticationException $exception)
    {
        $data = [
            'message' => strtr($exception->getMessageKey(), $exception->getMessageData())
        ];
        return new JsonResponse('You should be connect to access', Response::HTTP_FORBIDDEN);
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token)
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
