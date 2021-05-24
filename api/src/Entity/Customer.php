<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Customer
 *
 * @ORM\Table(name="customer")
 * @ORM\Entity
 */
class Customer
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
     * @ORM\Column(name="customerno", type="string", length=30, nullable=false)
     */
    private $customerno;

    /**
     * @var string|null
     *
     * @ORM\Column(name="selidprofile", type="string", length=255, nullable=true)
     */
    private $selidprofile;

    /**
     * @var string|null
     *
     * @ORM\Column(name="targetidlocation", type="string", length=255, nullable=true)
     */
    private $targetidlocation;

    /**
     * @var string|null
     *
     * @ORM\Column(name="idlocation", type="string", length=255, nullable=true)
     */
    private $idlocation;

    /**
     * @var string|null
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     */
    private $email;

    /**
     * @var string|null
     *
     * @ORM\Column(name="titlea", type="string", length=255, nullable=true)
     */
    private $titlea;

    /**
     * @var string|null
     *
     * @ORM\Column(name="firstnamea", type="string", length=255, nullable=true)
     */
    private $firstnamea;

    /**
     * @var string|null
     *
     * @ORM\Column(name="prefixa", type="string", length=255, nullable=true)
     */
    private $prefixa;

    /**
     * @var string|null
     *
     * @ORM\Column(name="namea", type="string", length=255, nullable=true)
     */
    private $namea;

    /**
     * @var string|null
     *
     * @ORM\Column(name="addresseeaddon1", type="string", length=255, nullable=true)
     */
    private $addresseeaddon1;

    /**
     * @var string|null
     *
     * @ORM\Column(name="addresseeaddon2", type="string", length=255, nullable=true)
     */
    private $addresseeaddon2;

    /**
     * @var string|null
     *
     * @ORM\Column(name="addresseeaddon3", type="string", length=255, nullable=true)
     */
    private $addresseeaddon3;

    /**
     * @var string|null
     *
     * @ORM\Column(name="institutiona", type="string", length=255, nullable=true)
     */
    private $institutiona;

    /**
     * @var string|null
     *
     * @ORM\Column(name="departmenta", type="string", length=255, nullable=true)
     */
    private $departmenta;

    /**
     * @var string|null
     *
     * @ORM\Column(name="subdepartmenta", type="string", length=255, nullable=true)
     */
    private $subdepartmenta;

    /**
     * @var string|null
     *
     * @ORM\Column(name="subdepartment2a", type="string", length=255, nullable=true)
     */
    private $subdepartment2a;

    /**
     * @var string|null
     *
     * @ORM\Column(name="titleb", type="string", length=255, nullable=true)
     */
    private $titleb;

    /**
     * @var string|null
     *
     * @ORM\Column(name="firstnameb", type="string", length=255, nullable=true)
     */
    private $firstnameb;

    /**
     * @var string|null
     *
     * @ORM\Column(name="prefixb", type="string", length=255, nullable=true)
     */
    private $prefixb;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nameb", type="string", length=255, nullable=true)
     */
    private $nameb;

    /**
     * @var string|null
     *
     * @ORM\Column(name="institutionb", type="string", length=255, nullable=true)
     */
    private $institutionb;

    /**
     * @var string|null
     *
     * @ORM\Column(name="departmentb", type="string", length=255, nullable=true)
     */
    private $departmentb;

    /**
     * @var string|null
     *
     * @ORM\Column(name="subdepartmentb", type="string", length=255, nullable=true)
     */
    private $subdepartmentb;

    /**
     * @var string|null
     *
     * @ORM\Column(name="subdepartment2b", type="string", length=255, nullable=true)
     */
    private $subdepartment2b;

    /**
     * @var string|null
     *
     * @ORM\Column(name="postalcode", type="string", length=255, nullable=true)
     */
    private $postalcode;

    /**
     * @var string|null
     *
     * @ORM\Column(name="city", type="string", length=255, nullable=true)
     */
    private $city;

    /**
     * @var string|null
     *
     * @ORM\Column(name="citydistrict", type="string", length=255, nullable=true)
     */
    private $citydistrict;

    /**
     * @var string|null
     *
     * @ORM\Column(name="street", type="string", length=255, nullable=true)
     */
    private $street;

    /**
     * @var string|null
     *
     * @ORM\Column(name="streetnumber", type="string", length=255, nullable=true)
     */
    private $streetnumber;

    /**
     * @var string|null
     *
     * @ORM\Column(name="addressaddon", type="string", length=255, nullable=true)
     */
    private $addressaddon;

    /**
     * @var string|null
     *
     * @ORM\Column(name="addressaddon2", type="string", length=255, nullable=true)
     */
    private $addressaddon2;

    /**
     * @var string|null
     *
     * @ORM\Column(name="addressaddon3", type="string", length=255, nullable=true)
     */
    private $addressaddon3;

    /**
     * @var string|null
     *
     * @ORM\Column(name="postofficedescr", type="string", length=255, nullable=true)
     */
    private $postofficedescr;

    /**
     * @var string|null
     *
     * @ORM\Column(name="poboxnumber", type="string", length=255, nullable=true)
     */
    private $poboxnumber;

    /**
     * @var string|null
     *
     * @ORM\Column(name="country", type="string", length=255, nullable=true)
     */
    private $country;

    /**
     * @var string|null
     *
     * @ORM\Column(name="state", type="string", length=255, nullable=true)
     */
    private $state;

    /**
     * @var string|null
     *
     * @ORM\Column(name="termstate", type="string", length=255, nullable=true)
     */
    private $termstate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="label", type="string", length=255, nullable=true)
     */
    private $label;

    /**
     * @var string|null
     *
     * @ORM\Column(name="anrede", type="string", length=255, nullable=true)
     */
    private $anrede;

    /**
     * @var string|null
     *
     * @ORM\Column(name="fax", type="string", length=255, nullable=true)
     */
    private $fax;

    /**
     * @var string|null
     *
     * @ORM\Column(name="url", type="string", length=255, nullable=true)
     */
    private $url;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mobilphone", type="string", length=255, nullable=true)
     */
    private $mobilphone;

    /**
     * @var string|null
     *
     * @ORM\Column(name="tel", type="string", length=255, nullable=true)
     */
    private $tel;

    /**
     * @var string|null
     *
     * @ORM\Column(name="externalreferencenumber", type="string", length=255, nullable=true)
     */
    private $externalreferencenumber;

    /**
     * @var string|null
     *
     * @ORM\Column(name="idprofilesource", type="string", length=255, nullable=true)
     */
    private $idprofilesource;

    /**
     * @var string|null
     *
     * @ORM\Column(name="personinstitution", type="string", length=255, nullable=true)
     */
    private $personinstitution;

    /**
     * @var string|null
     *
     * @ORM\Column(name="idjuristicperson", type="string", length=255, nullable=true)
     */
    private $idjuristicperson;

    /**
     * @var string|null
     *
     * @ORM\Column(name="deliveryaddinfo", type="string", length=255, nullable=true)
     */
    private $deliveryaddinfo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="personinstitution2", type="string", length=255, nullable=true)
     */
    private $personinstitution2;

    /**
     * @var string|null
     *
     * @ORM\Column(name="campaignnoinfo", type="string", length=255, nullable=true)
     */
    private $campaignnoinfo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="idjuristicpersonb", type="string", length=255, nullable=true)
     */
    private $idjuristicpersonb;


}
