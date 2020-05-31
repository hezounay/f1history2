<?php 

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;

class OrderService{

    private $manager;

    public function __construct(EntityManagerInterface $manager){
        $this->manager = $manager;
    }

    public function getChronoOrderByAsc(){
        return $this->manager->createQuery('SELECT chrono  FROM App\Entity\Stats ORDER BY(chrono) ASC')->getSingleScalarResult();
    }

}