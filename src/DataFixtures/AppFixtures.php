<?php

namespace App\DataFixtures;

use App\Entity\Brands;
use App\Entity\Clients;
use App\Entity\Conditions;
use App\Entity\Products;
use App\Entity\Users;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Faker\Generator;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public Generator $faker;
    private $userPasswordHasher;

    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->faker = Factory::create('fr_FR');
        $this->userPasswordHasher = $userPasswordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 2; ++$i) {
            $conditions = new Conditions();
            $conditions->setName($this->faker->word());
            $manager->persist($conditions);

            $listConditions[] = $conditions;
        }

        for ($i = 0; $i < 10; ++$i) {
            $brands = new Brands();
            $brands->setName($this->faker->word());
            $manager->persist($brands);

            $listBrands[] = $brands;
        }

        for ($i = 0; $i < 15; ++$i) {
            $products = new Products();
            $products->setBrand($listBrands[array_rand($listBrands)]);
            $products->setConditions($listConditions[array_rand($listConditions)]);
            $products->setModel($this->faker->words(5, true));
            $products->setImage($this->faker->word());
            $products->setPrice($this->faker->randomFloat(2, 100, 200));
            $products->setColor($this->faker->word());
            $products->setScreenSize($this->faker->words(3, true));
            $products->setCreatedAt($this->faker->datetimeBetween('-3 month', '-1 month'));
            $products->setUpdatedAt($this->faker->datetimeBetween('-2 month', '-2 weeks'));
            $manager->persist($products);

            $listProducts[] = $products;
        }

        for ($i = 0; $i < 5; ++$i) {
            $clients = new Clients();
            $clients->setEmail($this->faker->email());
            $clients->setRoles(['ROLE_USER']);
            $clients->setPassword($this->userPasswordHasher->hashPassword($clients, 'password'));

            $manager->persist($clients);

            $listClients[] = $clients;
        }

        for ($i = 0; $i <= 20; ++$i) {
            $users = new Users();
            $users->setClient($listClients[array_rand($listClients)]);
            $users->setLastName($this->faker->lastName());
            $users->setFirstName($this->faker->firstName());
            $users->setEmail($this->faker->email());
            $users->setPhoneNumber($this->faker->phoneNumber());
            $users->setCreatedAt($this->faker->datetimeBetween('-5 years', '-1 month'));
            $manager->persist($users);
        }

        $manager->flush();
    }
}
