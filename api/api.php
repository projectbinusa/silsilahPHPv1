<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');
header("Content-Type: application/json");

include __DIR__.'/../configs/connection.php';

function strip_tags_content($text, $tags = '', $invert = FALSE){
    preg_match_all('/<(.+?)[\s]*\/?[\s]*>/si', trim($tags), $tags);
    $tags = array_unique($tags[1]);

    if(is_array($tags) AND count($tags) > 0) {
        if($invert == FALSE) {
            return preg_replace('@<(?!(?:'. implode('|', $tags) .')\b)(\w+)\b.*?>.*?</\1>@si', '', $text);
        } else {
            return preg_replace('@<('. implode('|', $tags) .')\b.*?>.*?</\1>@si', '', $text);
        }
    } elseif($invert == FALSE) {
        return preg_replace('@<(\w+)\b.*?>.*?</\1>@si', '', $text);
    }
    return $text;
}

function sc_sec($data, $html = false) {
	global $db;
	if(gettype($data) == "array")
		return sc_array($data);
	$post = $db->real_escape_string($data);
	$post = trim($post);
	$post = ($html) ? htmlspecialchars($post) : htmlspecialchars(strip_tags_content($post));
	return $post;
}

function sc_array($data, $dataType = 'char'){
	$array = array();
	$data  = array_filter($data);
  if(count($data)){
    foreach( $data AS $k => $d )
      $array[$k] = $dataType == 'int' ? (int)($d) : sc_sec($d);
  }
	return $array;
}


$request = isset($_GET['request']) ? sc_sec($_GET['request']) : '';
$id = isset($_GET['id']) ? (int)($_GET['id']) : 0;
$author = isset($_GET['author']) ? (int)($_GET['author']) : 0;
$family_id = isset($_GET['family_id']) ? (int)($_GET['family_id']) : 0;

/*

	+ GET Families       : http://puertotree:8888/api/api.php?request=getfamilies
	+ GET User Families  : http://puertotree:8888/api/api.php?request=getfamilies&author=6
	+ GET Family         : http://puertotree:8888/api/api.php?request=getfamilies&id=6

	+ GET Family Members : http://puertotree:8888/api/api.php?request=getmembers&family_id=281
	+ GET Family Member  : http://puertotree:8888/api/api.php?request=getmembers&family_id=281&id=878

	+ GET USERS          : http://puertotree:8888/api/api.php?request=getusers
	+ GET USER           : http://puertotree:8888/api/api.php?request=getusers&id=1

	+ GET Plans          : http://puertotree:8888/api/api.php?request=getplans

	+ ADD family         : http://puertotree:8888/api/api.php?request=addfamily
	+ ADD family members : http://puertotree:8888/api/api.php?request=addmember
	+ ADD user           : http://puertotree:8888/api/api.php?request=addplan
	+ SUBSCRIBE to plan  : http://puertotree:8888/api/api.php?request=subscribetoplan

	+ DELETE family      : http://puertotree:8888/api/api.php?request=deletefamily&id=1
	+ DELETE member      : http://puertotree:8888/api/api.php?request=deletemember&id=1
	+ DELETE user        : http://puertotree:8888/api/api.php?request=deleteuser&id=1

*/



$results            = [];
$results['error']   = true;
$results['message'] = "Error";
$results['get']     = '';
$results['data']    = [];

$data               = [];

if( $request == 'getfamilies' ) {

	$where = $id ? "&& id = '{$id}'" : "";
	$where .= $author ? "&& author = '{$author}'" : "";
				// $results['error']   = $where;

	$fam_sql = $db->query("SELECT * FROM ".prefix."families WHERE public = 0 {$where} LIMIT 5") or die ( $db->error() );
	if( $fam_sql ){
		while ( $fam_rs = $fam_sql->fetch_assoc() ) {
			$data[] = $fam_rs;

			$results['error']   = false;
			$results['get']     = $id ? "family" : "families";
			$results['message'] = "returned Successfully";
			$results['data']    = $data;
		}
	}

}

elseif( $request == 'getusers' ) {

	$where = $id ? "&& id = '{$id}'" : "";

	$fam_sql = $db->query("SELECT * FROM ".prefix."users WHERE status = 0 {$where} LIMIT 5") or die ( $db->error() );
	if( $fam_sql ){
		while ( $fam_rs = $fam_sql->fetch_assoc() ) {
			$data[] = $fam_rs;

			$results['error']   = false;
			$results['get']     = $id ? "user" : "users";
			$results['message'] = "returned Successfully";
			$results['data']    = $data;
		}
	}

}

elseif( $request == 'getmembers' ) {

	$where = $id ? "&& id = '{$id}'" : "";
	// $where .= $id ? "&& id = {$id}" : "";

	$fam_sql = $db->query("SELECT * FROM ".prefix."members WHERE family = '{$family_id}' {$where} LIMIT 5") or die ( $db->error() );
	if( $fam_sql ){
		while ( $fam_rs = $fam_sql->fetch_assoc() ) {
			$data[] = $fam_rs;

			$results['error']   = false;
			$results['get']     = $id ? "member" : "members";
			$results['message'] = "returned Successfully";
			$results['data']    = $data;
		}
	}

}

elseif( $request == 'getplans' ) {


	$fam_sql = $db->query("SELECT * FROM ".prefix."plans") or die ( $db->error() );
	if( $fam_sql ){
		while ( $fam_rs = $fam_sql->fetch_assoc() ) {
			$data[] = $fam_rs;

			$results['error']   = false;
			$results['get']     = $id ? "plan" : "plans";
			$results['message'] = "returned Successfully";
			$results['data']    = $data;
		}
	}

}

echo json_encode($results);
