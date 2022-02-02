<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder) {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 10; $i++) {
            $article = new Article();
            $article->setTitle('product '.$i)
                ->setPrice(mt_rand(10, 100))
                ->setDescription('this is an article')
                ->updatedTimestamps();
            $manager->persist($article);
        }

        $admin = new User();
        $plainPassword = 'password';
        $encoded = $this->encoder->encodePassword($admin, $plainPassword);
        $admin->setPassword($encoded)
            ->setEmail('admin@admin.fr')
            ->setRoles(["ROLE_ADMIN", "ROLE_USER"]);
        $manager->persist($admin);


        $user = new User();
        $plainPassword = 'password';
        $encoded = $this->encoder->encodePassword($user, $plainPassword);
        $user->setPassword($encoded)
            ->setEmail('user@user.fr')
            ->setRoles(["ROLE_USER"]);
        $manager->persist($user);

        $manager->flush();
    }
}