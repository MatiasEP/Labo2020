<?php
 
$api_endpoint = "https://selectpdf.com/api2/convert/";
$key = 'c1761e75-e7e7-4b42-98d6-72b99ff468ec';
$test_url = isset($_POST["id"])?$_POST["id"]:'';
$test_url = "../paginas/visualizar_receta.php?id=5fa58577bd0d000028004567";//temporal para test
$test_url = 'https://selectpdf.com';
$local_file = '../test.pdf';
 
 
$parameters = array ('key' => $key, 'url' => $test_url);
 
// Sample GET
 
$result = @file_get_contents("$api_endpoint?" . http_build_query($parameters));
 
if (!$result) {	
	echo "HTTP Response: " . $http_response_header[0] . "<br/>";
 
	$error = error_get_last();
	echo "Error Message: " . $error['message'];
}
else {
	// set HTTP response headers
	header("Content-Type: application/pdf");
	header("Content-Disposition: attachment; filename=\"test.pdf\"");
 
	echo ($result);
}
 
?>