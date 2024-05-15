<?php
/*=======================================================/
	| Craeted By: Khalid puerto
	| URL: www.puertokhalid.com
	| Facebook: www.facebook.com/prof.puertokhalid
	| Instagram: www.instagram.com/khalidpuerto
	| Whatsapp: +212 654 211 360
 /======================================================*/



# Site Path
# 'path' : Don't need to change the 'path' in the +v1.4 ;)

# Tables' Prefix
define('prefix', 'puerto_');

$connect = [
	'HOSTNAME' => 'localhost', // HOST NAME
	'USERNAME' => 'dinartechshare-e',      // DATABASE USERNAME
	'PASSWORD' => 'D1N4R0K3!',      // DATABASE PASSWORD
	'DATABASE' => 'silsilah' // DATABASE NAME
];

$db = new mysqli($connect['HOSTNAME'], $connect['USERNAME'], $connect['PASSWORD'], $connect['DATABASE']);
if($db->connect_errno){
    echo "Failed to connect to MySQL : (" . $db->connect_errno . ") " . $db->connect_error;
		exit;
}
