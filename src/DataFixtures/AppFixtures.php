<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\GrandPrix;
use App\Entity\Image;
use App\Entity\Pilote;
use App\Entity\Stats;
use App\Entity\Team;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{

    private $encoder;
    private $gp;

    public function __construct(UserPasswordEncoderInterface $encoder){
        $this->encoder = $encoder;
    
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('FR-fr');

        $adminUser = new User();
        $adminUser->setFirstName('Maxime')
                ->setLastName('Dumoulin')
                ->setEmail('admin@f1.be')
                ->setPassword($this->encoder->encodePassword($adminUser,'password'))
                ->setRoles(['ROLE_ADMIN']);
        $manager->persist($adminUser);


        // gestion des Grands-Prix

        for($i=1 ; $i <= 18; $i++){
            $gp = new GrandPrix();

            $title = $faker->country();
            $dategp =mt_rand(2014,2019);
            $laps =mt_rand(44,78);
            $turns =mt_rand(12,21);
            $km =mt_rand(3.500,7.500);
            $map = 'https://upload.wikimedia.org/wikipedia/commons/thumb/1/11/Circuit_Spa_2007.png/280px-Circuit_Spa_2007.png';
            $description ="<p>".join("</p><p>",$faker->paragraphs(3))."</p>";
            $covergp = $faker->imageUrl(1920,1080);

            $gp->setTitle($title." Grand-Prix")
               ->setDate($dategp)
               ->setMap($map)
               ->setDescription($description)
               ->setCover($covergp)
               ->setLaps($laps)
               ->setKm($km)
               ->setTurns($turns);
              
               
        //gestion des images des Grands-Prix

         for($j=1; $j <= mt_rand(2,5) ; $j++){

            $gallery = new Image();

            $gallery->setUrl($faker->imageUrl(650,300))
                ->setCaption($faker->sentence())
                ->setGrandprix($gp);
                
            $manager->persist($gallery);
        } 



            $this->gp=$gp;
                $manager->persist($gp); 

        }   
      
        // gestion des teams

        for($i=1 ; $i <= 10; $i++){
            $team = new Team();


            $nomteam = 'ferrari';
            $moteur = 'ferrari';
            $pays = $faker->country();
            $cover = $faker->imageUrl(150,200);
            $championteam = mt_rand(0,30);
            $championteampilote = mt_rand(0,30);
            $winsT = mt_rand(0,500);
            $polesT = mt_rand(0,500);
            $descriptiont ="<p>".join("</p><p>",$faker->paragraphs(3))."</p>"; 
            

            

            $team->setNom($nomteam)
                 ->setMoteur($moteur)
                 ->setPays($pays)
                 ->setCover($cover)
                 ->setChampion($championteam)
                 ->setWins($winsT)
                 ->setPoles($polesT)
                 ->setChampionpilote($championteampilote);
            

                 $manager->persist($team); 
               
                 // gestion des Pilotes

         for($p=1 ; $p <=2; $p++){
            $pilote = new Pilote();

            $prenom = $faker->firstName();
            $nom = $faker->lastName();
            $picture = $faker->imageUrl(150,200);
            $datenaissance =$faker->DateTime();
            $nationalite = $faker->country();
            $actif = $faker->boolean($chanceOfGettingTrue = 50);
            $wins =mt_rand(0,78);
            $poles =mt_rand(0,80);
            $champion =mt_rand(0,8);  
            $descriptionp ="<p>".join("</p><p>",$faker->paragraphs(3))."</p>"; 
            

            $pilote->setprenom($prenom)
               ->setNom($nom)
               ->setDatenaissance($datenaissance)
               ->setNationalite($nationalite)
               ->setActif($actif)
               ->setPicture($picture)
               ->setTeam($team)
               ->setWins($wins)
               ->setPoles($poles)
               ->setChampion($champion);

               

                // gestion des Stats

        for($m=1 ; $m <= 1; $m++){ 

            $stats = new Stats();
        $mytime=mt_rand(20,25);
        $myminute=mt_rand(30,59);
            $chrono="1:$mytime'$myminute.256";
            
            
           
            

            $stats->setTeam($team)
                ->setChrono($chrono)
               ->setDate($this->gp)
               ->setPilote($pilote)
               ->setGrandPrix($this->gp);
               
               
               $manager->persist($stats); 

        }


               
               $manager->persist($pilote); 

        } 

            

               

        } 


       
    
        
        $manager->flush();
    }
}
