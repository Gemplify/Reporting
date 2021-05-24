<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Statistik;
use App\Entity\User;
use App\Service\UtilsService;
use Doctrine\DBAL\Connection;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Asset\Package;
use Symfony\Component\Asset\Packages;
use Symfony\Component\Asset\VersionStrategy\StaticVersionStrategy;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ProductController extends AbstractController
{

    /**
     * @Route("/admin/get/products", name="admin_get_products", methods="POST")
     */
    public function adminGetProducts(Packages $assetsManager)
    {

        $request = Request::createFromGlobals();
        $data = json_decode($request->get('json'));
        $token = $request->get('h');
        $time = $request->get('t');
        $user = null;
        $products = [];
        $code = 0;
        $count = 0;
        $types = $data->types;
        $index = $data->index;
        $download = isset($data->download);
        $sql = "";
        $message = 'Ha ocurrido un error';
        $excel = "";

        if (UtilsService::isRoot($token, $time)) {

            $user = $this->getDoctrine()
                ->getRepository(User::class)
                ->findOneBy([
                    'id' => $data->user->id,
                ]);


            if($user != null && $user->getType() == User::ADMIN){

                if(isset($types->acqeditor) && count($types->acqeditor) > 0 ||isset($types->publisher) && count($types->publisher) > 0 || isset($types->mainthema) && count($types->mainthema) > 0 || isset($types->mainthema2) && count($types->mainthema2) > 0 || isset($types->languages) && count($types->languages) > 0 || isset($types->versions) && count($types->versions) > 0 || isset($types->divisions) && count($types->divisions) > 0 || isset($types->from_year) && $types->from_year != "" && isset($types->to_year) &&  $types->to_year != "") {

                    $productsfilter = $this->getDoctrine()
                        ->getRepository(Product::class)
                        ->getProductsByTypes($types, $index);

                    $sql = $productsfilter['sql'];
                    $prods = UtilsService::ControlconvertAttributes($productsfilter['products']);
                    $count = $productsfilter['count'];

                    foreach ($prods as $prod) {
                        $statistik = $this->getDoctrine()
                            ->getRepository(Statistik::class)
                            ->getStats($prod);

                        $quantity = 0;
                        $total = 0;

                        foreach ($statistik as $stat) {
                            $quantity = $quantity + $stat['cantidad'];
                            $total = $total + $stat['total'];
                        }

                        $products[] = [
                            'data' => $prod,
                            'stats' => [
                                'quantity' => $quantity,
                                'total' => number_format((float)$total, 2, '.', '')
                            ]
                        ];
                    }


                }else if(isset($types->countries) && count($types->countries) > 0 || isset($types->versions_range) && count($types->versions_range) > 0 || isset($types->ordertypes) && count($types->ordertypes) > 0 || isset($types->isbns) && count($types->isbns) > 0 || isset($types->from_year_range) && $types->from_year_range != "" && isset($types->to_year_range) && $types->to_year_range != ""){

                    /*$productsfilter = $this->getDoctrine()
                        ->getRepository(Product::class)
                        ->getProductsByTypesByTitle($types, $index);*/

                    if(!$download){

                        $productsfilter = $this->getDoctrine()
                            ->getRepository(Product::class)
                            ->getProductsByTypesByIsbn($types, $index);

                        $sql = $productsfilter['sql'];
                        $stats = UtilsService::ControlconvertAttributes($productsfilter['stats']);
                        $total_group_zero = $productsfilter['statsgroup'];
                        $group_last = "";
                        $group_id = 0;

                        foreach($types->isbns as $pr){

                            $control = false;
                            $quantity = 0;
                            $total = 0;


                            foreach ($stats as $stat) {

                                if($pr->isbnoNoissn == $stat['isbn']){
                                    if($stat['groupId'] != $group_last){
                                        $group_last = $stat['groupId'];
                                        $group_id++;
                                    }
                                    $control = true;
                                    $quantity = $quantity + $stat['cantidad'];
                                    $total = $total + $stat['total'];
                                }

                            }

                            if($control){
                                $products[] = [
                                    'data' => json_decode(json_encode($pr), true),
                                    'stats' => [
                                        'quantity' => $quantity,
                                        'total' => number_format((float)$total, 2, '.', '')
                                    ]
                                ];
                            }else{
                                $products[] = [
                                    'data' => json_decode(json_encode($pr), true),
                                    'stats' => [
                                        'quantity' => 0,
                                        'total' => 0
                                    ]
                                ];

                            }

                        }

                        $count = count($products);
                        $countgroup = $group_id;

                    }else{

                        $sql = "SELECT isbno_noissn, version, pub_date, author, title, authors, editors, language, seriestitle FROM product WHERE ";
                        $last = false;

                        if(count($types->isbns) > 0){
                            $sql .= "(";
                            foreach($types->isbns as $index => $item){
                                $sql .= ($last) ? "OR " : "";
                                $sql .= "isbno_noissn = '".$item->isbnoNoissn."' ";
                                $last = true;
                            }
                            $sql .= " )";
                        }


                        $last = false;

                        if(count($types->versions_range) > 0){
                            $sql .= " AND (";
                            foreach($types->versions_range as $i => $value){
                                $sql .= ($last) ? "OR " : "";
                                $sql .= "version = '".$value->name."' ";
                                $last = true;
                            }
                            $sql .= " )";
                        }

                        $productsfilter = $this->getDoctrine()
                            ->getRepository(Product::class)
                            ->getProductsByTypesByIsbn($types, $index, false, $sql, true, $assetsManager);

                        $rs = $this->downloadExcel($productsfilter['sql']);
                        $code = $rs['code'];
                        $message = $rs['msg'];
                        $excel = $productsfilter['sql'];

                    }

                }else{

                    $count = $this->getDoctrine()
                        ->getRepository(Product::class)
                        ->getCountAllRows();

                    $prods = $this->getDoctrine()
                        ->getRepository(Product::class)
                        ->findBy([], null, Product::LIMIT, $index * Product::LIMIT);

                    foreach($prods as $prod){
                        $statistik = $this->getDoctrine()
                            ->getRepository(Statistik::class)
                            ->getStatsNative($prod);

                        $quantity = 0;
                        $total = 0;

                        foreach ($statistik as $stat) {
                            $quantity = $quantity + $stat['cantidad'];
                            $total = $total + $stat['total'];
                        }

                        $products[] = [
                            'data' => $prod,
                            'stats' => [
                                'quantity' => $quantity,
                                'total' => number_format((float)$total, 2, '.', '')
                            ]
                        ];

                    }

                    /*$products = $this->getDoctrine()
                        ->getRepository(Product::class)
                        ->getProductsProcedure(20);*/

                }

                if(!$download){
                    $code = 200;
                    $message = "Successful books";
                }

            }else{
                $message = "No tiene permisos para este servicio";
            }

        }else{

            $message = "No tiene permiso para realizar esta acción.";

        }

        return $this->json([
            'products' => $products,
            'sql' => $sql,
            'count' => $count,
            'countgroup' => $countgroup,
            'code' => $code,
            'message' => $message,
            'total_group_zero' => $total_group_zero,
            'excel' => $excel
        ]);


    }

    /**
     * @Route("/admin/get/isbns", name="admin_get_isbns", methods="POST")
     */
    public function adminGetIsbns(Packages $assetsManager)
    {

        ini_set('memory_limit', '-1');

        $request = Request::createFromGlobals();
        $data = json_decode($request->get('json'));
        $token = $request->get('h');
        $time = $request->get('t');
        $user = null;
        $products = [];
        $code = 0;
        $count = 0;
        $countgroup = 0;
        $types = $data->types;
        $index = $data->index;
        $download = false;
        $sql = "";
        $total_quantity = 0;
        $total_sales = 0;
        $total_group_zero = 0;
        $excel = "";
        $message = 'Ha ocurrido un error';
        $statsgroup = null;



        if (UtilsService::isRoot($token, $time)) {

            $user = $this->getDoctrine()
                ->getRepository(User::class)
                ->findOneBy([
                    'id' => $data->user->id,
                ]);

            if($user != null && $user->getType() == User::ADMIN){

                if((isset($types->languages) && count($types->languages) > 0 || isset($types->versions) && count($types->versions) > 0 || isset($types->author) && count($types->author) > 0 || isset($types->acqeditor) && count($types->acqeditor) > 0 ||isset($types->publisher) && count($types->publisher) > 0 || isset($types->subjectgroup) && count($types->subjectgroup) > 0 || isset($types->editor) && count($types->editor) > 0 || isset($types->seriestitle) && count($types->seriestitle) > 0 || isset($types->availability) && count($types->availability) > 0 || isset($types->from_year) && $types->from_year != "" && isset($types->to_year) &&  $types->to_year != "") && $data->step == 0) {

                    $productsfilter = $this->getDoctrine()
                        ->getRepository(Product::class)
                        ->getProductsByTypes($types, 0);


                    $sql = $productsfilter['sql'];
                    $count = $productsfilter['count'];
                    $countgroup = $productsfilter['count_group'];
                    $products = $productsfilter['products'];

                }else if($data->step == 1 || $data->step == 2 || $data->step == 3) {

                    if((isset($types->languages) && count($types->languages) > 0 || isset($types->versions) && count($types->versions) > 0 || isset($types->author) && count($types->author) > 0 || isset($types->acqeditor) && count($types->acqeditor) > 0 ||isset($types->publisher) && count($types->publisher) > 0 || isset($types->subjectgroup) && count($types->subjectgroup) > 0 || isset($types->editor) && count($types->editor) > 0 || isset($types->seriestitle) && count($types->seriestitle) > 0 || isset($types->availability) && count($types->availability) > 0 || isset($types->from_year) && $types->from_year != "" && isset($types->to_year) &&  $types->to_year != "")){

                        $totals = ($data->step == 2);
                        $download = ($data->step == 3);

                        // obtenemos products
                        $productsfilter = $this->getDoctrine()
                            ->getRepository(Product::class)
                            ->getProductsByTypes($types, $index, $totals, $download);

                        $sql = $productsfilter['sql'];
                        $sql_group = $productsfilter['sql_group'];
                        $count = $productsfilter['count'];
                        $countgroup = $productsfilter['count_group'];
                        $prods = $productsfilter['products'];

                        if(!$totals){
                            $prods = UtilsService::ControlconvertAttributes($prods);

                            $types->isbns = [];
                            foreach($prods as $prod){
                                $types->isbns[] = json_decode(json_encode($prod));
                            }
                        }

                        // obtenemos resultados
                        $productsfilter = $this->getDoctrine()
                            ->getRepository(Product::class)
                            ->getProductsByTypesByIsbn($types, $index, $totals, $sql, $download, $assetsManager, $sql_group);

                        if($download){
                            $rs = $this->downloadExcel($productsfilter['sql']);
                            $code = $rs['code'];
                            $message = $rs['msg'];
                            $excel = $productsfilter['sql'];
                        }else{
                            $sql = $productsfilter['sql'];
                            $stats = UtilsService::ControlconvertAttributes($productsfilter['stats']);

                            if(!$totals){

                                foreach($types->isbns as $pr){

                                    $control = false;
                                    $quantity = 0;
                                    $total = 0;

                                    foreach ($stats as $stat) {

                                        if($pr->isbnoNoissn == $stat['isbn']){
                                            $control = true;
                                            $quantity = $quantity + $stat['cantidad'];
                                            $total = $total + $stat['total'];
                                        }

                                    }

                                    if($control){
                                        $products[] = [
                                            'data' => json_decode(json_encode($pr), true),
                                            'stats' => [
                                                'quantity' => $quantity,
                                                'total' => number_format((float)$total, 2, '.', '')
                                            ]
                                        ];
                                    }else{
                                        $products[] = [
                                            'data' => json_decode(json_encode($pr), true),
                                            'stats' => [
                                                'quantity' => 0,
                                                'total' => 0
                                            ]
                                        ];
                                    }

                                }


                            }else{
                                $total_sales = number_format((float)$stats[0]['total'], 2, '.', '');
                                $total_quantity = ($stats[0]['cantidad'] != null) ? $stats[0]['cantidad'] : 0;
                                $total_group_zero = $productsfilter['statsgroup'];
                            }
                        }


                    }else{

                        $count = $this->getDoctrine()
                            ->getRepository(Product::class)
                            ->getCountAllRows();

                        $countgroup = $this->getDoctrine()
                            ->getRepository(Product::class)
                            ->getCountAllRowsGroup();

                        if($data->step == 2){

                            $stattotals = $this->getDoctrine()
                                ->getRepository(Statistik::class)
                                ->getStatsTotal();

                            $total_group_zero = $this->getDoctrine()
                                ->getRepository(Statistik::class)
                                ->getStatsTotalZero();

                            foreach ($stattotals as $stat){
                                $total_quantity += $stat['cantidad'];
                                $total_sales += $stat['total'];
                            }

                            $total_sales = number_format((float)$total_sales, 2, '.', '');
                            $products = [];

                        }elseif($data->step == 3){

                            $totals = ($data->step == 2);
                            $download = ($data->step == 3);

                            // obtenemos resultados
                            $sql = "SELECT isbno_noissn, version, pub_date, author, title, authors, editors, language, seriestitle FROM product";
                            $productsfilter = $this->getDoctrine()
                                ->getRepository(Product::class)
                                ->getProductsByTypesByIsbn($types, $index, $totals, $sql, $download, $assetsManager);

                            $rs = $this->downloadExcel($productsfilter['sql']);
                            $code = $rs['code'];
                            $message = $rs['msg'];
                            $excel = $productsfilter['sql'];

                        }else{

                            $prods = $this->getDoctrine()
                                ->getRepository(Product::class)
                                ->findBy([], null, Product::LIMIT, $index * Product::LIMIT);

                            foreach($prods as $prod){
                                $statistik = $this->getDoctrine()
                                    ->getRepository(Statistik::class)
                                    ->getStatsNative($prod);

                                $quantity = 0;
                                $total = 0;

                                foreach ($statistik as $stat) {
                                    $quantity = $quantity + $stat['cantidad'];
                                    $total = $total + $stat['total'];
                                }

                                $products[] = [
                                    'data' => $prod,
                                    'stats' => [
                                        'quantity' => $quantity,
                                        'total' => number_format((float)$total, 2, '.', '')
                                    ]
                                ];
                            }

                        }

                    }

                }else{

                    $count = $this->getDoctrine()
                        ->getRepository(Product::class)
                        ->getCountAllRows();

                }

                if(!$download){
                    $code = 200;
                    $message = "Successful books";
                }

            }else{
                $message = "No tiene permisos para este servicio";
            }

        }else{

            $message = "No tiene permiso para realizar esta acción.";

        }

        return $this->json([
            'sql' => $sql,
            'count' => $count,
            'countgroup' => $countgroup,
            'total_quantity' => $total_quantity,
            'total_sales' => $total_sales,
            'total_group_zero' => $total_group_zero,
            'products' => $products,
            'code' => $code,
            'message' => $message,
            'excel' => $excel
        ]);


    }


    /**
     * @Route("/download/file/{file}", name="download_file", methods="GET")
     */
    public function downloadFile($file, Packages $assetsManager)
    {

        $response = new Response();
        $response->headers->set('Cache-Control', 'private');
        $response->headers->set('Content-Type', 'application/vnd.ms-excel');
        $response->headers->set('Content-Disposition', 'attachment;filename="' . $file . '"');

        $response->sendHeaders();

        $response->setContent(file_get_contents("excel/".$file));

        return $response;

    }

    public function downloadExcel($name){

        //SELECT COUNT(*) AS `Filas`, `title`, mainthemacode, themacode2, themacode3 FROM `product_group` GROUP BY `title`, mainthemacode, themacode2, themacode3 ORDER BY `title` DESC

        $code = 0;
        $msg = "Error excel";

        /*$spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $row = 1;

        $sheet->getColumnDimension('A')->setAutoSize(true);
        $sheet->getColumnDimension('B')->setAutoSize(true);
        $sheet->getColumnDimension('C')->setAutoSize(true);
        $sheet->getColumnDimension('D')->setAutoSize(true);
        $sheet->getColumnDimension('E')->setAutoSize(true);
        $sheet->getColumnDimension('F')->setAutoSize(true);
        $sheet->getColumnDimension('G')->setAutoSize(true);
        $sheet->getColumnDimension('H')->setAutoSize(true);
        $sheet->getColumnDimension('I')->setAutoSize(true);
        $sheet->getColumnDimension('J')->setAutoSize(true);
        $sheet->getColumnDimension('K')->setAutoSize(true);
        $sheet->getColumnDimension('M')->setAutoSize(true);
        $sheet->getColumnDimension('N')->setAutoSize(true);
        $sheet->getColumnDimension('O')->setAutoSize(true);
        $sheet->getColumnDimension('P')->setAutoSize(true);
        $sheet->getColumnDimension('Q')->setAutoSize(true);
        $sheet->getColumnDimension('R')->setAutoSize(true);
        $sheet->getColumnDimension('S')->setAutoSize(true);
        $sheet->getColumnDimension('T')->setAutoSize(true);
        $sheet->getColumnDimension('U')->setAutoSize(true);
        $sheet->getColumnDimension('V')->setAutoSize(true);
        $sheet->getColumnDimension('W')->setAutoSize(true);
        $sheet->getColumnDimension('X')->setAutoSize(true);
        $sheet->getColumnDimension('Y')->setAutoSize(true);
        $sheet->getColumnDimension('Z')->setAutoSize(true);


        $sheet->setCellValue('A1', 'Customer Nº');
        $sheet->setCellValue('B1', 'Inv Address Nº');
        $sheet->setCellValue('C1', 'Del Adress Nº');
        $sheet->setCellValue('D1', 'Year');
        $sheet->setCellValue('E1', 'Month');
        $sheet->setCellValue('F1', 'Posting date');
        $sheet->setCellValue('G1', 'Invoice Nº');
        $sheet->setCellValue('H1', 'Quantity');
        $sheet->setCellValue('I1', 'Order Number');
        $sheet->setCellValue('J1', 'Order Type');
        $sheet->setCellValue('K1', 'Order Nº');
        $sheet->setCellValue('L1', 'Price');
        $sheet->setCellValue('M1', 'Discount');
        $sheet->setCellValue('N1', 'Net Sales Revenue');
        $sheet->setCellValue('O1', 'Currency');
        $sheet->setCellValue('P1', 'Country Invoice');
        $sheet->setCellValue('Q1', 'ISBN');
        $sheet->setCellValue('R1', 'Version');
        $sheet->setCellValue('S1', 'Pub date');
        $sheet->setCellValue('T1', 'Author');
        $sheet->setCellValue('U1', 'Title');
        $sheet->setCellValue('V1', 'Authors');
        $sheet->setCellValue('W1', 'Editors');
        $sheet->setCellValue('X1', 'Language');
        $sheet->setCellValue('Y1', 'Series Title');

        $sheet->getStyle('A1:Z1')->getFont()->setBold('bold');
        $sheet->getStyle('A1:Z1')->applyFromArray([
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => [
                    'argb' => Color::COLOR_YELLOW
                ]
            ]
        ]);

        foreach ($list as $item){
            $row++;
            $sheet->setCellValue('A'.$row, $item["customerno"]);
            $sheet->setCellValue('B'.$row, $item["invaddressno"]);
            $sheet->setCellValue('C'.$row, $item["deladdressno"]);
            $sheet->setCellValue('D'.$row, $item["jahr"]);
            $sheet->setCellValue('E'.$row, $item["monat"]);
            $sheet->setCellValue('F'.$row, $item["postingdate"]);
            $sheet->setCellValue('G'.$row, $item["invoiceno"]);
            $sheet->setCellValue('H'.$row, $item["quantity"]);
            $sheet->setCellValue('I'.$row, $item["ordernumber"]);
            $sheet->setCellValue('J'.$row, $item["ordertype"]);
            $sheet->setCellValue('K'.$row, $item["orderno"]);
            $sheet->setCellValue('L'.$row, $item["price"]);
            $sheet->setCellValue('M'.$row, $item["discount"]);
            $sheet->setCellValue('N'.$row, $item["netsalesrevenue"]);
            $sheet->setCellValue('O'.$row, $item["currency"]);
            $sheet->setCellValue('P'.$row, $item["country_inv"]);
            $sheet->setCellValue('Q'.$row, $item["isbno_noissn"]);
            $sheet->setCellValue('R'.$row, $item["version"]);
            $sheet->setCellValue('S'.$row, $item["pub_date"]);
            $sheet->setCellValue('T'.$row, $item["author"]);
            $sheet->setCellValue('U'.$row, $item["title"]);
            $sheet->setCellValue('V'.$row, $item["authors"]);
            $sheet->setCellValue('W'.$row, $item["editors"]);
            $sheet->setCellValue('X'.$row, $item["language"]);
            $sheet->setCellValue('Y'.$row, $item["seriestitle"]);
            $sheet->getStyle('A'.$row.':Z'.$row)->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
        }

        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        try{
            $date = new \DateTime();
            $nameExcel = "stats-".$date->format('Y-m-d-H-i-s').".xlsx";
            $writer->save("excel/".$nameExcel);

            $code = 200;
            $msg = "Excel creado con éxito";


        }catch (\PhpOffice\PhpSpreadsheet\Writer\Exception $exception){
            $msg .= " ".$exception->getMessage();
            // error
        }
        */

        $conn = ftp_connect("45.66.222.163");
        $login = ftp_login($conn, "jelastic-ftp", "hAEM5luvUi");

        if(ftp_get($conn, "excel/".$name, "excel/".$name, FTP_BINARY)){
            ftp_delete($conn, "excel/".$name);
            $code = 200;
            $msg = "Excel upload success";
        }else{
            $msg = "Error upload file in server";
        }


        return [
            'code' => $code,
            'msg' => $msg
        ];

    }


    /**
     * @Route("/admin/get/product/by/title", name="admin_get_product_by_title", methods="POST")
     */
    public function adminGetProductByTitle()
    {

        $request = Request::createFromGlobals();
        $data = json_decode($request->get('json'));
        $token = $request->get('h');
        $time = $request->get('t');
        $user = null;
        $products = null;
        $code = 0;
        $text = $data->text;
        $type = $data->type;
        $sql = "";
        $message = 'Ha ocurrido un error';

        if (UtilsService::isRoot($token, $time)) {

            $user = $this->getDoctrine()
                ->getRepository(User::class)
                ->findOneBy([
                    'id' => $data->user->id,
                ]);


            if($user != null && $user->getType() == User::ADMIN){

                if($text != "" && $type == Product::TITLE){

                    $products = $this->getDoctrine()
                        ->getRepository(Product::class)
                        ->getProductByTitle($text);

                }else if($text != "" && $type == Product::ISBN){

                    $products = $this->getDoctrine()
                        ->getRepository(Product::class)
                        ->getProductByIsbn($text);

                }

                $code = 200;
                $message = "Successful books";

            }else{
                $message = "No tiene permisos para este servicio";
            }

        }else{

            $message = "No tiene permiso para realizar esta acción.";

        }

        return $this->json([
            'products' => $products,
            'code' => $code,
            'message' => $message
        ]);


    }

    /**
     * @Route("/admin/get/product/by/attribute", name="admin_get_product_by_attribute", methods="POST")
     */
    public function adminGetProductByAttributte()
    {

        $request = Request::createFromGlobals();
        $data = json_decode($request->get('json'));
        $token = $request->get('h');
        $time = $request->get('t');
        $user = null;
        $products = null;
        $code = 0;
        $text = $data->text;
        $type = $data->type;
        $sql = "";
        $message = 'Ha ocurrido un error';

        if (UtilsService::isRoot($token, $time)) {

            $user = $this->getDoctrine()
                ->getRepository(User::class)
                ->findOneBy([
                    'id' => $data->user->id,
                ]);


            if($user != null && $user->getType() == User::ADMIN){

                $products = $this->getDoctrine()
                    ->getRepository(Product::class)
                    ->getproductsByAttr($text, $type);

                $code = 200;
                $message = "Successful books";

            }else{
                $message = "No tiene permisos para este servicio";
            }

        }else{

            $message = "No tiene permiso para realizar esta acción.";

        }

        return $this->json([
            'products' => $products,
            'code' => $code,
            'message' => $message
        ]);


    }

    /**
     * @Route("/admin/get/product/types", name="admin_get_product_types", methods="POST")
     */
    public function adminGetProductTypes()
    {

        $request = Request::createFromGlobals();
        $data = json_decode($request->get('json'));
        $token = $request->get('h');
        $time = $request->get('t');
        $user = null;
        $code = 0;
        $types = null;
        $message = 'Ha ocurrido un error';

        if (UtilsService::isRoot($token, $time)) {

            $user = $this->getDoctrine()
                ->getRepository(User::class)
                ->findOneBy([
                    'id' => $data->user->id,
                ]);

            if($user != null && $user->getType() == User::ADMIN){

                $types = $this->getDoctrine()
                    ->getRepository(Product::class)
                    ->getTypes();


                $code = 200;
                $message = "Sucessfull types";

            }else{
                $message = "No tiene permisos para este servicio";
            }

        }else{

            $message = "No tiene permiso para realizar esta acción.";

        }

        return $this->json([
            'types' => $types,
            'code' => $code,
            'message' => $message
        ]);


    }

    /**
     * @Route("/admin/get/product/types/by/title", name="admin_get_product_types_by_title", methods="POST")
     */
    public function adminGetProductTypesByTitle()
    {

        $request = Request::createFromGlobals();
        $data = json_decode($request->get('json'));
        $token = $request->get('h');
        $time = $request->get('t');
        $user = null;
        $code = 0;
        $types = null;
        $message = 'Ha ocurrido un error';

        if (UtilsService::isRoot($token, $time)) {

            $user = $this->getDoctrine()
                ->getRepository(User::class)
                ->findOneBy([
                    'id' => $data->user->id,
                ]);

            if($user != null && $user->getType() == User::ADMIN){

                $types = $this->getDoctrine()
                    ->getRepository(Product::class)
                    ->getTypesTitle();


                $code = 200;
                $message = "Sucessfull types by title books";

            }else{
                $message = "No tiene permisos para este servicio";
            }

        }else{

            $message = "No tiene permiso para realizar esta acción.";

        }

        return $this->json([
            'types' => $types,
            'code' => $code,
            'message' => $message
        ]);


    }

}
