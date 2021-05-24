<?php

namespace App\Repository;

use App\Entity\Card;
use App\Entity\Product;
use App\Entity\Statistik;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class StatistikRepository extends ServiceEntityRepository
{

    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Statistik::class);
    }

    public function getStatsNative($product){

        $isbn = $product->getIsbnoNoissn();
        $title = $product->getTitle();

        $conn = $this->getEntityManager()->getConnection();
        $sql = $conn->prepare("CALL getStats(:isbn, :title)");
        $sql->bindParam(':isbn', $isbn);
        $sql->bindParam(':title', $title);
        $sql->execute();
        return $sql->fetchAll();
    }

    public function getStats($product){

        $isbn = $product['isbnoNoissn'];
        $title = $product['title'];

        $conn = $this->getEntityManager()->getConnection();
        $sql = $conn->prepare("CALL getStats(:isbn, :title)");
        $sql->bindParam(':isbn', $isbn);
        $sql->bindParam(':title', $title);
        $sql->execute();
        return $sql->fetchAll();
    }

    public function getStatsTotal(){

        $conn = $this->getEntityManager()->getConnection();
        $sql = $conn->prepare("CALL getStatsTotal()");
        $sql->execute();
        return $sql->fetchAll();
    }

    public function getStatsTotalZero(){
        $conn = $this->getEntityManager()->getConnection();
        $sql = $conn->prepare("CALL getStatsTotalZero()");
        $sql->execute();
        return ($sql->fetchAll())[0]['count'];
    }

}
