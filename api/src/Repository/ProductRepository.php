<?php

namespace App\Repository;

use App\Entity\Card;
use App\Entity\IsbnTemporal;
use App\Entity\Product;
use App\Entity\Statistik;
use App\Entity\User;
use App\Service\UtilsService;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\ResultSetMapping;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\Asset\Packages;
use Symfony\Component\Asset\VersionStrategy\EmptyVersionStrategy;

class ProductRepository extends ServiceEntityRepository
{

    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function getProductsProcedure($limit){

        $conn = $this->getEntityManager()->getConnection();
        $products = $conn->prepare("CALL getIsbnStats(".$limit.")");
        $products->execute();

        return $products->fetchAll();

    }

    public function getProductsFilter($filter, $ind){

        $sql = "";
        $conn = $this->getEntityManager()->getConnection();
        $last = "";

        // Filtro para el isbn
        if($filter->isbn != ""){
           $sql .= "isbno_noissn = '".$filter->isbn."'";
           $last = "isbn";
        }

        // Filtro para el nombre
        if($filter->name != ""){
            if($last == "isbn"){
                $sql .= " OR ";
            }
            $strings = explode(" ", $filter->name);
            foreach($strings as $index => $string){
                $sql .= "title LIKE '%".$string."%' ";
                if($index < count($strings)-1){
                    $sql .= "OR ";
                }
            }
        }

        $productsall = $conn->prepare("SELECT COUNT(*) as count FROM product WHERE ".$sql." ");
        $productsall->execute();
        $count = ($productsall->fetchAll())[0]['count'];

        $products = $conn->prepare("SELECT *  FROM product WHERE ".$sql." LIMIT " . ($ind * Product::LIMIT) . ", " . Product::LIMIT . " ");
        $products->execute();
        //SELECT SUM(netsalesrevenue) as total, SUM(quantity) as cantidad, currency FROM statistik WHERE isbn = '978-3-631-77792-3' GROUP BY isbn,currency
        return [
            'count' => $count,
            'products' => $products->fetchAll()
        ];
    }

    public function getProductsByTypes($types, $ind, $totals = false, $download = false){

        $sql = "";
        $conn = $this->getEntityManager()->getConnection();
        $last = false;


        // Filtro para language
        if(isset($types->languages) && count($types->languages) > 0){
            $last = true;
            $sql .= "(";
            foreach($types->languages as $index => $item){
                $sql .= "language LIKE '%".UtilsService::clean($item->name)."%' ";
                $sql .= ($index < count($types->languages)-1) ? "OR " : ")";
            }
        }

        // Filtro para version
        if(isset($types->versions) && count($types->versions) > 0){
            $sql .= ($last) ? " AND (" : "(";
            $last = true;
            foreach($types->versions as $index => $item){
                $sql .= "version LIKE '%".UtilsService::clean($item->name)."%' ";
                $sql .= ($index < count($types->versions)-1) ? "OR " : ")";
            }
        }

        // Filtro para editor
        if(isset($types->editor) && count($types->editor) > 0){
            $sql .= ($last) ? " AND (" : "(";
            $last = true;
            foreach($types->editor as $index => $item){
                $sql .= "editors LIKE '%".UtilsService::clean($item->editors)."%' ";
                $sql .= ($index < count($types->editor)-1) ? "OR " : ")";
            }
        }

        // Filtro para author
        if(isset($types->languages) && count($types->author) > 0){
            $sql .= ($last) ? " AND (" : "(";
            $last = true;
            foreach($types->author as $index => $item){
                $sql .= "author LIKE '%".UtilsService::clean($item->author)."%' ";
                $sql .= ($index < count($types->author)-1) ? "OR " : ")";
            }
        }

        // Filtro para seriestitle
        if(isset($types->seriestitle) && count($types->seriestitle) > 0){
            $sql .= ($last) ? " AND (" : "(";
            $last = true;
            foreach($types->seriestitle as $index => $item){
                $sql .= "seriestitle LIKE '%".UtilsService::clean($item->seriestitle)."%' ";
                $sql .= ($index < count($types->seriestitle)-1) ? "OR " : ")";
            }
        }

        // Filtro para subjectgroup
        if(isset($types->subjectgroup) && count($types->subjectgroup) > 0){
            $sql .= ($last) ? " AND (" : "(";
            $last = true;
            foreach($types->subjectgroup as $index => $item){
                $sql .= "subjectgroup LIKE '%".$item->name."%' ";
                $sql .= ($index < count($types->subjectgroup)-1) ? "OR " : ")";
            }
        }

        // Filtro para publisher
        if(isset($types->publisher) && count($types->publisher) > 0){
            $sql .= ($last) ? " AND (" : "(";
            $last = true;
            foreach($types->publisher as $index => $item){
                $sql .= "publisher LIKE '%".$item->name."%' ";
                $sql .= ($index < count($types->publisher)-1) ? "OR " : ")";
            }
        }

        // Filtro para acqeditor
        if(isset($types->acqeditor) && count($types->acqeditor) > 0){
            $sql .= ($last) ? " AND (" : "(";
            $last = true;
            foreach($types->acqeditor as $index => $item){
                $sql .= "acqeditor LIKE '%".$item->name."%' ";
                $sql .= ($index < count($types->acqeditor)-1) ? "OR " : ")";
            }
        }

        // Filtro para availability
        if(isset($types->availability) && count($types->availability) > 0){
            $sql .= ($last) ? " AND (" : "(";
            $last = true;
            foreach($types->availability as $index => $item){
                $sql .= "availability LIKE '%".$item->name."%' ";
                $sql .= ($index < count($types->availability)-1) ? "OR " : ")";
            }
        }

        // Filtro para date pub year
        if(isset($types->from_year) && $types->from_year != "" || isset($types->to_year) &&  $types->to_year != ""){

            if($types->to_year == ""){
                $types->to_year = "1/1/2200";
            }

            if($types->from_year == ""){
                $types->from_year = "1/1/1900";
            }

            $from = new \DateTime();
            $from->setTimezone(new \DateTimeZone('Europe/Madrid'));
            $from->setTimestamp(strtotime($types->from_year));
            $to = new \DateTime();
            $to->setTimezone(new \DateTimeZone('Europe/Madrid'));
            $to->setTimestamp(strtotime($types->to_year));
            $sql .= ($last) ? " AND (" : "(";
            $sql .= "STR_TO_DATE(pub_date, '%d/%m/%y') >= STR_TO_DATE('".$from->format('d/m/Y')."', '%d/%m/%Y') AND STR_TO_DATE(pub_date, '%d/%m/%y') <= STR_TO_DATE('".$to->format('d/m/Y')."', '%d/%m/%Y') )";
        }


        $productsall = $conn->prepare("SELECT COUNT(*) as count FROM product WHERE ".$sql." ");
        $productsall_group = $conn->prepare("SELECT COUNT(*) as count FROM (SELECT group_id FROM product WHERE ".$sql." GROUP BY group_id) as totals ");

        $sql_temporal = "";
        
        if($totals){
            $products = $conn->prepare("SELECT isbno_noissn FROM product WHERE ".$sql." ");
        }else if($download){
            $products = $conn->prepare("SELECT isbno_noissn, version, pub_date, author, title, authors, editors, language, seriestitle FROM product WHERE ".$sql." ");
        }else{
            $products = $conn->prepare("SELECT * FROM product WHERE ".$sql." LIMIT " . ($ind * Product::LIMIT) . ", " . Product::LIMIT . " ");
        }

        $sql_temporal = "SELECT (isbno_noissn) FROM product WHERE ".$sql." ";
        $sql_temporal_group = "SELECT group_id FROM product WHERE ".$sql." GROUP BY group_id";
        if($download){
            $sql_temporal = "SELECT isbno_noissn, version, pub_date, author, title, authors, editors, language, seriestitle FROM product WHERE ".$sql." ";
        }

        $productsall->execute();
        $count = ($productsall->fetchAll())[0]['count'];

        $productsall_group->execute();
        $count_group = ($productsall_group->fetchAll())[0]['count'];

        $products->execute();

        return [
            'count' => $count,
            'count_group' => $count_group,
            'products' => $products->fetchAll(),
            'sql' => $sql_temporal,
            'sql_group' => $sql_temporal_group
        ];

    }

    public function getProductsByTypesByIsbn($types, $ind, $totals = false, $sqltotals = "", $download = false, $assetsManager = false, $sql_group = ""){

        $sql = "";
        $conn = $this->getEntityManager()->getConnection();
        $sqlfinal = "";
        $last = false;
        $statistiks = null;
        $statistik_group = null;
        $auxcontrol = false;
        $count = 0;
        // Filtro para isbns

        if(!$totals && !$download){
            if(count($types->isbns) > 0){
                $sql .= "(";
                $auxcontrol = false;
                foreach($types->isbns as $index => $item){
                    $control = false;
                    if(count($types->versions_range) > 0){
                        foreach($types->versions_range as $i => $value){
                            if($value->name == $item->version){
                                $control = true;
                            }
                        }
                    }else{
                        $control = true;
                    }
                    if($control){
                        $auxcontrol = true;
                        $sql .= ($last) ? "OR " : "";
                        $sql .= "isbn = '".$item->isbnoNoissn."' ";
                        $last = true;
                    }
                }
            }
        }else{
            $auxcontrol = true;
        }

        if(!$totals && !$download){
            $sql .= " )";
        }


        if($auxcontrol){

            // Filtro para countries
            if(count($types->countries) > 0){
                $sql .= ($last) ? " AND (" : " (";
                foreach($types->countries as $index => $item){
                    $last = true;
                    $sql .= "country_inv = '".UtilsService::clean($item->name)."'";
                    $sql .= ($index < count($types->countries)-1) ? "OR " : ")";
                }
            }

            // Filtro para ordertypes
            if(count($types->ordertypes) > 0){
                $sql .= ($last) ? " AND (" : " (";
                foreach($types->ordertypes as $index => $item){
                    $last = true;
                    $sql .= "ordertype = '".$item->code."' ";
                    $sql .= ($index < count($types->ordertypes)-1) ? "OR " : ")";
                }
            }

            // Filtro para posting date
            if($types->from_year_range != "" || $types->to_year_range != ""){


                if($types->to_year_range == ""){
                    $types->to_year_range = "1/1/2200";
                }

                if($types->from_year_range == ""){
                    $types->from_year_range = "1/1/1900";
                }

                $from = new \DateTime();
                $from->setTimezone(new \DateTimeZone('Europe/Madrid'));
                $from->setTimestamp(strtotime($types->from_year_range));
                $to = new \DateTime();
                $to->setTimezone(new \DateTimeZone('Europe/Madrid'));
                $to->setTimestamp(strtotime($types->to_year_range));
                $sql .= ($last || $auxcontrol && !$totals) ? " AND (" : "(";
                $sql .= "STR_TO_DATE(postingdate, '%d/%m/%Y') >= STR_TO_DATE('".$from->format('d/m/Y')."', '%d/%m/%Y') AND STR_TO_DATE(postingdate, '%d/%m/%Y') <= STR_TO_DATE('".$to->format('d/m/Y')."', '%d/%m/%Y') )";
            }


            if(!$totals && !$download){
                $statistik = $conn->prepare("SELECT isbn, SUM(netsalesrevenue) as total, SUM(quantity) as cantidad, group_id FROM statistik WHERE ".$sql." GROUP BY isbn");
                $statistik_group = $conn->prepare("SELECT COUNT(*) as count FROM (SELECT SUM(quantity) as cantidad FROM statistik WHERE ".$sql." GROUP BY group_id HAVING cantidad = 0) as totals");
                $sqlfinal = "SELECT isbn, SUM(netsalesrevenue) as total, SUM(quantity) as cantidad, currency FROM statistik WHERE ".$sql." GROUP BY isbn";
            }else{
                if($sql != "") $sql = "WHERE " . $sql;
                $time = time();
                // creamos las tablas temporales
                $conn->query("CREATE TABLE litstuds_".$time." as ". $sqltotals);
                if($totals){
                    $conn->query("CREATE TABLE litstudsgroup_".$time." as ". $sql_group);
                }

                if($download){
                    $date = new \DateTime();
                    $nameExcel = "stats-".$date->format('Y-m-d-H-i-s').".csv";
                    $statistik = $conn->prepare("SELECT customerno, invaddressno, deladdressno, jahr, monat, postingdate, invoiceno, quantity, ordernumber, ordertype, orderno, price, discount, netsalesrevenue, currency, country_inv, lt.isbno_noissn, lt.version, lt.pub_date, lt.author, lt.title, lt.authors, lt.editors, lt.language, lt.seriestitle INTO OUTFILE '/var/lib/jelastic/excel/".$nameExcel."' FIELDS TERMINATED BY ';' OPTIONALLY ENCLOSED BY '\"' LINES TERMINATED BY '\n' FROM statistik inner join litstuds_".$time." as lt ON statistik.isbn=lt.isbno_noissn ".$sql." ");
                    $sqlfinal = $nameExcel;
                }else{
                    $statistik = $conn->prepare("SELECT SUM(netsalesrevenue) as total, SUM(quantity) as cantidad FROM statistik inner join litstuds_".$time." as lt ON statistik.isbn=lt.isbno_noissn ".$sql." ");
                    $statistik_group = $conn->prepare("SELECT COUNT(*) as count FROM (SELECT statistik.group_id, SUM(quantity) as cantidad FROM statistik inner join litstudsgroup_".$time." as lt ON statistik.group_id=lt.group_id ".$sql." GROUP BY statistik.group_id HAVING cantidad = 0) as totals ");
                    $sqlfinal = "SELECT SUM(netsalesrevenue) as total, SUM(quantity) as cantidad FROM statistik inner join litstuds_".$time." as lt ON statistik.isbn=lt.isbno_noissn ".$sql." ";
                }
            }

            //SELECT group_id FROM litstudsgroup_1584098318 WHERE group_id NOT IN(SELECT group_id FROM statistik)


            $statistik->execute();
            if(!$download){
                $statistiks = $statistik->fetchAll();
                $count = count($statistiks);
            }

            if($totals || !$totals && !$download){
                $statistik_group->execute();
                $statistik_group = ($statistik_group->fetchAll())[0]['count'];
            }

            // eliminamos tabla temporal
            if($totals || $download){
                $conn->query("DROP TABLE litstuds_".$time." ");
                if($totals){
                    $conn->query("DROP TABLE litstudsgroup_".$time." ");
                }
            }

        }else{
            $statistiks = [];
        }

        return [
            'count' => $count,
            'stats' => $statistiks,
            'statsgroup' => $statistik_group,
            'sql' => $sqlfinal
        ];

    }

    public function getProductsByTypesByTitle($types, $ind){

        $sql = "";
        $conn = $this->getEntityManager()->getConnection();
        $last = false;
        $statistiks = null;
        $auxcontrol = false;

        // Filtro para isbns
        if(count($types->titles) > 0){
            $sql .= "(";
            $auxcontrol = false;
            foreach($types->titles as $index => $item){
                $control = false;
                if(count($types->versions_range) > 0){
                    foreach($types->versions_range as $i => $value){
                        if($value->name == $item->version){
                            $control = true;
                        }
                    }
                }else{
                    $control = true;
                }
                if($control){
                    $auxcontrol = true;
                    $sql .= ($last) ? "OR " : "";
                    $sql .= "isbn = '".$item->isbnoNoissn."' ";
                    $last = true;
                }
            }
        }

        $sql .= " )";

        if($auxcontrol){
            // Filtro para countries
            if(count($types->countries) > 0){
                $last = true;
                $sql .= ($auxcontrol) ? " AND (" : " (";
                foreach($types->countries as $index => $item){
                    $sql .= "country_inv LIKE '%".$item->name."%' ";
                    $sql .= ($index < count($types->countries)-1) ? "OR " : ")";
                }
            }

            // Filtro para posting date
            if($types->from_year_range != "" || $types->to_year_range != ""){

                if($types->to_year_range == ""){
                    $types->to_year_range = "1/1/2200";
                }

                if($types->from_year_range == ""){
                    $types->from_year_range = "1/1/1900";
                }

                $from = new \DateTime();
                $from->setTimezone(new \DateTimeZone('Europe/Madrid'));
                $from->setTimestamp(strtotime($types->from_year_range));
                $to = new \DateTime();
                $to->setTimezone(new \DateTimeZone('Europe/Madrid'));
                $to->setTimestamp(strtotime($types->to_year_range));
                $sql .= ($last || $auxcontrol) ? " AND (" : "(";
                $sql .= "STR_TO_DATE(postingdate, '%d/%m/%Y') >= STR_TO_DATE('".$from->format('d/m/Y')."', '%d/%m/%Y') AND STR_TO_DATE(postingdate, '%d/%m/%Y') <= STR_TO_DATE('".$to->format('d/m/Y')."', '%d/%m/%Y') )";
            }

            $statistik = $conn->prepare("SELECT isbn, SUM(netsalesrevenue) as total, SUM(quantity) as cantidad, currency   FROM statistik WHERE ".$sql." GROUP BY isbn");
            $statistik->execute();
            $statistiks = $statistik->fetchAll();
        }else{
            $statistiks = [];
        }

        $count = count($statistiks);

        return [
            'count' => $count,
            'stats' => $statistiks,
            'sql' => "SELECT isbn, SUM(netsalesrevenue) as total, SUM(quantity) as cantidad, currency   FROM statistik WHERE ".$sql." GROUP BY isbn"
        ];

    }


    public function getTypes(){

        $conn = $this->getEntityManager()->getConnection();

        /*
        $sql = $conn->prepare("SELECT COUNT(*) as count, divisionms_type as name FROM product WHERE divisionms_type != '' GROUP BY divisionms_type ORDER BY count DESC");
        $sql->execute();
        $divisions = $sql->fetchAll();

        $sql = $conn->prepare("SELECT COUNT(*) as count, mainthematext as name FROM product WHERE mainthematext != '' GROUP BY mainthematext ORDER BY count DESC");
        $sql->execute();
        $mainthema = $sql->fetchAll();

        $sql = $conn->prepare("SELECT COUNT(*) as count, thematext2 as name FROM product WHERE thematext2 != '' GROUP BY thematext2 ORDER BY count DESC");
        $sql->execute();
        $mainthema2 = $sql->fetchAll();*/

        $sql = $conn->prepare("SELECT COUNT(*) as count, language as name FROM product WHERE language != '' GROUP BY language ORDER BY language ASC");
        $sql->execute();
        $languages = $sql->fetchAll();

        $sql = $conn->prepare("SELECT COUNT(*) as count, version as name FROM product WHERE version != '' GROUP BY version ORDER BY version ASC");
        $sql->execute();
        $versions = $sql->fetchAll();

        $sql = $conn->prepare("SELECT COUNT(*) as count, subjectgroup as name FROM product WHERE subjectgroup != '' GROUP BY subjectgroup ORDER BY subjectgroup ASC");
        $sql->execute();
        $subjectgroup = $sql->fetchAll();

        $sql = $conn->prepare("SELECT COUNT(*) as count, availability as name FROM product WHERE availability != '' GROUP BY availability ORDER BY availability ASC");
        $sql->execute();
        $availability = $sql->fetchAll();

        $sql = $conn->prepare("SELECT COUNT(*) as count, publisher as name FROM product WHERE publisher != '' GROUP BY publisher ORDER BY publisher ASC");
        $sql->execute();
        $publisher = $sql->fetchAll();

        $sql = $conn->prepare("SELECT COUNT(*) as count, acqeditor as name FROM product WHERE acqeditor != '' GROUP BY acqeditor ORDER BY acqeditor ASC");
        $sql->execute();
        $acqeditor = $sql->fetchAll();

        return [
            'availability' => $availability,
            'subjectgroup' => $subjectgroup,
            'publisher' => $publisher,
            'acqeditor' => $acqeditor,
            'languages' => $languages,
            'versions' => $versions,
        ];

    }

    public function getTypesTitle(){

        $conn = $this->getEntityManager()->getConnection();

        $sql = $conn->prepare("SELECT COUNT(*) as count, country_inv as name FROM statistik WHERE country_inv != '' AND country_inv NOT REGEXP '^[0-9]+$' GROUP BY country_inv ORDER BY country_inv ASC");
        $sql->execute();
        $countries = $sql->fetchAll();

        $sql = $conn->prepare("SELECT COUNT(*) as count, version as name FROM product WHERE version != '' GROUP BY version ORDER BY version ASC");
        $sql->execute();
        $versions = $sql->fetchAll();

        $sql = $conn->prepare("SELECT COUNT(*) as count, ordertype as name FROM statistik WHERE ordertype != '' GROUP BY ordertype ORDER BY ordertype ASC");
        $sql->execute();
        $ordertypes = $sql->fetchAll();

        return [
            'countries' => $countries,
            'versions' => $versions,
            'ordertypes' => $ordertypes
        ];

    }


    public function getProductByTitle($text){

        //$products = $this->createQueryBuilder('p');

        /*$strings = explode(" ", $text);
        foreach($strings as $index => $string){
            if($index == 0){
                $products->where("p.title LIKE :text".$index." ")
                    ->setParameter('text'.$index, '%'.$string.'%');
            }else if($index < count($strings)-1){
                $products->orWhere("p.title LIKE :text".$index." ")
                    ->setParameter('text'.$index, '%'.$string.'%');
            }
        }

        $products->setMaxResults(5);

        return $products->getQuery()
            ->execute();
        */

        return $products = $this->createQueryBuilder('p')
            ->where("p.title LIKE :text")
            ->orWhere("p.isbnoNoissn LIKE :text")
            ->setMaxResults(5)
            ->setParameter('text', '%'.$text.'%')
            ->getQuery()
            ->execute();


    }

    public function getProductByIsbn($text){

        $products = $this->createQueryBuilder('p')
            ->where("p.isbnoNoissn LIKE :text")
            ->setMaxResults(10)
            ->setParameter('text', '%'.$text.'%')
            ->getQuery();

        return $products->execute();

    }

    public function getproductsByAttr($text, $type){

        $select = "";

        if($type == Product::EDITOR){
            $select .= "p.editors";
        }elseif($type == Product::SERIESTITLE){
            $select .= "p.seriestitle";
        }elseif($type == Product::AUTHOR){
            $select .= "p.author";
        }

        return $products = $this->createQueryBuilder('p')
            ->select('p.id, ' . $select)
            ->where($select." LIKE :text AND ".$select." != ''")
            ->groupBy($select)
            ->setMaxResults(10)
            ->setParameter('text', '%'.$text.'%')
            ->getQuery()
            ->execute();


    }

    public function getCountAllRows(){
        $conn = $this->getEntityManager()->getConnection();
        $sql = $conn->prepare("SELECT COUNT(*) as count FROM product");
        $sql->execute();
        $all = $sql->fetchAll();
        return $all[0]['count'];
    }

    public function getCountAllRowsGroup(){
        $conn = $this->getEntityManager()->getConnection();
        $sql = $conn->prepare("SELECT COUNT(*) as count FROM (SELECT group_id FROM product GROUP BY group_id) as totals ");
        $sql->execute();
        $all = $sql->fetchAll();
        return $all[0]['count'];
    }


}
