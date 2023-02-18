<?php
require(dirname(__FILE__)."/vendor/autoload.php");
$env = Dotenv\Dotenv::createImmutable(dirname(__FILE__)."/../env");
$env->load();

ini_set( 'display_errors', 1 );
	header('Content-Type: text/html; charset=UTF-8');
	try{
		$full = "";
		if(isset($_POST["lang"])){
			$post_data = $_POST;
			$curl = curl_init($_ENV["MARKOV_API_SVR"]);
			curl_setopt($curl, CURLOPT_POST, TRUE);
			curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($post_data));
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);  //
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
			curl_setopt($curl, CURLOPT_COOKIEJAR,      'cookie');
			curl_setopt($curl, CURLOPT_COOKIEFILE,     'tmp');
			curl_setopt($curl, CURLOPT_FOLLOWLOCATION, TRUE); // Locationヘッダを追跡

			$output = curl_exec($curl);
			curl_close($curl);
			echo $output;
		}else{
			echo "missing argument";
		}
	}catch(Exception $e){
		echo $e->getMessage();
	}
?>
