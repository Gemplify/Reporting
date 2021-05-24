<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PendingStatistik
 *
 * @ORM\Table(name="pending_statistik")
 * @ORM\Entity
 */
class PendingStatistik
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
     * @ORM\Column(name="orderdate", type="string", length=255, nullable=true)
     */
    private $orderdate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ordermark", type="string", length=255, nullable=true)
     */
    private $ordermark;

    /**
     * @var string|null
     *
     * @ORM\Column(name="valutadate", type="string", length=255, nullable=true)
     */
    private $valutadate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="valuta", type="string", length=255, nullable=true)
     */
    private $valuta;

    /**
     * @var string|null
     *
     * @ORM\Column(name="discount", type="string", length=255, nullable=true)
     */
    private $discount;

    /**
     * @var string|null
     *
     * @ORM\Column(name="plandeliverydate", type="string", length=255, nullable=true)
     */
    private $plandeliverydate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="isbnorderno", type="string", length=255, nullable=true)
     */
    private $isbnorderno;

    /**
     * @var string|null
     *
     * @ORM\Column(name="isbn", type="string", length=255, nullable=true)
     */
    private $isbn;

    /**
     * @var string|null
     *
     * @ORM\Column(name="binding", type="string", length=255, nullable=true)
     */
    private $binding;

    /**
     * @var string|null
     *
     * @ORM\Column(name="pubdate", type="string", length=255, nullable=true)
     */
    private $pubdate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="orderno", type="string", length=255, nullable=true)
     */
    private $orderno;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mandator", type="string", length=255, nullable=true)
     */
    private $mandator;

    /**
     * @var string|null
     *
     * @ORM\Column(name="groupofcompany", type="string", length=255, nullable=true)
     */
    private $groupofcompany;

    /**
     * @var string|null
     *
     * @ORM\Column(name="orderquantity", type="string", length=255, nullable=true)
     */
    private $orderquantity;

    /**
     * @var string|null
     *
     * @ORM\Column(name="orderid", type="string", length=255, nullable=true)
     */
    private $orderid;

    /**
     * @var string|null
     *
     * @ORM\Column(name="partquantity", type="string", length=255, nullable=true)
     */
    private $partquantity;

    /**
     * @var string|null
     *
     * @ORM\Column(name="customerno", type="string", length=255, nullable=true)
     */
    private $customerno;

    /**
     * @var string|null
     *
     * @ORM\Column(name="shorttitle", type="string", length=255, nullable=true)
     */
    private $shorttitle;

    /**
     * @var string|null
     *
     * @ORM\Column(name="jpinfoadrinfo", type="string", length=255, nullable=true)
     */
    private $jpinfoadrinfo;


}
