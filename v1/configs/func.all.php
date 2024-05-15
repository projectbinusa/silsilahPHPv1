<?php
/*=======================================================/
	| Craeted By: Khalid puerto
	| URL: www.puertokhalid.com
	| Facebook: www.facebook.com/prof.puertokhalid
	| Instagram: www.instagram.com/khalidpuerto
	| Whatsapp: +212 654 211 360
 /======================================================*/


function haswife($cid, $class = ''){
	$cc = db_count("members WHERE parent = '{$cid}' && type = 2");
	$c1 = (!db_get("members", "parent", $cid) ? 'active' : '');
	return ($class?($cc?' haswife '.$c1:' '.$c1):($cc?' haswife '.$c1.'':' '.$c1.''));
}

function hasexwife($cid, $class = ''){
	$cc = db_count("members WHERE parent = '{$cid}' && type = 3");
	$c1 = (!db_get("members", "parent", $cid) ? 'active' : '');
	return ($class?($cc?' hasexwife '.$c1:' '.$c1):($cc?' hasexwife '.$c1.'':' '.$c1.''));
}

function hashid_c($cid, $class){
	$class = ($class == 'w' ? 2 : 3);
	$cc = db_count("members WHERE parent = '{$cid}' && type = {$class}");
	return $cc;
}


function get_child($cid, $frt = false){
	global $db, $lg, $id, $lang;

	$list = '';
	$list .= '<li class="'.(!db_get("members", "parent", $cid) ? 'active' : '').' '.( db_count("members WHERE parent = '{$cid}' && type != 1") > 1 ? 'haswifes' : '' ).'">';

	// Get Child


	$db_member_rs = db_rs("members WHERE id = '{$cid}'");

	$fam_auth  = db_get('families', 'author', $db_member_rs['family']);
	$fam_mode  = db_get('families', 'moderators', $db_member_rs['family']);
	$fam_count = db_rows("members WHERE parent = '".$db_member_rs['parent']."'");


	$list .= '
	<a class="'.(us_id && $db_member_rs['user']==us_name?' pt-you ':'').'">
		<div class="pt-shoow">

			'.( $db_member_rs['parent'] ? '<em class="pt-emm" '.($fam_count).'>-</em>' : '').'
			'.( $db_member_rs['type'] == 3 ? '<em class="pt-tag bl"><span>Ex partner</span></em>' : '').'
			'.( $db_member_rs['type'] == 2 ? '<em class="pt-tag"><span>Partner</span></em>' : '').'

			'.(us_id && $db_member_rs['user']==us_name?' <em>That\'s You :)</em> ':'').'

			'.(!$db_member_rs['death']?'<span class="pt-dead"><i class="fas fa-sad-cry"></i> '.$lang['rip'].'</span>':'').'
			<div class="pt-thumb" rel="item-'.$cid.'" '.$db_member_rs['type'].'>
				<img src="'.path.'/'.$db_member_rs['photo'].'" onerror="this.src=\''.nophoto.'\'" '.(!$db_member_rs['death']?'class="ripimg"':'').' />
			</div>
			<strong rel="item-'.$cid.'">'.$db_member_rs['firstname'].'</strong></div>';
			if( (us_id && $lg == $fam_auth) || (us_id && in_array(us_name, explode(',', $fam_mode))) || (us_id && $db_member_rs['user']==us_name) || us_level == 6 ){
				$list .= '<span class="pt-options">
					<b class="tree-edit" rel="'.$cid.'"><i class="fas fa-pencil-alt"></i></b>';
					if( $lg == $fam_auth || (us_id && in_array(us_name, explode(',', $fam_mode))) || us_level == 6 ){
						$list .= '
							<b class="tree-delete" rel="'.$cid.'"><i class="far fa-trash-alt"></i></b>
							<b class="tree-add" rel="'.$cid.'"><i class="fas fa-plus" data-toggle="modal" data-target="#myModal"></i></b>
							<b class="tree-add-fams" rel="'.$cid.'" data-toggle="modal" data-target="#heritageM"><i class="fas fa-users"></i></b>';
					}
				$list .= '</span>';
			}
	$list .= '</a>';


	$sql_m = $db->query("SELECT * FROM ".prefix."members WHERE parent = '{$cid}'");
	if($sql_m->num_rows || db_rows("heritage WHERE member = '{$cid}'")){
		$list .= '<ul>';
		$hii = 0;
		if($sql_m->num_rows){
		while($rs_m = $sql_m->fetch_assoc()){
			$hii++;
			$list .= get_child($rs_m['id'], true);
		}
		}
		# Heritage
		if(db_rows("heritage WHERE member = '{$cid}'")){
			$sql_h = $db->query("SELECT * FROM ".prefix."heritage WHERE member = '{$cid}'");
			$hi = 0;

			while($rs_h = $sql_h->fetch_assoc()){
				$hi++;
				$list .= get_child(db_get("members", "id", $rs_h['heritage'], "family", "and parent ='0'"));
				if($hi == 15) break;
			}
			$sql_h->close();
		}
		# End Heritage
		$list .= '</ul>';
		$sql_m->close();
	}

	$list .= '</li>';


	return $list;
}

function randomColor(){
  $result = array('rgb' => '', 'hex' => '');
  foreach(array('r', 'b', 'g') as $col){
    $rand = mt_rand(0, 255);
    $dechex = dechex($rand);
    if(strlen($dechex) < 2){
      $dechex = '0' . $dechex;
    }
    $result['hex'] .= $dechex;
  }
  return $result;
}

function fh_title(){
	global $id;
	$title = '';
	switch (page) {
		case 'tree': $title = db_get("families", "name", $id).' - '.site_title; break;
		case 'list': $title = 'Families - '.site_title; break;
		case 'dashboard': $title = 'Dashboard - '.site_title; break;
		case 'users': $title = 'Members - '.site_title; break;
		case 'details': $title = 'Details - '.site_title; break;

		default: $title = site_title; break;
	}
	return $title;
}


function bbcode($text){
		$match = [
	    '/\[B\](.*)\[\/B\]/isU',
	    '/\[I\](.*)\[\/I\]/isU',
	    '/\[S\](.*)\[\/S\]/isU',
	    '/\[U\](.*)\[\/U\]/isU',

			'/\[IMG=(.*)\](.*)\[\/IMG\]/isU',
			'/\[URL=(.+)\]/isU',
			'/\[\/URL\]/isU',

			'/\[COLOR=(.*)\]/isU',
			'/\[\/COLOR\]/isU',
			'/\[SIZE=1\]/isU',
			'/\[SIZE=2\]/isU',
			'/\[SIZE=3\]/isU',
			'/\[SIZE=4\]/isU',
			'/\[SIZE=5\]/isU',
			'/\[SIZE=6\]/isU',
			'/\[SIZE=7\]/isU',
			'/\[\/SIZE\]/isU',

			'/\[LEFT\](.*)\[\/LEFT\]/isU',
			'/\[RIGHT\](.*)\[\/RIGHT\]/isU',
			'/\[CENTER\](.*)\[\/CENTER\]/isU',
			'/\[quote\](.*)\[\/quote\]/isU',

			'/\[video\](.*)\[\/video\]/isU',
			'/\[youtube\](.*)\[\/youtube\]/isU',

			'/\[list=1\](.*)\[\/list\]/isU',
			'/\[ul\](.*)\[\/ul\]/isU',
			'/\[ol\](.*)\[\/ol\]/isU',
			'/\[\*\](.*)\[\/\*\]/isU',
			'/\[li\](.*)\[\/li\]/isU'
  	];

	  $replace = [
	    '<b>$1</b>',
	    '<i>$1</i>',
	    '<strike>$1</strike>',
	    '<u>$1</u>',

	    '<img src="$2" />',
			'<a href="$1">',
			'</a>',

			'<span style="color:$1">',
			'</span>',
			'<span style="font-size:8px">',
			'<span style="font-size:12px">',
			'<span style="font-size:14px">',
			'<span style="font-size:16px">',
			'<span style="font-size:18px">',
			'<span style="font-size:20px">',
			'<span style="font-size:22px">',
			'</span>',

			'<p class="text-left">$1</p>',
			'<p class="text-right">$1</p>',
			'<p class="text-center">$1</p>',
			'<blockquote>$1</blockquote>',

			'<iframe src="https://www.youtube.com/embed/$1" width="560" height="420" frameborder="0"></iframe>',
			'<iframe src="https://www.youtube.com/embed/$1" width="560" height="420" frameborder="0"></iframe>',

			'<ul class="decimal">$1</ul>',
			'<ul class="circle">$1</ul>',
			'<ol class="decimal">$1</ol>',
			'<li>$1</li>',
			'<li>$1</li>',
	  ];


		$regex = '/\[font=.*?\]|\[\/font\]/i';
		$text = preg_replace($regex, '', $text);

	  return nl2br(preg_replace($match, $replace, $text));
}



function fh_reset_tmp($name, $email, $url){
	$wrapper = '
		width: 380px;
		margin: 12px auto;
		color: #666;
		font-size: 16px;
		border: 1px solid #EEE;
		border-radius: 5px;
		box-shadow: 0 0 5px #EEE;
    padding: 24px;
	';
	$p = '
		line-height: 26px;
		margin: 12px 0
	';
	$a = '
		color: #333;
	';
	$button = '
		display: block;
		background: #2bdc62;
		color: #fff;
		height: 48px;
		line-height: 48px;
		padding: 0 24px;
		font-size: 18px;
		border-radius: 3px;
		text-align: center;
		text-decoration: none;
	';
	$header = '';
	$body = '';
	$footer = '
		color: #abadae;
		font-size: 12px;
		margin-top: 12px;
		line-height: 24px
	';
	$footer_a = '
		color: #abadae;
		text-decoration: underline
	';
	return '
		<div style="'.$wrapper.'">
			<div style="'.$header.'">

			</div>
			<div style="'.$body.'">
				<p style="'.$p.'">Hi '.$name.',</p>
				<p style="'.$p.'">We got a request to reset your password in '.site_title.'.</p>
				<p style="'.$p.'"><a href="'.$url.'" style="'.$button.'">Reset your password</a></p>
				<p style="'.$p.'">If you ignore this message, your password will not be changed. If you didn\'t request a password reset, <a href="'.path.'/" style="'.$a.'">let us know</a>.</p>
			</div>
			<div style="'.$footer.'">
				&copy; '.site_title.' 2020<br />
				This message was sent to <a style="'.$footer_a.'">'.$email.'</a> and intended for '.$name.'.
			</div>
		</div>
	';
}


function fh_email_tmp($name, $email, $url){
	$wrapper = '
		width: 380px;
		margin: 12px auto;
		color: #666;
		font-size: 16px;
		border: 1px solid #EEE;
		border-radius: 5px;
		box-shadow: 0 0 5px #EEE;
    padding: 24px;
	';
	$p = '
		line-height: 26px;
		margin: 12px 0
	';
	$a = '
		color: #333;
	';
	$button = '
		display: block;
		background: #2bdc62;
		color: #fff;
		height: 48px;
		line-height: 48px;
		padding: 0 24px;
		font-size: 18px;
		border-radius: 3px;
		text-align: center;
		text-decoration: none;
	';
	$header = '';
	$body = '';
	$footer = '
		color: #abadae;
		font-size: 12px;
		margin-top: 12px;
		line-height: 24px
	';
	$footer_a = '
		color: #abadae;
		text-decoration: underline
	';
	return '
		<div style="'.$wrapper.'">
			<div style="'.$header.'">

			</div>
			<div style="'.$body.'">
				<p style="'.$p.'">Hi '.$name.',</p>
				<p style="'.$p.'">This msg is for to verifie your email in '.site_title.'.</p>
				<p style="'.$p.'"><a href="'.$url.'" style="'.$button.'">Verifie your Email</a></p>
				<p style="'.$p.'">If you ignore this message, your membership will not be approved. If you think this is a mistake, please <a href="'.path.'/" style="'.$a.'">let us know</a>.</p>
			</div>
			<div style="'.$footer.'">
				&copy; '.site_title.' 2020<br />
				This message was sent to <a style="'.$footer_a.'">'.$email.'</a> and intended for '.$name.'.
			</div>
		</div>
	';
}


function fh_ago($tm = '', $at = true, $rcs = 0) {
	global $lang;
	$cur_tm = time();
	$pr_year = $cur_tm - 3600*24*365;
	$pr_month = $cur_tm - 3600*24*31;
	if( $tm > $pr_month ){
		$dif    = $cur_tm-$tm;
		$pds = array();
		foreach ($lang['timedate'] as $kk){
			$pds[] = $kk;
			if( $kk == 'decade' ) break;
		}

		$lngh   = array(1,60,3600,86400,604800,2630880,31570560,315705600);
		for($v = sizeof($lngh)-1; ($v >= 0)&&(($no = $dif/$lngh[$v])<=1); $v--); if($v < 0) $v = 0; $_tm = $cur_tm-($dif%$lngh[$v]);

		$no = floor($no); if($no <> 1 && !$lang['rtl']) $pds[$v] .=($lang['lang'] == 'en' ? 's': ''); $x=sprintf("%d %s ",$no,$pds[$v]);
		if(($rcs == 1)&&($v >= 1)&&(($cur_tm-$_tm) > 0)) $x .= time_ago($_tm);
		return "{$x} {$lang['timedate']['time_ago']}";
	} else {
        if($lang['lang'] == 'en'){
            return ($at?date('d M, Y \a\t H:i', $tm):date('d M, Y', $tm));
        } else {
            return ($at?date('d M, Y \a\t H:i', $tm):date('d M, Y', $tm));
        }


	}
}

function fh_alerts($alert, $type = 'danger', $html = true) {
	global $lang;
  switch($type){
    case 'danger':  $title = 'Oh snap!'; break;
    case 'success': $title = 'Well done!'; break;
    case 'info':    $title = 'Heads up!'; break;
    case 'warning': $title = 'Warning!'; break;
  }

	$title = '';

  return ($html) ? '<div class="alert alert-'.$type.'">
            <strong>'.$title.'</strong> '.$alert.'
          </div>' : '<strong>'.$title.'</strong> '.$alert;
}


function fh_seoURL($title){

  $turkish = array("ı", "ğ", "ü", "ş", "ö", "ç");
  $english   = array("i", "g", "u", "s", "o", "c");

	$lit = array("Ą", "ą", "Č", "č", "Ę", "ę", "Ė", "ė", "Į", "į", "Š", "š", "Ų", "ų", "Ū", "ū", "Ž", "ž");
  $lit_english   = array("A", "a", "C", "c", "E", "e", "E", "e", "I", "i", "S", "s", "U", "u", "U", "u", "Z", "z");

  $title = str_replace($turkish, $english, $title);
  $title = str_replace($lit, $lit_english, $title);

	$title = strtolower(trim(preg_replace('~[^0-9a-z]+~i', '-', html_entity_decode(preg_replace('~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i', '$1', htmlentities($title, ENT_QUOTES, 'UTF-8')), ENT_QUOTES, 'UTF-8')), '-'));

	return $title;
}

function fh_access($type, $id = 0) {
	global $db;
	$access = true;
	if(us_level == 6 || site_plans) $access = true;
	else {
		switch ($type) {
			case 'families':
				if(db_rows("families WHERE author = '".us_id."' && date > '".( time() - 3600*24*30 )."'") >= families)
					$access = false;
			break;
			case 'members':
				if(db_rows("members WHERE author = '".us_id."' && family = '{$id}' && date > '".( time() - 3600*24*30 )."'") >= members)
					$access = false;
			break;
			case 'privates':
				if(db_rows("families WHERE author = '".us_id."' && public = '1'") >= privates)
					$access = false;
			break;
			case 'heritage':
				if(!backgound)
					$access = false;
			break;
			case 'pdf':
				if(!export_statistics)
					$access = false;
			break;
			case 'albums':
				if(!integrations)
					$access = false;
			break;
			case 'show_ads':
				if(!show_ads)
					$access = false;
			break;
			case 'support':
				if(!support)
					$access = false;
			break;
		}
	}
	return $access;
}


// ** Securiry inputs functions

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

function sc_pass($data) {
	return sha1($data);
}


function check_email($email){
	$address = strtolower(trim($email));
	return (preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/i",$address));
}




// ** Database handeling functions

function db_insert($table, $array) {
	Global $db;
	$columns = implode(',', array_keys($array));
	$values  = implode(',', array_values($array));
	$query   = "INSERT INTO ".prefix."{$table} ({$columns}) VALUES ({$values})";
	return $db->query($query) or die($db->error);
}

function db_delete($table, $id, $id_col = 'id') {
	Global $db;
	$query   = "DELETE FROM ".prefix."{$table} WHERE {$id_col} = '{$id}'";
	return $db->query($query) or die($db->error);
}

function db_update($table, $array, $id, $id_col = 'id') {
	Global $db;
	$columns = array_keys($array);
	$values  = array_values($array);
	$count   = count($columns);

	$update  = '';
	for($i=0;$i<$count;$i++)
		$update .= "{$columns[$i]} = {$values[$i]}" . ($count == $i+1 ? '' : ', ');

	$query   = "UPDATE ".prefix."{$table} SET {$update} WHERE {$id_col} = '{$id}'";
	return $db->query($query) or die($db->error);
}

function db_count($table, $count = 'id'){
	global $db;
	$sql = $db->query("SELECT COUNT({$count}) FROM ".prefix."{$table}") or die($db->error);
	$rs  = $sql->fetch_row();
	$sql->close();
	return $rs[0];
}

function db_get($table, $field, $id, $where='id', $other=false){
	global $db;
	$sql = $db->query("SELECT {$field} FROM ".prefix."{$table} WHERE {$where} = '{$id}' {$other}") or die($db->error);
	if($sql->num_rows > 0){
		$rs = $sql->fetch_row();
		$sql->close();
		return $rs[0];
	}
}

function db_rs($data, $c = '*') {
	global $db;
	$sql = $db->query("SELECT {$c} FROM ".prefix.$data);
	$rs  = $sql->num_rows ? $sql->fetch_assoc() : '';
	$sql->close();
	return $rs;
}

function db_rows($table, $field = 'id'){
	global $db;
	$sql = $db->query("SELECT {$field} FROM ".prefix."{$table}") or die($db->error);
	$rs  = $sql->num_rows;
	$sql->close();
	return $rs;
}

function db_select($data) {
	global $db;
	$data['column'] = isset($data['column']) ? $data['column'] : '*';
	$data['join']   = isset($data['join'])   ? "LEFT JOIN ".prefix.$data['join'] : '';
	$data['where']  = isset($data['where'])  ? "WHERE ".$data['where'] : '';
	$data['order']  = isset($data['order'])  ? $data['order'] : '';
	$sql = $db->query( "SELECT {$data['column']} FROM ".prefix."{$data['table']} {$data['join']} {$data['where']} {$data['order']}" ) or die($db->error);
	return $sql;
}

function db_global(){
	global $db;
	$sql = $db->query("SELECT * FROM ".prefix."configs") or die($db->error);
	if($sql){
		while( $rs = $sql->fetch_assoc() )
			define( $rs['variable'], $rs['value'] );

		$sql->close();
	}
}

function db_update_global($var, $val){
	return db_update("configs", ['value' => "'{$val}'"], $var, 'variable');
}

function sc_folderName ($str = ''){
    $str = strip_tags($str);
    $str = preg_replace('/[\r\n\t ]+/', ' ', $str);
    $str = preg_replace('/[\"\*\/\:\<\>\?\'\|]+/', ' ', $str);
    $str = strtolower($str);
    $str = html_entity_decode( $str, ENT_QUOTES, "utf-8" );
    $str = htmlentities($str, ENT_QUOTES, "utf-8");
    $str = preg_replace("/(&)([a-z])([a-z]+;)/i", '$2', $str);
    $str = str_replace(' ', '-', $str);
    $str = rawurlencode($str);
    $str = str_replace('%', '-', $str);
    return $str;
}

function newImgFolder($folder){
	if(!is_dir($folder)){
		return mkdir($folder);
	} else {
		return 0;
	}
}
