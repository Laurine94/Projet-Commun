<?php

namespace App\DataFixtures;

use App\Entity\Utilisateur;
use App\Entity\Legume;
use App\Entity\Categorie;
use App\Entity\Association;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
 

class AppFixtures extends Fixture
{
    /**
     *
     * @var UserPasswordEncoderInterface
     */

   private $encoder;
 
   public function __construct(UserPasswordEncoderInterface $encoder)
   {
       $this->encoder=$encoder;
   }

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
         $admin=new Utilisateur();
      
       $admin->setPrenom("Laurine")
           ->setNom("Cousin")
           ->setEmail("laurinec@gmail.com")
           ->setPassword($this->encoder->encodePassword($admin, 'password'))
           ->setRoles(['ROLE_ADMIN']);

       $manager->persist($admin);

       $cat=new Categorie();
       $cat->setNomCat("Ombellifère");

       $manager->persist($cat);

       $carotte=new Legume();
       $carotte->setNomLeg("Carotte")
                ->setImage("\images\carotte.jpg")
                ->setCategorie($cat);

        $manager->persist($carotte);
        $patate=new Legume();
        $patate->setNomLeg("Patate")
                 ->setImage("\images\patate.jpg")
                 ->setCategorie($cat);
 
         $manager->persist($patate);



         $navet=new Legume();
         $navet->setNomLeg("Navet")
                  ->setImage("\images\'navet.jpg")
                  ->setCategorie($cat);
  
          $manager->persist($navet);

          $asso1= new Association();
          $asso1->setLegume1($carotte)
                ->setLegume2($navet)
                ->setEstBon(true);
        $manager->persist($asso1);
        $manager->flush();
    }
}
