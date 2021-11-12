
<?php


$context = stream_context_create(array('ssl'=>array(
    'verify_peer' => false, 
    "verify_peer_name"=>false
    )));

libxml_set_streams_context($context);

    $xml = simplexml_load_file('https://anetty.ru/catalog/export/rozn/yandex_not_sku.xml');


 echo  '<table border = "1">
  <tr>
  <th> Наименование категории </th> 
  <th> Наименование товара </th>
  <th> Ссылка на товар </th>
  <th> Цена товара </th>
  <th> Описание товара</th>
  <th> Страна </th>
  
  
  
  </tr> ';



  $m_category=array();
  foreach ($xml->shop->categories->category as $category)
  {
            $a = strval($category["id"]);
            $b = strval($category);
        
       
         $m_category [ $a ] = $b ;
    
  }


  
 $i=0;
 $fp = fopen('file.csv', 'w');
 $mfp=array();


foreach ($xml->shop->offers->offer as $offer) {
     $table= array();
    echo
    '<tr> <td>'.$m_category [strval($offer->categoryId)]. ' </td> 
    <td> '.  strval($offer->name) . '</td> <td>'. strval($offer->url) .
    '</td> <td>'. strval($offer->price) .'</td> <td>'. strval($offer->description) .
     '</td> <td>'. strval($offer->country_of_origin) .
    
    
    '</tr>' ;
    
   
  
    $table[]= $m_category [strval($offer->categoryId)];
    $table[]= strval($offer->name);
    $table[]= strval($offer->url) ;
   
    $table[]= strval($offer->price); 
    $table[]= strval($offer->description);
    $table[]= strval($offer->country_of_origin) ;
   
   
   echo '<br>' ;
   
   $mfp[$i] = $table;
   




	
    $i++;
    if ($i==10)
    {
        break;
    }
} 

$table = $table . '</table>';





foreach ($mfp as $fields)
 {
	fputcsv($fp, $fields, ';', '"');
 }
fclose($fp);


  echo '</table>';
    
  