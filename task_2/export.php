<?php

require_once 'connection.php';

$table = $_POST['table'];
$format = $_POST['format'];

// Export as CSV 

if($format=='csv'){

	$query = "SELECT * FROM $table";
	$result = $mysqli->query($query);
	$csv = fopen("data.csv", "w");

    $describe_query = "DESCRIBE $table";
    $describe_result = $mysqli->query($describe_query);

    $describe = array();

    for($i=0;$i<$describe_result->num_rows;$i++){
    $row = $describe_result->fetch_assoc();
	$describe[$i] = $row['Field'];
}

    fputcsv($csv, $describe,';');

	foreach ($result as $fields) {

    fputcsv($csv, $fields,';');

}
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename("data.csv").'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize("data.csv"));

    readfile("data.csv");
    

    fclose($csv);
}

// Export as XML 

if($format=='xml'){
    if($table!='order_property'){
    $table_item = substr($table, 0, -1);}

   $query = "SELECT * FROM $table";
    $result = $mysqli->query($query);

    $dom = new DOMDocument('1.0', 'UTF-8');
    $dom->formatOutput = true;
    $dom->preserveWhiteSpace = false;

    $shop = $dom->createElement('shop');
    $dom->appendChild($shop);

    $choosenTable = $dom->createElement("$table");
    $shop->appendChild($choosenTable);

    for ($i=0; $i<$result->num_rows; $i++) {

    $data = $result->fetch_assoc();

    if($table=='order_property'){
        $item = $dom->createElement("property");
    }
    else{
        $item = $dom->createElement("$table_item");
    }
    
    $attr_id = $dom->createAttribute('id');

    if($table=='order_property'){
        $attr_id->value = $data['id_order'];
    }
    else{
        $attr_id->value = $data['id'];
    }

    $item->appendChild($attr_id);

    foreach ($data as $key => $value) {
        if ($key!='id' && $key!='id_order') {
            
            $item_row  =  $dom->createElement("$key", "$value");
            $item->appendChild($item_row);
        }
    }

    $choosenTable->appendChild($item);

}
$dom->save('data.xml');
header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename("data.xml").'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize("data.xml"));

    readfile("data.xml");
}

// Export as JSON

if ($format=='json') {
    
    $query = "SELECT * FROM $table";
    $result = $mysqli->query($query);

    $json_data = array();

    for($i=0;$i<$result->num_rows;$i++){
        
        $row = $result->fetch_assoc();
        
        foreach ($row as $key => $value) {
            $json_array[$key] = $value;
        }

        array_push($json_data,$json_array); 

    }

   file_put_contents('data.json', json_encode($json_data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));  
   header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename("data.json").'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize("data.json"));

    readfile("data.json");
}

?>