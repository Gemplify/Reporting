<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CustomerRel
 *
 * @ORM\Table(name="customer_rel")
 * @ORM\Entity
 */
class CustomerRel
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
     * @var string
     *
     * @ORM\Column(name="custtype", type="string", length=255, nullable=false)
     */
    private $custtype;

    /**
     * @var string
     *
     * @ORM\Column(name="customerno", type="string", length=255, nullable=false)
     */
    private $customerno;

    /**
     * @var string
     *
     * @ORM\Column(name="voucheryear", type="string", length=4, nullable=false)
     */
    private $voucheryear;

    /**
     * @var string
     *
     * @ORM\Column(name="customer", type="string", length=255, nullable=false)
     */
    private $customer;


}
