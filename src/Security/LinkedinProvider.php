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
        //return new User($userData['login'], $userData['name'], $userData['email'], $userData['avatar_url'], $userData['html_url']);
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
            'client_id' => '86rp8hhouxo716',
            'client_secret' => '2rbAb7HegC2c4Yg0',
            'code' => $code,
            'redirect_uri' => 'http://127.0.0.1:8000/api/signin',
            'grant_type' => 'authorization_code',
    ]
]);//dd($response->getBody()->getContents()); $url, $data

        $client = new Client();
        $body = $client->post()->getBody($response)->getContents();
        
        $result = $req->execute();
        $accesstoken = json_decode($result);
        
        $data = sprintf(' https://github.com/login/oauth/authorize');
        $this->githubClientId;
        $this->githubClilentSecret;
        $code;
           urlencode("http://localhost:8000/login_check");

        $body = $this->client()->post($data)->getBody()->getContents();

        $tab = explode("-", $body);
        $token = explode("&", $tab[1]);
        $token = $token[0];
        if (!isset($token)){
            throw new BadConversionException('No access_token returned by Github. Start ever the process.');

        }
        return $token;
        }

    public function getUserFromAPI(string $token)
    {
        $response =
            $this->client()
                ->get("https://api.github.com/user?access token".$token)
                ->getBody()
                ->getContents();

        if (empty($response)){
            throw new \LogicException('Did not managed to get your user into from Github');
        }

        $data = \json_decode($response, true);

        $user = new User();
        $user->setEmail();
    }

    public function supportsClass($class)
    {
        return 'App\Entity\User' === $class;
        ///return 'Symfony\Component\Security\Core\User\User' === $class;
    }


}