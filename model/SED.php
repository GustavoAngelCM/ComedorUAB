<?php
	//define('METHOD','AES-256-CBC');
	if (!defined('METHOD')) define('METHOD', 'AES-256-CBC');
	//define('SECRET_KEY','remBer@Encrip2017DevelopmCRGT');
	if (!defined('SECRET_KEY')) define('SECRET_KEY', 'remBer@Encrip2017DevelopmCRGT');
	//define('SECRET_IV','712560908');
	if (!defined('SECRET_IV')) define('SECRET_IV', '712560908');

	class SED
	{
		public function __construct()
		{

		}
		public static function encryption($string){
			$output=FALSE;
			$key=hash('sha256', SECRET_KEY);
			$iv=substr(hash('sha256', SECRET_IV), 0, 16);
			$output=openssl_encrypt($string, METHOD, $key, 0, $iv);
			$output=base64_encode($output);
			return $output;
		}
		public static function decryption($string){
			$key=hash('sha256', SECRET_KEY);
			$iv=substr(hash('sha256', SECRET_IV), 0, 16);
			$output=openssl_decrypt(base64_decode($string), METHOD, $key, 0, $iv);
			return $output;
		}
	}
	// $set=new SED();
	// $nombre=$set->encryption("jhonny");
	// echo $nombre;
?>
