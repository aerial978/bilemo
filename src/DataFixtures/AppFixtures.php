<?php

namespace App\DataFixtures;

use App\Entity\Products;
use Faker\Factory;
use Faker\Generator;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class AppFixtures extends Fixture
{
    public Generator $faker;
    
    public function __construct()
    {
        $this->faker = Factory::create('fr_FR');
    }
    
    public function load(ObjectManager $manager): void
    {
        for($i = 0; $i < 15; $i++) {

            $products = new Products();
            $products->setModel($this->faker->words(5, true));
            $products->setImage($this->faker->word());
            $products->setPrice($this->faker->randomFloat(2, 100, 200));
            $products->setColor($this->faker->word());
            $products->setScreenSize($this->faker->words(3, true));
            $products->setCreatedAt($this->faker->datetimeBetween('-3 month', '-1 month'));
            $products->setUpdatedAt($this->faker->datetimeBetween('-2 month', '-2 weeks'));

            $manager->persist($products);
        }

        $manager->flush();
    }
}
