<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//$link = mysqli_connect("127.0.0.1:8889", "root", "root", "books_stats");

$link = mysqli_connect("node55889-jlampcms.hidora.com", "root", "LAZVWsWOmL", "gemplify_books", "3306");
//$link = mysqli_connect("68.138.143.222", "books", "jizM19155", "gemplify_books");

if(!$link){
    //echo "No se ha conectado";
}else{
    //echo "TODO OK";
}

/*
$num = 0;
$query = mysqli_query($link, "SELECT isbno_noissn, group_id FROM product");
while($product = mysqli_fetch_array($query)){
    $num++;
    echo $num."[".$product['isbno_noissn']."-->".$product['group_id']."]\n";
    $update = mysqli_query($link, "UPDATE statistik_group SET group_id = '".$product['group_id']."' WHERE isbn = '".$product['isbno_noissn']."' ");
}
*/

/*$query = mysqli_query($link, "SELECT * FROM groupids WHERE groupid LIKE '%-%'");
while($product = mysqli_fetch_array($query)){
    $group = explode("-", $product['groupid']);
    $update = mysqli_query($link, "UPDATE groupids SET groupnum = '".$group[1]."', groupid = '".$group[0]."' WHERE id = '".$product['id']."' ");
}
*/

/*
$num = 1124;
$query = mysqli_query($link, "SELECT * FROM groupids WHERE id > '".$num."'");
while($product = mysqli_fetch_array($query)){
    $num++;
    echo $num."[".$product['isbn']."]\n";
    $update = mysqli_query($link, "UPDATE product_group SET group_id = '".$product['groupid']."', group_num = '".$product['groupnum']."' WHERE isbno_noissn = '".$product['isbn']."' ");
}
*/

/*$query = mysqli_query($link, "SELECT * FROM product LIMIT 5");
while($product = mysqli_fetch_array($query)){
    echo $product['title']."<br>";
}*/


/*$array = [];
$repeat = [];
$query = mysqli_query($link, "SELECT COUNT(*) as cantidad, customerno, invaddressno, deladdressno FROM statistik WHERE invaddressno = '-1' GROUP BY customerno, deladdressno ORDER BY cantidad DESC");
while($statistik = mysqli_fetch_assoc($query)){
    if(!isset($array[$statistik['customerno']]) && !isset($repeat[$statistik['customerno']])){
        $array[$statistik['customerno']] = $statistik['deladdressno'];
    }else{
        unset($array[$statistik['customerno']]);
        $repeat[$statistik['customerno']] = true;
    }
    //$update = mysqli_query($link, "UPDATE customer SET customerno = '".$statistik['customerno']."' WHERE targetidlocation = '".$statistik['invaddressno']."' ");
}

foreach ($array as $item => $value){
    $update = mysqli_query($link, "UPDATE customer SET customerno = '".$item."' WHERE targetidlocation = '".$value."' ");
}*/

/*
$query = mysqli_query($link, "SELECT * FROM user");
while($users = mysqli_fetch_assoc($query)){
    var_dump($users);
}*/

/*echo "(";
foreach($repeat as $item => $value){
    echo $item.",";
}
echo ")";*/

//echo "<pre>";var_dump($repeat);echo "</pre>";

/*$query = mysqli_query($link, "SELECT * FROM statistik WHERE invaddressno != -1 AND id >= '".$id."' ORDER BY id ASC LIMIT ".$limit."  ");
while($statistik = mysqli_fetch_assoc($query)){

    $q = mysqli_query($link, "SELECT country FROM customer WHERE targetidlocation = '".$statistik['invaddressno']."' ");
    $customer = mysqli_fetch_assoc($q);

    //echo $customer['country'].", ".$statistik['id']."<br>";

    mysqli_query($link, "UPDATE statistik SET country_inv = '".$customer['country']."' WHERE id = '".$statistik['id']."' ");

}
*/


$total = 10;
$pos = 1;
$limit = 100;

/*while($total >= $pos){
    $query = mysqli_query($link, "SELECT s.id, s.customerno, c.country FROM statistik as s, customer as c WHERE s.customerno = c.customerno AND s.country_inv = '' LIMIT ".$limit." ");
    while($statistik = mysqli_fetch_assoc($query)){
        //echo "<pre>";var_dump($statistik);echo "</pre>";
        mysqli_query($link, "UPDATE statistik SET country_inv = '".$statistik['country']."' WHERE id = '".$statistik['id']."' ");
    }
    echo $pos.": Completado una ronda de ".$limit."\n\r";
    $pos++;

}*/

/*
$i = 0;
$query = mysqli_query($link, "SELECT id, customerno FROM statistik WHERE country_inv = '' ORDER BY id ASC LIMIT 150001");
while($statistik = mysqli_fetch_assoc($query)){
    $q = mysqli_query($link, "SELECT country FROM customer WHERE customerno = '".$statistik['customerno']."' ");
    $customer = mysqli_fetch_assoc($q);
    //echo "UPDATE statistik SET country_inv = '".(($customer['country'] == "") ? 'Unknown' : $customer['country'])."' WHERE id = '".$statistik['id']."' \n\r";
    mysqli_query($link, "UPDATE statistik SET country_inv = '".(($customer['country'] == "") ? 'Unknown' : $customer['country'])."' WHERE id = '".$statistik['id']."' ");
    //echo "<pre>";var_dump($customer);echo "</pre>";
}

*/


mysqli_close($link);


?>