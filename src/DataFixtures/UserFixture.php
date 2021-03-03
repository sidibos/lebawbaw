<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixture extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        //$user = (new User());
        //$user = $manager->getRepository(User::class)->
        //$plainPassword = 'testpass';
        //$encoded = $this->passwordEncoder->encodePassword($user, $plainPassword);
        
        $user = (new User())
        ->setFirstName('Test1')->setLastName('Test 2')
        ->setEmail('msidibe@gmail.com');
        $plainPassword = 'testpass';
        $encoded = $this->passwordEncoder->encodePassword($user, $plainPassword);
        var_dump($encoded);die;
        //->setCounty($manager->getRepository(County::class);

        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'testpass'
        ));

        $manager->persist($user);

        $manager->flush();
    }
}
