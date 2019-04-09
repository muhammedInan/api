<?php

namespace App\Security;

use App\Entity\User;
use GuzzleHttp\Client;
use JMS\Serializer\Serializer;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use App\Utils\HttpRequest;
use http\Exception\BadConversionException;

class LinkedinProvider implements UserProviderInterface
{
    private $client;

   public function loadUserByUsername($username)
    {
        $url = 'https://www.linkedin.com/oauth/v2/accessToken='.$username;

        $response = $this->client->get($url);
        $res = $response->getBody()->getContents();
        $userData = $this->serializer->deserialize($res, 'array', 'json');

        if (!$userData) {
            throw new \LogicException('Did not managed to get your user info from Github.');
        }

        $user = new User($username, null);

        return $user;
    }

    public function refreshUser(UserInterface $user)
    {
        $class = get_class($user);
        if (!$this->supportsClass($class)) {
            throw new UnsupportedUserException();
        }

        return $user;
    }


    public function getUser(string $code)
    {
        $token = $this->getAccessTokenFromAPI($code);

        return $this->getAccessTokenFromAPI($token);
    }

    public function getAccessTokenFromAPI(string $code): string
    {
    
        $client = new \GuzzleHttp\Client();
          $response = $client->request('POST', 'https://www.linkedin.com/oauth/v2/accessToken', [
          'form_params' => [
            'client_id' => '',
            'client_secret' => '',
            'code' => $code,
            'redirect_uri' => 'http://127.0.0.1:8000/api/signin',
            'grant_type' => 'authorization_code',
    ]
]);

$body = $response->getBody()->getContents();
 

       
         $accesstoken = json_decode($body, TRUE);
        $token = $accesstoken['access_token'];
        if (!isset($token)){
            throw new BadConversionException('No access_token returned by Linkedin. Start ever the process.');
        }
        return $token;
        }

    public function getUserFromAPI(string $token)
    {
        dd($token);
        $client = new \GuzzleHttp\Client();

        $response = $client->request('GET','https://api.linkedin.com/v2/me', [
            'headers' =>[
                'Authorization' => 'Bearer '.$token
            ]]);

            $body = $response->getBody()->getContents();
            dd($body);

        if (empty($response)){
            throw new \LogicException('Did not managed to get your user into from Linkedin');
        }

        $data = \json_decode($response, true);

        $user = new User();
        $user->setEmail('toto');
    }

    public function supportsClass($class)
    {
        return 'App\Entity\User' === $class;
        ///return 'Symfony\Component\Security\Core\User\User' === $class;
    }


}