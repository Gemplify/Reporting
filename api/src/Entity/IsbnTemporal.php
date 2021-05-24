<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IsbnTemporal
 *
 * @ORM\Table(name="isbn_temporal")
 * @ORM\Entity
 */
class IsbnTemporal
{

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="isbno_noissn", type="string", length=255, nullable=true)
     */
    private $isbnoNoissn;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return null|string
     */
    public function getIsbnoNoissn()
    {
        return $this->isbnoNoissn;
    }

    /**
     * @param null|string $isbnoNoissn
     */
    public function setIsbnoNoissn($isbnoNoissn)
    {
        $this->isbnoNoissn = $isbnoNoissn;
    }



}
