<?php

namespace App\DataFixtures;

use App\Entity\Brands;
use App\Entity\Clients;
use App\Entity\Conditions;
use App\Entity\Products;
use App\Entity\Users;
use App\Utils\FakerGenerator;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private $userPasswordHasher;
    private $fakerGenerator;

    public function __construct(UserPasswordHasherInterface $userPasswordHasher, FakerGenerator $fakerGenerator)
    {
        $this->userPasswordHasher = $userPasswordHasher;
        $this->fakerGenerator = $fakerGenerator;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $uniqueConditions = [];

        while (count($uniqueConditions) < 2) {
            $condition = $this->fakerGenerator->mobileCondition();

            if (!in_array($condition, $uniqueConditions)) {
                $uniqueConditions[] = $condition;
                $conditions = new Conditions();
                $conditions->setName($condition);
                $manager->persist($conditions);

                $listConditions[] = $conditions;
            }
        }

        $uniqueBrands = []; // Initialise un tableau vide pour stocker les marques uniques.

        while (count($uniqueBrands) < 10) { // Démarre une boucle tant que le nombre de marques uniques dans le tableau est inférieur à 10.
            $brand = $this->fakerGenerator->mobileBrand(); // Génère une marque de téléphone mobile aléatoire.

            if (!in_array($brand, $uniqueBrands)) { // Vérifie si la marque générée n'est pas déjà présente dans le tableau des marques uniques.
                $uniqueBrands[] = $brand; // Ajoute la marque générée au tableau des marques uniques.
                $brands = new Brands(); // Crée une nouvelle instance de l'entité Brands.
                $brands->setName($brand); // Définit le nom de la marque dans l'instance Brands avec la valeur générée.
                $manager->persist($brands); // Persiste l'instance Brands dans la base de données.

                $listBrands[] = $brands; // Ajoute l'instance Brands à un tableau $listBrands (peut être utilisé ultérieurement).
            }
        }

        for ($i = 0; $i < 50; ++$i) {
            $products = new Products();
            $brand = $listBrands[array_rand($listBrands)]; // Sélectionnez une marque aléatoire
            $model = $this->fakerGenerator->mobileModel($brand->getName()); // Générez un modèle aléatoire en fonction de la marque

            $products->setBrand($brand);
            $products->setConditions($listConditions[array_rand($listConditions)]);
            $products->setModel($model); // Définissez le modèle généré
            $products->setSlug($model);
            $products->setPrice($faker->randomFloat(2, 100, 400));
            $products->setColor($this->fakerGenerator->mobileColor());
            $products->setScreenSize($this->fakerGenerator->mobileScreenSize());
            $products->setCreatedAt($faker->datetimeBetween('-3 month', '-1 month'));
            $products->setUpdatedAt($faker->datetimeBetween('-2 month', '-2 weeks'));
            $manager->persist($products);

            $listProducts[] = $products;
        }

        for ($i = 0; $i < 5; ++$i) {
            $clients = new Clients();
            $clients->setEmail($faker->email());
            $clients->setRoles(['ROLE_CLIENT']);
            $clients->setPassword($this->userPasswordHasher->hashPassword($clients, 'password'));

            $manager->persist($clients);

            $listClients[] = $clients;
        }

        for ($i = 0; $i <= 20; ++$i) {
            $users = new Users();
            $users->setClient($listClients[array_rand($listClients)]);
            $users->setLastName($faker->lastName());
            $users->setFirstName($faker->firstName());
            $users->setEmail($faker->email());
            $phoneNumber = '0'.$faker->randomNumber(9, true);
            $users->setPhoneNumber($phoneNumber);
            $users->setCreatedAt($faker->datetimeBetween('-5 years', '-1 month'));
            $users->setUpdatedAt($faker->datetimeBetween('-4 years', '-1 year'));
            $manager->persist($users);
        }

        $manager->flush();
    }
}
