<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    public const USER_REFERENCE = 'user-gary';
    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder) {
        $this->encoder = $encoder;
    }
    public function load(ObjectManager $manager): void
    {

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
        $this->addReference(self::USER_REFERENCE, $user);
        $manager->persist($user);

        for ($i = 0; $i < 10; $i++) {
            $article = new Article();
            $article->setTitle('product '.$i)
                ->setPrice(mt_rand(10, 100))
                ->setDescription('this is an article')
                ->updatedTimestamps();
            $article->setUser($this->getReference(self::USER_REFERENCE));
            $manager->persist($article);
        }

        $manager->flush();
    }
}