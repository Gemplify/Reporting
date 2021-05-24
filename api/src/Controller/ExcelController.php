<?php

namespace App\Controller;

use App\Service\UtilsService;
use Doctrine\DBAL\Connection;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Asset\Package;
use Symfony\Component\Asset\Packages;
use Symfony\Component\Asset\VersionStrategy\StaticVersionStrategy;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ExcelController extends AbstractController
{


    /**
     * @Route("/admin/load_excel", name="admin_load_excel", methods="GET")
     */
    public function adminLoadExcel(Connection $connection)
    {

        $code = 0;
        $message = 'Ha ocurrido un error';

        $file = new File('excel/statistik/pending.xlsx');

        $reader = new Xlsx();
        $excel = $reader->load($file);

        echo "(";

        for($row = 1; $row <= 1; $row++){

            for($col = 1; $col <= 100; $col++){

                $cell = $excel->getActiveSheet()->getCellByColumnAndRow($col, $row);
                $value = UtilsService::generateSeoURL($cell->getValue());

                if($value !== null && $value !== ''){
                    /*$sql = "ALTER TABLE pending_statistik ADD ".$value." VARCHAR (255) NULL";
                    $connection->query($sql);*/
                    echo $value.",";
                }

            }

        }

        echo ")";

        return $this->json([
            'code' => $code,
            'message' => $message

        ]);
    }

    /**
     * @Route("/admin/create/entity/angular/{table}", name="admin_create_entity_angular", methods="GET")
     */
    public function adminCreateEntityAngular($table, Connection $connection)
    {

        $types = [
            'varchar' => [ 'string', '\'\''],
            'text' => [ 'string', '\'\''],
            'int' => [ 'number', 0],
            'date' => [ 'string', '\'\''],
            'datetime' => [ 'string', '\'\''],
        ];

        $code = 0;
        $message = 'Ha ocurrido un error';
        $class = "";

        $sql = "DESCRIBE ".$table;
        $attributes = $connection->fetchAll($sql);

        $class = "export class ".ucfirst($table)." {\n\n";
        $class .= "constructor(\n";

        foreach($attributes as $attribute){
            $class .= "public ".$this::convertAttribute($attribute['Field']).": ".$types[(explode("(", $attribute['Type']))[0]][0].",\n";
        }

        $class .= ") { \n}\n\n";

        $class .= "static make(".$table.": any = new Array()): ".ucfirst($table)." {\n";
        $class .= "return new ".ucfirst($table)."(";

        foreach($attributes as $attribute){
            $class .= "(".$table.".".$this::convertAttribute($attribute['Field']).") ? ".$table.".".$this::convertAttribute($attribute['Field'])." : ".$types[(explode("(", $attribute['Type']))[0]][1].",\n";
        }

        $class .= ");\n}\n";

        $class .= "\ngetStatic() {\n";
        $class .= "return {\n";
        $class .= "};\n";
        $class .= "}\n";
        $class .= "}\n";

        echo nl2br($class);


        return $this->json([
            'code' => $code,
            'message' => $message

        ]);
    }

    public function convertAttribute($entity){
        return str_replace(" ","", lcfirst(ucwords(str_replace("_"," ", strtolower($entity)))));
    }


    /**
     * @Route("/admin/rel/costumer", name="admin_rel_costumer", methods="GET")
     */
    public function adminRelCostumer(Connection $connection)
    {

        $code = 0;
        $message = 'Ha ocurrido un error';

        //$array = array(100494831_,100897814?,100486349_,100025075?@,100897813?,100005556,100078587,100060597,100080550,100341813,100146725,100006041,100104786,100462692,100489531,100301533,100487975,100489354,100379431,100487131,100487977,100318699,100363954,100327758,100401189,100365149,100474259,100491897,100493963,100485153,100482316,100448900,100483909,100070756,100486075,100400533,100481018,100489306,100490191,100897921,100115398,100049377,100443354,100140257,100490996,100491669,100492397,100255702,100359261,100005809,100004990,100437076,100116279,100482802,100301911,100453778);

        //$sql = "CALL getCustomerByStatistik();";

        for($i=0;$i<2;$i++){
            //$sql = "SELECT COUNT(*) as cantidad, customerno, invaddressno, deladdressno FROM statistik WHERE customerno = '".$array[$i]."' GROUP BY customerno, invaddressno ORDER BY cantidad DESC ";
            //$statistik = $connection->fetchAll($sql);
        }



        //echo "<pre>";var_dump($statistik);echo "</pre>";

        return $this->json([
            'code' => $code,
            'message' => $message

        ]);
    }

//978-2-8076-0747-7

/// GUARDAR PRODUCTS

/*
LOAD DATA LOCAL INFILE '/var/lib/jelastic/all_products_new.csv'
INTO TABLE product_new
CHARACTER SET latin1
FIELDS TERMINATED BY ';' optionally enclosed by '"'
LINES TERMINATED BY '\n'
IGNORE 1 LINES
(isbno_noissn,editionno,project_no,prdsrl,publisher,pub_date,author,title,subtitle,shorttitle,authors,editors,divisionms_type,subjectgroup,language,acqeditor,pubyear,pubmonth,mainthemacode,mainthematext,themacode2,thematext2,themacode3,thematext3,mainbiccode,mainbictext,biccode2,bictext2,biccode3,bictext3,mainbisaccode,mainbisactext,bisaccode2,bisactext2,bisaccode3,bisactext3,availability,editionsizeplanned,seriestitle,seriessubtitle,seriescode,seriesissn,volumeno,maindesc,shortdesc,toc,authorsbio,awards,pricesfr,priceeur_d,priceeur_a,priceeur,pricegbp,priceusd,version,binding,pages,pagesapprox,format,weight,illuscolour,illusblackandwhite,productlink,pre_pubprice_chf,subscriptionprice_chf,specialprice_chf,multi_userpricelibrary_chf,chapterprice_chf,pre_pubprice_eur,subscriptionprice_eur,specialprice_eur,multi_userpricelibrary_eur,chapterprice_eur,pre_pubprice_eura,subscriptionprice_eura,specialprice_eura,multi_userpricelibrary_eura,chapterprice_eura,pre_pubprice_eurd,subscriptionprice_eurd,specialprice_eurd,multi_userpricelibrary_eurd,chapterprice_eurd,pre_pubprice_usd,subscriptionprice_usd,specialprice_usd,multi_userpricelibrary_usd,chapterprice_usd,subsequentedition);
*/

/// GUARDAR COSTUMERS 155

///var/lib/jelastic/all_costumers_csv.csv
/*
LOAD DATA LOCAL INFILE '/var/lib/jelastic/all_costumers_csv.csv'
INTO TABLE customer_new
CHARACTER SET latin1
FIELDS TERMINATED BY ';' optionally enclosed by '"'
LINES TERMINATED BY '\n'
(selidprofile,targetidlocation,idlocation,email,titlea,firstnamea,prefixa,namea,addresseeaddon1,addresseeaddon2,addresseeaddon3,institutiona,departmenta,subdepartmenta,subdepartment2a,titleb,firstnameb,prefixb,nameb,institutionb,departmentb,subdepartmentb,subdepartment2b,postalcode,city,citydistrict,street,streetnumber,addressaddon,addressaddon2,addressaddon3,postofficedescr,poboxnumber,country,state,termstate,label,anrede,fax,url,mobilphone,tel,externalreferencenumber,idprofilesource,personinstitution,idjuristicperson,deliveryaddinfo,personinstitution2,campaignnoinfo,idjuristicpersonb);
*/

/// GUARDAR STATISTIK

/*
LOAD DATA LOCAL INFILE '/Applications/MAMP/htdocs/webs/gemplify_books/api/v1/public/excel/statistik/2014to201912Nov.csv'
INTO TABLE statistik
FIELDS TERMINATED BY ','
LINES TERMINATED BY '\n'
IGNORE 1 LINES
(customerno,invaddressno,deladdressno,jahr,monat,postingdate,invoiceno,quantity,isbn,ordernumber,ordertype,orderno,price,discount,netsalesrevenue,currency);
*/

/// GUARDAR CUSTOMER MAP

/*
LOAD DATA LOCAL INFILE '/Applications/MAMP/htdocs/webs/gemplify_books/api/v1/public/excel/costumers/customer_map_puntocoma.csv'
INTO TABLE customer_rel
FIELDS TERMINATED BY ';'
LINES TERMINATED BY '\n'
IGNORE 1 LINES
(custtype,customerno,voucheryear,customer);
*/

/// GUARDAR PENDINg OrDERS

/*
LOAD DATA LOCAL INFILE '/Applications/MAMP/htdocs/webs/gemplify_books/api/v1/public/excel/statistik/pending.csv'
INTO TABLE pending_statistik
FIELDS TERMINATED BY ','
LINES TERMINATED BY '\n'
IGNORE 1 LINES
(orderdate,ordermark,valutadate,valuta,discount,plandeliverydate,isbnorderno,isbn,binding,pubdate,orderno,mandator,groupofcompany,orderquantity,orderid,partquantity,customerno,shorttitle,jpinfoadrinfo);
*/


}
