<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;

class OAuthAuthenticator extends AbstractGuardAuthenticator
{
    public function __construct(LinkedinProvider $linkedinProvider)
    {
     $this->linkedinProvider = $linkedinProvider;
    }
    public function supports(Request $request)
    {
        // todo
        return $request->attributes->get('_route') == 'signin';
    }

    public function getCredentials(Request $request)
    {
        // todo
        return ['code'=> $request->get('code')];
    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        // todo
       $token =  $this->linkedinProvider ->getAccessTokenFromAPI($credentials['code']);
       $this->linkedinProvider->getUserFromAPI($token);
    }

    public function checkCredentials($credentials, UserInterface $user)
    {
        // todo
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        // todo
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        // todo
    }

    public function start(Request $request, AuthenticationException $authException = null)
    {
        // todo
    }

    public function supportsRememberMe()
    {
        // todo
    }
}
