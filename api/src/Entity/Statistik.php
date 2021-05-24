<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Statistik
 *
 * @ORM\Table(name="statistik")
 * @ORM\Entity(repositoryClass="App\Repository\StatistikRepository")
 */
class Statistik
{

    const LIMIT = 5;

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
     * @ORM\Column(name="customerno", type="string", length=255, nullable=true)
     */
    private $customerno;

    /**
     * @var string|null
     *
     * @ORM\Column(name="country_inv", type="string", length=30, nullable=true)
     */
    private $countryInv;

    /**
     * @var string|null
     *
     * @ORM\Column(name="invaddressno", type="string", length=255, nullable=true)
     */
    private $invaddressno;

    /**
     * @var string|null
     *
     * @ORM\Column(name="deladdressno", type="string", length=255, nullable=true)
     */
    private $deladdressno;

    /**
     * @var string|null
     *
     * @ORM\Column(name="jahr", type="string", length=255, nullable=true)
     */
    private $jahr;

    /**
     * @var string|null
     *
     * @ORM\Column(name="monat", type="string", length=255, nullable=true)
     */
    private $monat;

    /**
     * @var string|null
     *
     * @ORM\Column(name="postingdate", type="string", length=20, nullable=true)
     */
    private $postingdate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="invoiceno", type="string", length=255, nullable=true)
     */
    private $invoiceno;

    /**
     * @var string|null
     *
     * @ORM\Column(name="quantity", type="string", length=255, nullable=true)
     */
    private $quantity;

    /**
     * @var string|null
     *
     * @ORM\Column(name="isbn", type="string", length=255, nullable=true)
     */
    private $isbn;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ordernumber", type="string", length=255, nullable=true)
     */
    private $ordernumber;

    /**
     * @var string|null
     *
     * @ORM\Column(name="ordertype", type="string", length=255, nullable=true)
     */
    private $ordertype;

    /**
     * @var string|null
     *
     * @ORM\Column(name="orderno", type="string", length=255, nullable=true)
     */
    private $orderno;

    /**
     * @var string|null
     *
     * @ORM\Column(name="price", type="string", length=255, nullable=true)
     */
    private $price;

    /**
     * @var string|null
     *
     * @ORM\Column(name="discount", type="string", length=255, nullable=true)
     */
    private $discount;

    /**
     * @var string|null
     *
     * @ORM\Column(name="netsalesrevenue", type="string", length=255, nullable=true)
     */
    private $netsalesrevenue;

    /**
     * @var string|null
     *
     * @ORM\Column(name="currency", type="string", length=255, nullable=true)
     */
    private $currency;

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
    public function getCustomerno()
    {
        return $this->customerno;
    }

    /**
     * @param null|string $customerno
     */
    public function setCustomerno($customerno)
    {
        $this->customerno = $customerno;
    }

    /**
     * @return null|string
     */
    public function getCountryInv()
    {
        return $this->countryInv;
    }

    /**
     * @param null|string $countryInv
     */
    public function setCountryInv($countryInv)
    {
        $this->countryInv = $countryInv;
    }

    /**
     * @return null|string
     */
    public function getInvaddressno()
    {
        return $this->invaddressno;
    }

    /**
     * @param null|string $invaddressno
     */
    public function setInvaddressno($invaddressno)
    {
        $this->invaddressno = $invaddressno;
    }

    /**
     * @return null|string
     */
    public function getDeladdressno()
    {
        return $this->deladdressno;
    }

    /**
     * @param null|string $deladdressno
     */
    public function setDeladdressno($deladdressno)
    {
        $this->deladdressno = $deladdressno;
    }

    /**
     * @return null|string
     */
    public function getJahr()
    {
        return $this->jahr;
    }

    /**
     * @param null|string $jahr
     */
    public function setJahr($jahr)
    {
        $this->jahr = $jahr;
    }

    /**
     * @return null|string
     */
    public function getMonat()
    {
        return $this->monat;
    }

    /**
     * @param null|string $monat
     */
    public function setMonat($monat)
    {
        $this->monat = $monat;
    }

    /**
     * @return null|string
     */
    public function getPostingdate()
    {
        return $this->postingdate;
    }

    /**
     * @param null|string $postingdate
     */
    public function setPostingdate($postingdate)
    {
        $this->postingdate = $postingdate;
    }

    /**
     * @return null|string
     */
    public function getInvoiceno()
    {
        return $this->invoiceno;
    }

    /**
     * @param null|string $invoiceno
     */
    public function setInvoiceno($invoiceno)
    {
        $this->invoiceno = $invoiceno;
    }

    /**
     * @return null|string
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param null|string $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return null|string
     */
    public function getIsbn()
    {
        return $this->isbn;
    }

    /**
     * @param null|string $isbn
     */
    public function setIsbn($isbn)
    {
        $this->isbn = $isbn;
    }

    /**
     * @return null|string
     */
    public function getOrdernumber()
    {
        return $this->ordernumber;
    }

    /**
     * @param null|string $ordernumber
     */
    public function setOrdernumber($ordernumber)
    {
        $this->ordernumber = $ordernumber;
    }

    /**
     * @return null|string
     */
    public function getOrdertype()
    {
        return $this->ordertype;
    }

    /**
     * @param null|string $ordertype
     */
    public function setOrdertype($ordertype)
    {
        $this->ordertype = $ordertype;
    }

    /**
     * @return null|string
     */
    public function getOrderno()
    {
        return $this->orderno;
    }

    /**
     * @param null|string $orderno
     */
    public function setOrderno($orderno)
    {
        $this->orderno = $orderno;
    }

    /**
     * @return null|string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param null|string $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return null|string
     */
    public function getDiscount()
    {
        return $this->discount;
    }

    /**
     * @param null|string $discount
     */
    public function setDiscount($discount)
    {
        $this->discount = $discount;
    }

    /**
     * @return null|string
     */
    public function getNetsalesrevenue()
    {
        return $this->netsalesrevenue;
    }

    /**
     * @param null|string $netsalesrevenue
     */
    public function setNetsalesrevenue($netsalesrevenue)
    {
        $this->netsalesrevenue = $netsalesrevenue;
    }

    /**
     * @return null|string
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param null|string $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }




}
