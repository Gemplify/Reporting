<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Product
 *
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
{

    const LIMIT = 30;
    const CURRENCY = [
        'EUR' => 1.10,
        'EURA' => 1.10,
        'EURD' => 1.10,
        'GBP' => 1.28,
        'CHF' => 1,
        'USD' => 1,
    ];
    const LANGUAGE = 1;
    const VERSIONS = 2;
    const DIVISIONS = 3;
    const TITLE = 4;
    const ISBN = 5;
    const EDITOR = 13;
    const SUBJECTGROUP = 14;
    const AVAILABILITY = 15;
    const SERIESTITLE = 16;
    const AUTHOR = 17;
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
     * @ORM\Column(name="isbno_noissn", type="string", length=30, nullable=true)
     */
    private $isbnoNoissn;

    /**
     * @var string|null
     *
     * @ORM\Column(name="editionno", type="string", length=2, nullable=true)
     */
    private $editionno;

    /**
     * @var string|null
     *
     * @ORM\Column(name="project_no", type="string", length=20, nullable=true)
     */
    private $projectNo;

    /**
     * @var string|null
     *
     * @ORM\Column(name="prdsrl", type="string", length=255, nullable=true)
     */
    private $prdsrl;

    /**
     * @var string|null
     *
     * @ORM\Column(name="publisher", type="string", length=20, nullable=true)
     */
    private $publisher;

    /**
     * @var string|null
     *
     * @ORM\Column(name="pub_date", type="string", length=15, nullable=true)
     */
    private $pubDate;

    /**
     * @var string|null
     *
     * @ORM\Column(name="author", type="string", length=50, nullable=true)
     */
    private $author;

    /**
     * @var string|null
     *
     * @ORM\Column(name="title", type="string", length=255, nullable=true)
     */
    private $title;

    /**
     * @var string|null
     *
     * @ORM\Column(name="subtitle", type="string", length=255, nullable=true)
     */
    private $subtitle;

    /**
     * @var string|null
     *
     * @ORM\Column(name="shorttitle", type="string", length=255, nullable=true)
     */
    private $shorttitle;

    /**
     * @var string|null
     *
     * @ORM\Column(name="authors", type="string", length=255, nullable=true)
     */
    private $authors;

    /**
     * @var string|null
     *
     * @ORM\Column(name="editors", type="string", length=255, nullable=true)
     */
    private $editors;

    /**
     * @var string|null
     *
     * @ORM\Column(name="divisionms_type", type="string", length=255, nullable=true)
     */
    private $divisionmsType;

    /**
     * @var string|null
     *
     * @ORM\Column(name="subjectgroup", type="string", length=255, nullable=true)
     */
    private $subjectgroup;

    /**
     * @var string|null
     *
     * @ORM\Column(name="language", type="string", length=15, nullable=true)
     */
    private $language;

    /**
     * @var string|null
     *
     * @ORM\Column(name="acqeditor", type="string", length=255, nullable=true)
     */
    private $acqeditor;

    /**
     * @var string|null
     *
     * @ORM\Column(name="pubyear", type="string", length=4, nullable=true)
     */
    private $pubyear;

    /**
     * @var string|null
     *
     * @ORM\Column(name="pubmonth", type="string", length=5, nullable=true)
     */
    private $pubmonth;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mainthemacode", type="string", length=255, nullable=true)
     */
    private $mainthemacode;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mainthematext", type="string", length=255, nullable=true)
     */
    private $mainthematext;

    /**
     * @var string|null
     *
     * @ORM\Column(name="themacode2", type="string", length=255, nullable=true)
     */
    private $themacode2;

    /**
     * @var string|null
     *
     * @ORM\Column(name="thematext2", type="string", length=255, nullable=true)
     */
    private $thematext2;

    /**
     * @var string|null
     *
     * @ORM\Column(name="themacode3", type="string", length=255, nullable=true)
     */
    private $themacode3;

    /**
     * @var string|null
     *
     * @ORM\Column(name="thematext3", type="string", length=255, nullable=true)
     */
    private $thematext3;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mainbiccode", type="string", length=255, nullable=true)
     */
    private $mainbiccode;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mainbictext", type="string", length=255, nullable=true)
     */
    private $mainbictext;

    /**
     * @var string|null
     *
     * @ORM\Column(name="biccode2", type="string", length=255, nullable=true)
     */
    private $biccode2;

    /**
     * @var string|null
     *
     * @ORM\Column(name="bictext2", type="string", length=255, nullable=true)
     */
    private $bictext2;

    /**
     * @var string|null
     *
     * @ORM\Column(name="biccode3", type="string", length=255, nullable=true)
     */
    private $biccode3;

    /**
     * @var string|null
     *
     * @ORM\Column(name="bictext3", type="string", length=255, nullable=true)
     */
    private $bictext3;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mainbisaccode", type="string", length=255, nullable=true)
     */
    private $mainbisaccode;

    /**
     * @var string|null
     *
     * @ORM\Column(name="mainbisactext", type="string", length=255, nullable=true)
     */
    private $mainbisactext;

    /**
     * @var string|null
     *
     * @ORM\Column(name="bisaccode2", type="string", length=255, nullable=true)
     */
    private $bisaccode2;

    /**
     * @var string|null
     *
     * @ORM\Column(name="bisactext2", type="string", length=255, nullable=true)
     */
    private $bisactext2;

    /**
     * @var string|null
     *
     * @ORM\Column(name="bisaccode3", type="string", length=255, nullable=true)
     */
    private $bisaccode3;

    /**
     * @var string|null
     *
     * @ORM\Column(name="bisactext3", type="string", length=255, nullable=true)
     */
    private $bisactext3;

    /**
     * @var string|null
     *
     * @ORM\Column(name="availability", type="string", length=255, nullable=true)
     */
    private $availability;

    /**
     * @var string|null
     *
     * @ORM\Column(name="editionsizeplanned", type="string", length=255, nullable=true)
     */
    private $editionsizeplanned;

    /**
     * @var string|null
     *
     * @ORM\Column(name="seriestitle", type="string", length=255, nullable=true)
     */
    private $seriestitle;

    /**
     * @var string|null
     *
     * @ORM\Column(name="seriessubtitle", type="string", length=255, nullable=true)
     */
    private $seriessubtitle;

    /**
     * @var string|null
     *
     * @ORM\Column(name="seriescode", type="string", length=255, nullable=true)
     */
    private $seriescode;

    /**
     * @var string|null
     *
     * @ORM\Column(name="seriesissn", type="string", length=255, nullable=true)
     */
    private $seriesissn;

    /**
     * @var string|null
     *
     * @ORM\Column(name="volumeno", type="string", length=255, nullable=true)
     */
    private $volumeno;

    /**
     * @var string|null
     *
     * @ORM\Column(name="maindesc", type="string", length=255, nullable=true)
     */
    private $maindesc;

    /**
     * @var string|null
     *
     * @ORM\Column(name="shortdesc", type="string", length=255, nullable=true)
     */
    private $shortdesc;

    /**
     * @var string|null
     *
     * @ORM\Column(name="toc", type="string", length=255, nullable=true)
     */
    private $toc;

    /**
     * @var string|null
     *
     * @ORM\Column(name="authorsbio", type="string", length=255, nullable=true)
     */
    private $authorsbio;

    /**
     * @var string|null
     *
     * @ORM\Column(name="awards", type="string", length=255, nullable=true)
     */
    private $awards;

    /**
     * @var string|null
     *
     * @ORM\Column(name="pricesfr", type="string", length=255, nullable=true)
     */
    private $pricesfr;

    /**
     * @var string|null
     *
     * @ORM\Column(name="priceeur_d", type="string", length=255, nullable=true)
     */
    private $priceeurD;

    /**
     * @var string|null
     *
     * @ORM\Column(name="priceeur_a", type="string", length=255, nullable=true)
     */
    private $priceeurA;

    /**
     * @var string|null
     *
     * @ORM\Column(name="priceeur", type="string", length=255, nullable=true)
     */
    private $priceeur;

    /**
     * @var string|null
     *
     * @ORM\Column(name="pricegbp", type="string", length=255, nullable=true)
     */
    private $pricegbp;

    /**
     * @var string|null
     *
     * @ORM\Column(name="priceusd", type="string", length=255, nullable=true)
     */
    private $priceusd;

    /**
     * @var string|null
     *
     * @ORM\Column(name="version", type="string", length=255, nullable=true)
     */
    private $version;

    /**
     * @var string|null
     *
     * @ORM\Column(name="binding", type="string", length=255, nullable=true)
     */
    private $binding;

    /**
     * @var string|null
     *
     * @ORM\Column(name="pages", type="string", length=255, nullable=true)
     */
    private $pages;

    /**
     * @var string|null
     *
     * @ORM\Column(name="pagesapprox", type="string", length=255, nullable=true)
     */
    private $pagesapprox;

    /**
     * @var string|null
     *
     * @ORM\Column(name="format", type="string", length=255, nullable=true)
     */
    private $format;

    /**
     * @var string|null
     *
     * @ORM\Column(name="weight", type="string", length=255, nullable=true)
     */
    private $weight;

    /**
     * @var string|null
     *
     * @ORM\Column(name="illuscolour", type="string", length=255, nullable=true)
     */
    private $illuscolour;

    /**
     * @var string|null
     *
     * @ORM\Column(name="illusblackandwhite", type="string", length=255, nullable=true)
     */
    private $illusblackandwhite;

    /**
     * @var string|null
     *
     * @ORM\Column(name="productlink", type="string", length=255, nullable=true)
     */
    private $productlink;

    /**
     * @var string|null
     *
     * @ORM\Column(name="pre_pubprice_chf", type="string", length=255, nullable=true)
     */
    private $prePubpriceChf;

    /**
     * @var string|null
     *
     * @ORM\Column(name="subscriptionprice_chf", type="string", length=30, nullable=true)
     */
    private $subscriptionpriceChf;

    /**
     * @var string|null
     *
     * @ORM\Column(name="specialprice_chf", type="string", length=30, nullable=true)
     */
    private $specialpriceChf;

    /**
     * @var string|null
     *
     * @ORM\Column(name="multi_userpricelibrary_chf", type="string", length=30, nullable=true)
     */
    private $multiUserpricelibraryChf;

    /**
     * @var string|null
     *
     * @ORM\Column(name="chapterprice_chf", type="string", length=30, nullable=true)
     */
    private $chapterpriceChf;

    /**
     * @var string|null
     *
     * @ORM\Column(name="pre_pubprice_eur", type="string", length=30, nullable=true)
     */
    private $prePubpriceEur;

    /**
     * @var string|null
     *
     * @ORM\Column(name="subscriptionprice_eur", type="string", length=30, nullable=true)
     */
    private $subscriptionpriceEur;

    /**
     * @var string|null
     *
     * @ORM\Column(name="specialprice_eur", type="string", length=30, nullable=true)
     */
    private $specialpriceEur;

    /**
     * @var string|null
     *
     * @ORM\Column(name="multi_userpricelibrary_eur", type="string", length=30, nullable=true)
     */
    private $multiUserpricelibraryEur;

    /**
     * @var string|null
     *
     * @ORM\Column(name="chapterprice_eur", type="string", length=30, nullable=true)
     */
    private $chapterpriceEur;

    /**
     * @var string|null
     *
     * @ORM\Column(name="pre_pubprice_eura", type="string", length=30, nullable=true)
     */
    private $prePubpriceEura;

    /**
     * @var string|null
     *
     * @ORM\Column(name="subscriptionprice_eura", type="string", length=30, nullable=true)
     */
    private $subscriptionpriceEura;

    /**
     * @var string|null
     *
     * @ORM\Column(name="specialprice_eura", type="string", length=30, nullable=true)
     */
    private $specialpriceEura;

    /**
     * @var string|null
     *
     * @ORM\Column(name="multi_userpricelibrary_eura", type="string", length=30, nullable=true)
     */
    private $multiUserpricelibraryEura;

    /**
     * @var string|null
     *
     * @ORM\Column(name="chapterprice_eura", type="string", length=30, nullable=true)
     */
    private $chapterpriceEura;

    /**
     * @var string|null
     *
     * @ORM\Column(name="pre_pubprice_eurd", type="string", length=30, nullable=true)
     */
    private $prePubpriceEurd;

    /**
     * @var string|null
     *
     * @ORM\Column(name="subscriptionprice_eurd", type="string", length=30, nullable=true)
     */
    private $subscriptionpriceEurd;

    /**
     * @var string|null
     *
     * @ORM\Column(name="specialprice_eurd", type="string", length=30, nullable=true)
     */
    private $specialpriceEurd;

    /**
     * @var string|null
     *
     * @ORM\Column(name="multi_userpricelibrary_eurd", type="string", length=30, nullable=true)
     */
    private $multiUserpricelibraryEurd;

    /**
     * @var string|null
     *
     * @ORM\Column(name="chapterprice_eurd", type="string", length=30, nullable=true)
     */
    private $chapterpriceEurd;

    /**
     * @var string|null
     *
     * @ORM\Column(name="pre_pubprice_usd", type="string", length=30, nullable=true)
     */
    private $prePubpriceUsd;

    /**
     * @var string|null
     *
     * @ORM\Column(name="subscriptionprice_usd", type="string", length=30, nullable=true)
     */
    private $subscriptionpriceUsd;

    /**
     * @var string|null
     *
     * @ORM\Column(name="specialprice_usd", type="string", length=30, nullable=true)
     */
    private $specialpriceUsd;

    /**
     * @var string|null
     *
     * @ORM\Column(name="multi_userpricelibrary_usd", type="string", length=30, nullable=true)
     */
    private $multiUserpricelibraryUsd;

    /**
     * @var string|null
     *
     * @ORM\Column(name="chapterprice_usd", type="string", length=30, nullable=true)
     */
    private $chapterpriceUsd;

    /**
     * @var string|null
     *
     * @ORM\Column(name="subsequentedition", type="string", length=30, nullable=true)
     */
    private $subsequentedition;

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

    /**
     * @return null|string
     */
    public function getEditionno()
    {
        return $this->editionno;
    }

    /**
     * @param null|string $editionno
     */
    public function setEditionno($editionno)
    {
        $this->editionno = $editionno;
    }

    /**
     * @return null|string
     */
    public function getProjectNo()
    {
        return $this->projectNo;
    }

    /**
     * @param null|string $projectNo
     */
    public function setProjectNo($projectNo)
    {
        $this->projectNo = $projectNo;
    }

    /**
     * @return null|string
     */
    public function getPrdsrl()
    {
        return $this->prdsrl;
    }

    /**
     * @param null|string $prdsrl
     */
    public function setPrdsrl($prdsrl)
    {
        $this->prdsrl = $prdsrl;
    }

    /**
     * @return null|string
     */
    public function getPublisher()
    {
        return $this->publisher;
    }

    /**
     * @param null|string $publisher
     */
    public function setPublisher($publisher)
    {
        $this->publisher = $publisher;
    }

    /**
     * @return null|string
     */
    public function getPubDate()
    {
        return $this->pubDate;
    }

    /**
     * @param null|string $pubDate
     */
    public function setPubDate($pubDate)
    {
        $this->pubDate = $pubDate;
    }

    /**
     * @return null|string
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param null|string $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }

    /**
     * @return null|string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param null|string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return null|string
     */
    public function getSubtitle()
    {
        return $this->subtitle;
    }

    /**
     * @param null|string $subtitle
     */
    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;
    }

    /**
     * @return null|string
     */
    public function getShorttitle()
    {
        return $this->shorttitle;
    }

    /**
     * @param null|string $shorttitle
     */
    public function setShorttitle($shorttitle)
    {
        $this->shorttitle = $shorttitle;
    }

    /**
     * @return null|string
     */
    public function getAuthors()
    {
        return $this->authors;
    }

    /**
     * @param null|string $authors
     */
    public function setAuthors($authors)
    {
        $this->authors = $authors;
    }

    /**
     * @return null|string
     */
    public function getEditors()
    {
        return $this->editors;
    }

    /**
     * @param null|string $editors
     */
    public function setEditors($editors)
    {
        $this->editors = $editors;
    }

    /**
     * @return null|string
     */
    public function getDivisionmsType()
    {
        return $this->divisionmsType;
    }

    /**
     * @param null|string $divisionmsType
     */
    public function setDivisionmsType($divisionmsType)
    {
        $this->divisionmsType = $divisionmsType;
    }

    /**
     * @return null|string
     */
    public function getSubjectgroup()
    {
        return $this->subjectgroup;
    }

    /**
     * @param null|string $subjectgroup
     */
    public function setSubjectgroup($subjectgroup)
    {
        $this->subjectgroup = $subjectgroup;
    }

    /**
     * @return null|string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param null|string $language
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }

    /**
     * @return null|string
     */
    public function getAcqeditor()
    {
        return $this->acqeditor;
    }

    /**
     * @param null|string $acqeditor
     */
    public function setAcqeditor($acqeditor)
    {
        $this->acqeditor = $acqeditor;
    }

    /**
     * @return null|string
     */
    public function getPubyear()
    {
        return $this->pubyear;
    }

    /**
     * @param null|string $pubyear
     */
    public function setPubyear($pubyear)
    {
        $this->pubyear = $pubyear;
    }

    /**
     * @return null|string
     */
    public function getPubmonth()
    {
        return $this->pubmonth;
    }

    /**
     * @param null|string $pubmonth
     */
    public function setPubmonth($pubmonth)
    {
        $this->pubmonth = $pubmonth;
    }

    /**
     * @return null|string
     */
    public function getMainthemacode()
    {
        return $this->mainthemacode;
    }

    /**
     * @param null|string $mainthemacode
     */
    public function setMainthemacode($mainthemacode)
    {
        $this->mainthemacode = $mainthemacode;
    }

    /**
     * @return null|string
     */
    public function getMainthematext()
    {
        return $this->mainthematext;
    }

    /**
     * @param null|string $mainthematext
     */
    public function setMainthematext($mainthematext)
    {
        $this->mainthematext = $mainthematext;
    }

    /**
     * @return null|string
     */
    public function getThemacode2()
    {
        return $this->themacode2;
    }

    /**
     * @param null|string $themacode2
     */
    public function setThemacode2($themacode2)
    {
        $this->themacode2 = $themacode2;
    }

    /**
     * @return null|string
     */
    public function getThematext2()
    {
        return $this->thematext2;
    }

    /**
     * @param null|string $thematext2
     */
    public function setThematext2($thematext2)
    {
        $this->thematext2 = $thematext2;
    }

    /**
     * @return null|string
     */
    public function getThemacode3()
    {
        return $this->themacode3;
    }

    /**
     * @param null|string $themacode3
     */
    public function setThemacode3($themacode3)
    {
        $this->themacode3 = $themacode3;
    }

    /**
     * @return null|string
     */
    public function getThematext3()
    {
        return $this->thematext3;
    }

    /**
     * @param null|string $thematext3
     */
    public function setThematext3($thematext3)
    {
        $this->thematext3 = $thematext3;
    }

    /**
     * @return null|string
     */
    public function getMainbiccode()
    {
        return $this->mainbiccode;
    }

    /**
     * @param null|string $mainbiccode
     */
    public function setMainbiccode($mainbiccode)
    {
        $this->mainbiccode = $mainbiccode;
    }

    /**
     * @return null|string
     */
    public function getMainbictext()
    {
        return $this->mainbictext;
    }

    /**
     * @param null|string $mainbictext
     */
    public function setMainbictext($mainbictext)
    {
        $this->mainbictext = $mainbictext;
    }

    /**
     * @return null|string
     */
    public function getBiccode2()
    {
        return $this->biccode2;
    }

    /**
     * @param null|string $biccode2
     */
    public function setBiccode2($biccode2)
    {
        $this->biccode2 = $biccode2;
    }

    /**
     * @return null|string
     */
    public function getBictext2()
    {
        return $this->bictext2;
    }

    /**
     * @param null|string $bictext2
     */
    public function setBictext2($bictext2)
    {
        $this->bictext2 = $bictext2;
    }

    /**
     * @return null|string
     */
    public function getBiccode3()
    {
        return $this->biccode3;
    }

    /**
     * @param null|string $biccode3
     */
    public function setBiccode3($biccode3)
    {
        $this->biccode3 = $biccode3;
    }

    /**
     * @return null|string
     */
    public function getBictext3()
    {
        return $this->bictext3;
    }

    /**
     * @param null|string $bictext3
     */
    public function setBictext3($bictext3)
    {
        $this->bictext3 = $bictext3;
    }

    /**
     * @return null|string
     */
    public function getMainbisaccode()
    {
        return $this->mainbisaccode;
    }

    /**
     * @param null|string $mainbisaccode
     */
    public function setMainbisaccode($mainbisaccode)
    {
        $this->mainbisaccode = $mainbisaccode;
    }

    /**
     * @return null|string
     */
    public function getMainbisactext()
    {
        return $this->mainbisactext;
    }

    /**
     * @param null|string $mainbisactext
     */
    public function setMainbisactext($mainbisactext)
    {
        $this->mainbisactext = $mainbisactext;
    }

    /**
     * @return null|string
     */
    public function getBisaccode2()
    {
        return $this->bisaccode2;
    }

    /**
     * @param null|string $bisaccode2
     */
    public function setBisaccode2($bisaccode2)
    {
        $this->bisaccode2 = $bisaccode2;
    }

    /**
     * @return null|string
     */
    public function getBisactext2()
    {
        return $this->bisactext2;
    }

    /**
     * @param null|string $bisactext2
     */
    public function setBisactext2($bisactext2)
    {
        $this->bisactext2 = $bisactext2;
    }

    /**
     * @return null|string
     */
    public function getBisaccode3()
    {
        return $this->bisaccode3;
    }

    /**
     * @param null|string $bisaccode3
     */
    public function setBisaccode3($bisaccode3)
    {
        $this->bisaccode3 = $bisaccode3;
    }

    /**
     * @return null|string
     */
    public function getBisactext3()
    {
        return $this->bisactext3;
    }

    /**
     * @param null|string $bisactext3
     */
    public function setBisactext3($bisactext3)
    {
        $this->bisactext3 = $bisactext3;
    }

    /**
     * @return null|string
     */
    public function getAvailability()
    {
        return $this->availability;
    }

    /**
     * @param null|string $availability
     */
    public function setAvailability($availability)
    {
        $this->availability = $availability;
    }

    /**
     * @return null|string
     */
    public function getEditionsizeplanned()
    {
        return $this->editionsizeplanned;
    }

    /**
     * @param null|string $editionsizeplanned
     */
    public function setEditionsizeplanned($editionsizeplanned)
    {
        $this->editionsizeplanned = $editionsizeplanned;
    }

    /**
     * @return null|string
     */
    public function getSeriestitle()
    {
        return $this->seriestitle;
    }

    /**
     * @param null|string $seriestitle
     */
    public function setSeriestitle($seriestitle)
    {
        $this->seriestitle = $seriestitle;
    }

    /**
     * @return null|string
     */
    public function getSeriessubtitle()
    {
        return $this->seriessubtitle;
    }

    /**
     * @param null|string $seriessubtitle
     */
    public function setSeriessubtitle($seriessubtitle)
    {
        $this->seriessubtitle = $seriessubtitle;
    }

    /**
     * @return null|string
     */
    public function getSeriescode()
    {
        return $this->seriescode;
    }

    /**
     * @param null|string $seriescode
     */
    public function setSeriescode($seriescode)
    {
        $this->seriescode = $seriescode;
    }

    /**
     * @return null|string
     */
    public function getSeriesissn()
    {
        return $this->seriesissn;
    }

    /**
     * @param null|string $seriesissn
     */
    public function setSeriesissn($seriesissn)
    {
        $this->seriesissn = $seriesissn;
    }

    /**
     * @return null|string
     */
    public function getVolumeno()
    {
        return $this->volumeno;
    }

    /**
     * @param null|string $volumeno
     */
    public function setVolumeno($volumeno)
    {
        $this->volumeno = $volumeno;
    }

    /**
     * @return null|string
     */
    public function getMaindesc()
    {
        return $this->maindesc;
    }

    /**
     * @param null|string $maindesc
     */
    public function setMaindesc($maindesc)
    {
        $this->maindesc = $maindesc;
    }

    /**
     * @return null|string
     */
    public function getShortdesc()
    {
        return $this->shortdesc;
    }

    /**
     * @param null|string $shortdesc
     */
    public function setShortdesc($shortdesc)
    {
        $this->shortdesc = $shortdesc;
    }

    /**
     * @return null|string
     */
    public function getToc()
    {
        return $this->toc;
    }

    /**
     * @param null|string $toc
     */
    public function setToc($toc)
    {
        $this->toc = $toc;
    }

    /**
     * @return null|string
     */
    public function getAuthorsbio()
    {
        return $this->authorsbio;
    }

    /**
     * @param null|string $authorsbio
     */
    public function setAuthorsbio($authorsbio)
    {
        $this->authorsbio = $authorsbio;
    }

    /**
     * @return null|string
     */
    public function getAwards()
    {
        return $this->awards;
    }

    /**
     * @param null|string $awards
     */
    public function setAwards($awards)
    {
        $this->awards = $awards;
    }

    /**
     * @return null|string
     */
    public function getPricesfr()
    {
        return $this->pricesfr;
    }

    /**
     * @param null|string $pricesfr
     */
    public function setPricesfr($pricesfr)
    {
        $this->pricesfr = $pricesfr;
    }

    /**
     * @return null|string
     */
    public function getPriceeurD()
    {
        return $this->priceeurD;
    }

    /**
     * @param null|string $priceeurD
     */
    public function setPriceeurD($priceeurD)
    {
        $this->priceeurD = $priceeurD;
    }

    /**
     * @return null|string
     */
    public function getPriceeurA()
    {
        return $this->priceeurA;
    }

    /**
     * @param null|string $priceeurA
     */
    public function setPriceeurA($priceeurA)
    {
        $this->priceeurA = $priceeurA;
    }

    /**
     * @return null|string
     */
    public function getPriceeur()
    {
        return $this->priceeur;
    }

    /**
     * @param null|string $priceeur
     */
    public function setPriceeur($priceeur)
    {
        $this->priceeur = $priceeur;
    }

    /**
     * @return null|string
     */
    public function getPricegbp()
    {
        return $this->pricegbp;
    }

    /**
     * @param null|string $pricegbp
     */
    public function setPricegbp($pricegbp)
    {
        $this->pricegbp = $pricegbp;
    }

    /**
     * @return null|string
     */
    public function getPriceusd()
    {
        return $this->priceusd;
    }

    /**
     * @param null|string $priceusd
     */
    public function setPriceusd($priceusd)
    {
        $this->priceusd = $priceusd;
    }

    /**
     * @return null|string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param null|string $version
     */
    public function setVersion($version)
    {
        $this->version = $version;
    }

    /**
     * @return null|string
     */
    public function getBinding()
    {
        return $this->binding;
    }

    /**
     * @param null|string $binding
     */
    public function setBinding($binding)
    {
        $this->binding = $binding;
    }

    /**
     * @return null|string
     */
    public function getPages()
    {
        return $this->pages;
    }

    /**
     * @param null|string $pages
     */
    public function setPages($pages)
    {
        $this->pages = $pages;
    }

    /**
     * @return null|string
     */
    public function getPagesapprox()
    {
        return $this->pagesapprox;
    }

    /**
     * @param null|string $pagesapprox
     */
    public function setPagesapprox($pagesapprox)
    {
        $this->pagesapprox = $pagesapprox;
    }

    /**
     * @return null|string
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * @param null|string $format
     */
    public function setFormat($format)
    {
        $this->format = $format;
    }

    /**
     * @return null|string
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * @param null|string $weight
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;
    }

    /**
     * @return null|string
     */
    public function getIlluscolour()
    {
        return $this->illuscolour;
    }

    /**
     * @param null|string $illuscolour
     */
    public function setIlluscolour($illuscolour)
    {
        $this->illuscolour = $illuscolour;
    }

    /**
     * @return null|string
     */
    public function getIllusblackandwhite()
    {
        return $this->illusblackandwhite;
    }

    /**
     * @param null|string $illusblackandwhite
     */
    public function setIllusblackandwhite($illusblackandwhite)
    {
        $this->illusblackandwhite = $illusblackandwhite;
    }

    /**
     * @return null|string
     */
    public function getProductlink()
    {
        return $this->productlink;
    }

    /**
     * @param null|string $productlink
     */
    public function setProductlink($productlink)
    {
        $this->productlink = $productlink;
    }

    /**
     * @return null|string
     */
    public function getPrePubpriceChf()
    {
        return $this->prePubpriceChf;
    }

    /**
     * @param null|string $prePubpriceChf
     */
    public function setPrePubpriceChf($prePubpriceChf)
    {
        $this->prePubpriceChf = $prePubpriceChf;
    }

    /**
     * @return null|string
     */
    public function getSubscriptionpriceChf()
    {
        return $this->subscriptionpriceChf;
    }

    /**
     * @param null|string $subscriptionpriceChf
     */
    public function setSubscriptionpriceChf($subscriptionpriceChf)
    {
        $this->subscriptionpriceChf = $subscriptionpriceChf;
    }

    /**
     * @return null|string
     */
    public function getSpecialpriceChf()
    {
        return $this->specialpriceChf;
    }

    /**
     * @param null|string $specialpriceChf
     */
    public function setSpecialpriceChf($specialpriceChf)
    {
        $this->specialpriceChf = $specialpriceChf;
    }

    /**
     * @return null|string
     */
    public function getMultiUserpricelibraryChf()
    {
        return $this->multiUserpricelibraryChf;
    }

    /**
     * @param null|string $multiUserpricelibraryChf
     */
    public function setMultiUserpricelibraryChf($multiUserpricelibraryChf)
    {
        $this->multiUserpricelibraryChf = $multiUserpricelibraryChf;
    }

    /**
     * @return null|string
     */
    public function getChapterpriceChf()
    {
        return $this->chapterpriceChf;
    }

    /**
     * @param null|string $chapterpriceChf
     */
    public function setChapterpriceChf($chapterpriceChf)
    {
        $this->chapterpriceChf = $chapterpriceChf;
    }

    /**
     * @return null|string
     */
    public function getPrePubpriceEur()
    {
        return $this->prePubpriceEur;
    }

    /**
     * @param null|string $prePubpriceEur
     */
    public function setPrePubpriceEur($prePubpriceEur)
    {
        $this->prePubpriceEur = $prePubpriceEur;
    }

    /**
     * @return null|string
     */
    public function getSubscriptionpriceEur()
    {
        return $this->subscriptionpriceEur;
    }

    /**
     * @param null|string $subscriptionpriceEur
     */
    public function setSubscriptionpriceEur($subscriptionpriceEur)
    {
        $this->subscriptionpriceEur = $subscriptionpriceEur;
    }

    /**
     * @return null|string
     */
    public function getSpecialpriceEur()
    {
        return $this->specialpriceEur;
    }

    /**
     * @param null|string $specialpriceEur
     */
    public function setSpecialpriceEur($specialpriceEur)
    {
        $this->specialpriceEur = $specialpriceEur;
    }

    /**
     * @return null|string
     */
    public function getMultiUserpricelibraryEur()
    {
        return $this->multiUserpricelibraryEur;
    }

    /**
     * @param null|string $multiUserpricelibraryEur
     */
    public function setMultiUserpricelibraryEur($multiUserpricelibraryEur)
    {
        $this->multiUserpricelibraryEur = $multiUserpricelibraryEur;
    }

    /**
     * @return null|string
     */
    public function getChapterpriceEur()
    {
        return $this->chapterpriceEur;
    }

    /**
     * @param null|string $chapterpriceEur
     */
    public function setChapterpriceEur($chapterpriceEur)
    {
        $this->chapterpriceEur = $chapterpriceEur;
    }

    /**
     * @return null|string
     */
    public function getPrePubpriceEura()
    {
        return $this->prePubpriceEura;
    }

    /**
     * @param null|string $prePubpriceEura
     */
    public function setPrePubpriceEura($prePubpriceEura)
    {
        $this->prePubpriceEura = $prePubpriceEura;
    }

    /**
     * @return null|string
     */
    public function getSubscriptionpriceEura()
    {
        return $this->subscriptionpriceEura;
    }

    /**
     * @param null|string $subscriptionpriceEura
     */
    public function setSubscriptionpriceEura($subscriptionpriceEura)
    {
        $this->subscriptionpriceEura = $subscriptionpriceEura;
    }

    /**
     * @return null|string
     */
    public function getSpecialpriceEura()
    {
        return $this->specialpriceEura;
    }

    /**
     * @param null|string $specialpriceEura
     */
    public function setSpecialpriceEura($specialpriceEura)
    {
        $this->specialpriceEura = $specialpriceEura;
    }

    /**
     * @return null|string
     */
    public function getMultiUserpricelibraryEura()
    {
        return $this->multiUserpricelibraryEura;
    }

    /**
     * @param null|string $multiUserpricelibraryEura
     */
    public function setMultiUserpricelibraryEura($multiUserpricelibraryEura)
    {
        $this->multiUserpricelibraryEura = $multiUserpricelibraryEura;
    }

    /**
     * @return null|string
     */
    public function getChapterpriceEura()
    {
        return $this->chapterpriceEura;
    }

    /**
     * @param null|string $chapterpriceEura
     */
    public function setChapterpriceEura($chapterpriceEura)
    {
        $this->chapterpriceEura = $chapterpriceEura;
    }

    /**
     * @return null|string
     */
    public function getPrePubpriceEurd()
    {
        return $this->prePubpriceEurd;
    }

    /**
     * @param null|string $prePubpriceEurd
     */
    public function setPrePubpriceEurd($prePubpriceEurd)
    {
        $this->prePubpriceEurd = $prePubpriceEurd;
    }

    /**
     * @return null|string
     */
    public function getSubscriptionpriceEurd()
    {
        return $this->subscriptionpriceEurd;
    }

    /**
     * @param null|string $subscriptionpriceEurd
     */
    public function setSubscriptionpriceEurd($subscriptionpriceEurd)
    {
        $this->subscriptionpriceEurd = $subscriptionpriceEurd;
    }

    /**
     * @return null|string
     */
    public function getSpecialpriceEurd()
    {
        return $this->specialpriceEurd;
    }

    /**
     * @param null|string $specialpriceEurd
     */
    public function setSpecialpriceEurd($specialpriceEurd)
    {
        $this->specialpriceEurd = $specialpriceEurd;
    }

    /**
     * @return null|string
     */
    public function getMultiUserpricelibraryEurd()
    {
        return $this->multiUserpricelibraryEurd;
    }

    /**
     * @param null|string $multiUserpricelibraryEurd
     */
    public function setMultiUserpricelibraryEurd($multiUserpricelibraryEurd)
    {
        $this->multiUserpricelibraryEurd = $multiUserpricelibraryEurd;
    }

    /**
     * @return null|string
     */
    public function getChapterpriceEurd()
    {
        return $this->chapterpriceEurd;
    }

    /**
     * @param null|string $chapterpriceEurd
     */
    public function setChapterpriceEurd($chapterpriceEurd)
    {
        $this->chapterpriceEurd = $chapterpriceEurd;
    }

    /**
     * @return null|string
     */
    public function getPrePubpriceUsd()
    {
        return $this->prePubpriceUsd;
    }

    /**
     * @param null|string $prePubpriceUsd
     */
    public function setPrePubpriceUsd($prePubpriceUsd)
    {
        $this->prePubpriceUsd = $prePubpriceUsd;
    }

    /**
     * @return null|string
     */
    public function getSubscriptionpriceUsd()
    {
        return $this->subscriptionpriceUsd;
    }

    /**
     * @param null|string $subscriptionpriceUsd
     */
    public function setSubscriptionpriceUsd($subscriptionpriceUsd)
    {
        $this->subscriptionpriceUsd = $subscriptionpriceUsd;
    }

    /**
     * @return null|string
     */
    public function getSpecialpriceUsd()
    {
        return $this->specialpriceUsd;
    }

    /**
     * @param null|string $specialpriceUsd
     */
    public function setSpecialpriceUsd($specialpriceUsd)
    {
        $this->specialpriceUsd = $specialpriceUsd;
    }

    /**
     * @return null|string
     */
    public function getMultiUserpricelibraryUsd()
    {
        return $this->multiUserpricelibraryUsd;
    }

    /**
     * @param null|string $multiUserpricelibraryUsd
     */
    public function setMultiUserpricelibraryUsd($multiUserpricelibraryUsd)
    {
        $this->multiUserpricelibraryUsd = $multiUserpricelibraryUsd;
    }

    /**
     * @return null|string
     */
    public function getChapterpriceUsd()
    {
        return $this->chapterpriceUsd;
    }

    /**
     * @param null|string $chapterpriceUsd
     */
    public function setChapterpriceUsd($chapterpriceUsd)
    {
        $this->chapterpriceUsd = $chapterpriceUsd;
    }

    /**
     * @return null|string
     */
    public function getSubsequentedition()
    {
        return $this->subsequentedition;
    }

    /**
     * @param null|string $subsequentedition
     */
    public function setSubsequentedition($subsequentedition)
    {
        $this->subsequentedition = $subsequentedition;
    }




}
