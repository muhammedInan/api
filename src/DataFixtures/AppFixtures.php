<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Product;
use App\Entity\User;
use App\Entity\Client;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        $name = [
            1 => 'iphone 5',
            2 => 'iphone 6',
            3 => 'iphone X',
            4 => 'samsung S5',
            5 => 'samsung S7',
            6 => 'samsung S9',
            7 => 'Xioami note 5',
            8 => 'Xioami Mi 2',
            9 => 'nokia Lumia 830',
            10 => 'Asus Zenphone 3'
        ];

        $memory = [
            1 => 16,
            2 => 64,
            3 => 256,
            4 => 32,
            5 => 32,
            6 => 64,
            7 => 64,
            8 => 128,
            9 => 16,
            10 => 32
        ];

        $processor = [
            1 => '?',
            2 => 'A8',
            3 => '2,39 Mhz',
            4 => '2,5 Mhz',
            5 => '2,3 Mhz',
            6 => '2,7 Mhz',
            7 => '1,8 Mhz',
            8 => 'N.C',
            9 => '1,2 Mhz',
            10 => '1.25 Mhz'
        ];

        $sizeName = count($name);

        for ($i = 1; $i < $sizeName; $i++) {

            $product = new Product();
            $product->setName($name[$i]);
            $product->setMemory($memory[$i]);
            $product->setProcessor($processor[$i]);

            $manager->persist($product);
        }

        $client = new Client();
        $client->setName('Blue Mobile Shop');
        $client->setAdress(' rue test');

        $manager->persist($client);

        $client2 = new Client();
        $client2->setName('Red Mobile Shop');
        $client2->setAdress('red test');

        $manager->persist($client2);
        // Generate demoCustomer's users.
        for ($i = 1; $i <= 20; $i++) {
            $User = new User();
            if ($i < 11) {
                $User->setEmail('demoMail' . $i . '@blueMobileShop.com');
                $User->setFirstName('BlueDemoUser-' . $i . '-FirstName');
                $User->setLastName('BlueDemoUser-' . $i . '-LastName');
                $User->setClient($client);
            } else {
                $User->setEmail('demoMail' . $i . '@redMobileShop.com');
                $User->setFirstName('RedDemoUser' . $i . 'FirstName');
                $User->setLastName('RedDemoUser' . $i . 'LastName');
                $User->setClient($client2);
            }
            $manager->persist($User);
        }
        $manager->flush();
    }
}
