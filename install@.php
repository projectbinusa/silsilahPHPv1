<?php
/*=======================================================/
	| Craeted By: Khalid puerto
	| URL: www.puertokhalid.com
	| Facebook: www.facebook.com/prof.puertokhalid
	| Instagram: www.instagram.com/khalidpuerto
	| Whatsapp: +212 654 211 360
 /======================================================*/

include __DIR__.'/configs/connection.php';

?>
<title>Puerto Install</title>
<style>
	body { background: #F7F7F7; }
	.install-box { width:450px;margin:90px auto 0 auto;background: #FFF;font-family:tahoma;font-size:14px;box-shadow:0 0 5px #CCC; }
	.install-box h1 { padding: 24px 20px;margin:0;font-size:18px;color: #555;    border-bottom: 1px solid #F7F7F7; }
	.install-box p { padding:20px;margin:0;color: #777;line-height: 1.6; }
	.install-box ul { padding: 0 20px;font-size: 12px;line-height: 1.4; }
	.install-box .button {font-size:18px;background:#DF4444;color:#FFF;text-decoration:none;display:block;margin-top:20px;text-align:center;padding:10px 0;border-radius: 3px;width: 100%; }
	.input { padding:10px 20px 0px 20px; }
	.input p { padding:0; font-size:12px; }
	label { font-weight:bold; font-size:12px; margin-left:5px; margin-bottom: 6px; color: #555; display:block; }
	input { padding:10px; font-size:12px; border:1px solid #DDD; width:100%;  }
	input[type=submit] { padding:10px; font-size:12px; color:#FFF; border:1px solid #DF4444; background:#DF4444; width:auto;  }
	.p-h, .p-h a {
    inline-block: ;
    padding: 2px 6px;
    background: #EEE;
    border-radius: 3px;
    -moz-border-radius: 3px;
    -webkit-border-radius: 3px;
    color: #555;
    text-shadow: 0 1px 0 #FFF;
	}
	ul {
		margin:0 24px
	}
	ul li {
		margin: 6px 0;
	}
	.red {
		color: red;
	}
</style>


<?php

$step = (isset($_GET['step']) ? (int)($_GET['step']) : '');

if($step == ''):

?>
<div class="install-box">
	<form method="post" action="install.php?step=1">

	<h1>Welcome to Puerto Family Tree</h1>
	<p>
	Thank you for purchasing Puerto Family Tree Script.<br> if you have any problem or issue with the script or the instraction that I provide please contact me first ASAP in:
	</p>
	<ul>
		<li>my Email: <span class="p-h">el.bouirtou@gmail.com</span></li>
		<li>my Facebook account <span class="p-h"><a href="https://fb.com/prof.puertokhalid">fb.com/prof.puertokhalid</a></span></li>
		<li>on the Instagram <span class="p-h"><a href="https://instagram.com/khalidpuerto">instagram.com/khalidpuerto</a></span></li>
		<li>Codecanyon profile <span class="p-h"><a href="http://codecanyon.net/user/puertokhalid">codecanyon.net/user/puertokhalid</a></span></li>
	</ul>
	<p>
	 and I will back to you with all help you need.<br>
	 Thanks so much!<br><br />
	 For start Installing the script fill the feilds bellow and Click in the install buttom:<br /><br />

	<label>Admin Username</label><input type="text" name="admin" />
	<label>Admin Password:</label><input type="password" name="password" />
	<label>Admin Email:</label><input type="text" name="email" />
	<button type="submit" class="button">Install Puerto Script</button>
	</p>
		</form>
</div>





<?php

else:

	$admin = (isset($_POST['admin']) ? mysqli_real_escape_string($db, $_POST['admin']): '');
	$pass = (isset($_POST['password']) ?mysqli_real_escape_string($db, $_POST['password']): '');
	$email = (isset($_POST['email']) ?mysqli_real_escape_string($db, $_POST['email']): '');


	if(!$admin || !$pass || !$email){
		die('Please fill all the infos! <meta http-equiv="refresh" content="3;url=install.php">');
	}

	function sc_pass($data) {
		return sha1($data);
	}




	$db->query("
	CREATE TABLE `".prefix."configs` (
	  `id` tinyint(3) UNSIGNED NOT NULL,
	  `variable` varchar(255) DEFAULT NULL,
	  `value` text
	) ENGINE=MyISAM DEFAULT CHARSET=utf8;
	");
	$db->query("
	INSERT INTO `".prefix."configs` (`id`, `variable`, `value`) VALUES
	(1, 'site_title', 'Puerto Family Tree'),
	(2, 'site_url', 'puertokhalid.com'),
	(3, 'site_description', 'Make your family tree live with Puerto Family Tree and do not leave it just a memory hanging. build it with the participation of everyone and make it stretch to infinity.'),
	(4, 'site_keywords', 'family tree, puerto family tree, family builder, family tree maker'),
	(5, 'site_author', 'Puerto Khalid'),
	(6, 'site_register', '0'),
	(7, 'site_plans', '0'),
	(8, 'site_register_status', '0'),
	(9, 'site_families_status', '0'),
	(10, 'site_reset_password_msg', NULL);
	");


	$db->query("
	CREATE TABLE `".prefix."families` (
	  `id` smallint(5) UNSIGNED NOT NULL,
	  `author` int(10) UNSIGNED DEFAULT '0',
	  `moderators` varchar(255) DEFAULT NULL,
	  `name` varchar(200) DEFAULT NULL,
	  `password` varchar(200) DEFAULT NULL,
	  `date` int(11) UNSIGNED DEFAULT '0',
	  `levels` tinyint(1) UNSIGNED DEFAULT '0',
	  `email` varchar(200) DEFAULT NULL,
	  `vpassword` varchar(255) DEFAULT NULL,
	  `public` tinyint(1) UNSIGNED DEFAULT '0',
	  `photo` varchar(255) DEFAULT NULL,
	  `status` tinyint(1) UNSIGNED DEFAULT '0'
	) ENGINE=InnoDB DEFAULT CHARSET=latin1;
	");
	$db->query("
	CREATE TABLE `".prefix."heritage` (
	  `id` int(11) NOT NULL,
	  `family` int(10) UNSIGNED DEFAULT NULL,
	  `member` int(10) UNSIGNED DEFAULT NULL,
	  `heritage` int(10) UNSIGNED DEFAULT NULL,
	  `author` int(10) UNSIGNED DEFAULT NULL,
	  `date` int(10) UNSIGNED DEFAULT NULL
	) ENGINE=InnoDB DEFAULT CHARSET=latin1;
	");
	$db->query("
	CREATE TABLE `".prefix."images` (
	  `id` int(11) NOT NULL,
	  `member` int(11) UNSIGNED DEFAULT '0',
	  `date` int(11) UNSIGNED DEFAULT '0',
	  `family` int(11) UNSIGNED DEFAULT '0',
	  `url` varchar(255) DEFAULT NULL
	) ENGINE=InnoDB DEFAULT CHARSET=latin1;
	");
	$db->query("
	CREATE TABLE `".prefix."members` (
	  `id` int(11) NOT NULL,
	  `author` int(10) UNSIGNED DEFAULT '0',
	  `user` varchar(200) DEFAULT NULL,
	  `family` smallint(6) UNSIGNED DEFAULT '0',
	  `date` int(10) UNSIGNED DEFAULT NULL,
	  `firstname` varchar(100) DEFAULT NULL,
	  `lastname` varchar(100) DEFAULT NULL,
	  `gender` tinyint(1) UNSIGNED DEFAULT '0',
	  `birth` varchar(100) DEFAULT NULL,
	  `death` tinyint(1) UNSIGNED DEFAULT '0',
	  `type` tinyint(1) UNSIGNED DEFAULT '0',
	  `photo` varchar(255) DEFAULT NULL,
	  `email` varchar(200) DEFAULT NULL,
	  `site` varchar(200) DEFAULT NULL,
	  `tel` varchar(15) DEFAULT NULL,
	  `mobile` varchar(15) DEFAULT NULL,
	  `birthplace` varchar(255) DEFAULT NULL,
	  `deathplace` varchar(255) DEFAULT NULL,
	  `profession` varchar(255) DEFAULT NULL,
	  `company` varchar(255) DEFAULT NULL,
	  `interests` varchar(255) DEFAULT NULL,
	  `bio` text,
	  `level` tinyint(1) UNSIGNED DEFAULT '0',
	  `parent` int(11) UNSIGNED DEFAULT '0',
	  `birthday` tinyint(2) UNSIGNED DEFAULT '0',
	  `birthmonth` tinyint(2) UNSIGNED DEFAULT '0',
	  `birthyear` smallint(4) UNSIGNED DEFAULT '0',
	  `deathday` tinyint(2) UNSIGNED DEFAULT '0',
	  `deathmonth` tinyint(2) UNSIGNED DEFAULT '0',
	  `deathyear` smallint(4) UNSIGNED DEFAULT '0',
	  `birthdate` int(11) DEFAULT '0',
	  `mariagedate` int(11) DEFAULT '0',
	  `deathdate` int(11) DEFAULT '0',
	  `facebook` varchar(255) DEFAULT NULL,
	  `instagram` varchar(255) DEFAULT NULL,
	  `twitter` varchar(255) DEFAULT NULL
	) ENGINE=InnoDB DEFAULT CHARSET=latin1;
	");


	$db->query("
	CREATE TABLE `".prefix."notifications` (
	  `id` int(11) NOT NULL,
	  `author` int(10) UNSIGNED DEFAULT NULL,
	  `user` int(10) UNSIGNED DEFAULT NULL,
	  `type` varchar(100) DEFAULT NULL,
	  `date` int(10) UNSIGNED DEFAULT NULL,
	  `item` int(10) UNSIGNED DEFAULT NULL,
	  `nread` tinyint(1) UNSIGNED DEFAULT '0'
	) ENGINE=InnoDB DEFAULT CHARSET=latin1;
	");

	$db->query("
	CREATE TABLE `".prefix."pages` (
	  `id` int(11) NOT NULL,
	  `icon` varchar(100) DEFAULT NULL,
	  `date` int(11) DEFAULT NULL,
	  `title` varchar(255) DEFAULT NULL,
	  `content` longtext,
	  `header` tinyint(1) NOT NULL DEFAULT '0'
	) ENGINE=InnoDB DEFAULT CHARSET=latin1;
	");


	$db->query("
	INSERT INTO `".prefix."pages` (`id`, `icon`, `date`, `title`, `content`, `header`) VALUES
	(1, 'far fa-envelope-open', 1586270779, 'Contact us', 'Craeted By: Khalid puerto\r\nIf there any problem or issue don\'t hesitate to contact me in one of those social media links:\r\n\r\n[ul]\r\n[li]URL: [url=http://www.puertokhalid.com/][color=#2ecc40]www.puertokhalid.com[/color][/url][/li]\r\n[li]Facebook: [url=https://www.facebook.com/prof.puertokhalid][color=#2ecc40]www.facebook.com/prof.puertokhalid[/color][/url][/li]\r\n[li]Instagram: [url=https://www.instagram.com/khalidpuerto][color=#2ecc40]www.instagram.com/khalidpuerto[/color][/url][/li]\r\n[li]Whatsapp: [color=#2ecc40]+212 654 211 360[/color][/li]\r\n[/ul]\r\nYou are always welcomed, and I will be more than happy to assist you :)\r\n', 1),
	(2, 'far fa-question-circle', 1586270416, 'About us', '[b]Building a Family Tree with Puerto Family Tree PHP Script.[/b]\r\nIt is more than just a family tree.\r\n[u][i]A new home for family memories..[/i][/u]\r\n\r\n\r\n[b]Overview Video:[/b] https://www.youtube.com/watch?v=r1dun_oWh1Y\r\n\r\n[youtube]r1dun_oWh1Y[/youtube]\r\n\r\n[b]Installation:[/b] https://www.youtube.com/watch?v=BpYGysIx-MY\r\n[b]Edit Language:[/b] https://www.youtube.com/watch?v=0X9LIXa2t4I\r\n[b]What is new in this version (v1.0.1):[/b] https://www.youtube.com/watch?v=0X9LIXa2t4I\r\n\r\nBuilding a Family Tree.\r\n\r\nMake your family tree live with Puerto Family Tree and do not leave it just a memory hanging. build it with the participation of everyone and make it stretch to infinity.\r\n\r\n\r\n[b][color=#2ecc40]+ Puerto Family Tree Features:[/color][/b]\r\n\r\n[ol]\r\n[li]Unlimited Family Members[/li]\r\n[li]Multi-Language[/li]\r\n[li]Public &amp; Private View Protected with Password[/li]\r\n[li]Responsive Design[/li]\r\n[li]Clean Code &amp; Well Documented[/li]\r\n[/ol]\r\n[b][color=#2ecc40]+ What is new in this version (v1.0.1):[/color][/b]\r\n\r\n[ol]\r\n[li]Pictures Album for each members with beautiful view touch[/li]\r\n[li]New Ex-Partner (divorces) knot[/li]\r\n[li]Adding Marriage Date[/li]\r\n[li]beautiful date picker for birth date, death date and marriage date[/li]\r\n[li]Social media for each person[/li]\r\n[li]Social media share button[/li]\r\n[/ol]\r\n[b][color=#2ecc40]+ What is new in (v1.0.2):[/color][/b]\r\n\r\n[ol]\r\n[li]Users System[/li]\r\n[li]Full dashboard (With statistics and site manage)[/li]\r\n[li]Notifications system[/li]\r\n[li]Add moderators who can manage a specific family tree[/li]\r\n[li]Link users to a family member (node) for edit it[/li]\r\n[li]Remember registration data to login with it[/li]\r\n[li]Connect a family tree with other relatives families (Heritage members of a family)[/li]\r\n[li]Search system[/li]\r\n[li]Registration either open, need to be approval or verification by email address[/li]\r\n[li]Families either open or need to be approval by admin[/li]\r\n[li]Forget password[/li]\r\n[li]Hide/Unhide registration form[/li]\r\n[li]Add pages from dashboard[/li]\r\n[li]Urls beautify www.domain.com/tree/username[/li]\r\n[li]Fix some problems[/li]\r\n[/ol]\r\n', 1),
	(3, 'fas fa-user-secret', 1586271295, 'Privacy Policy', '[size=6]Privacy Policy for Puerto Khalid[/size]\r\n\r\nAt puertokhalid, accessible from http://puertokhalid.com, one of our main priorities is the privacy of our visitors. This Privacy Policy document contains types of information that is collected and recorded by puertokhalid and how we use it.\r\n\r\nIf you have additional questions or require more information about our Privacy Policy, do not hesitate to contact us.\r\n\r\nThis Privacy Policy applies only to our online activities and is valid for visitors to our website with regards to the information that they shared and/or collect in puertokhalid. This policy is not applicable to any information collected offline or via channels other than this website.\r\n\r\n[b]Consent[/b]\r\n\r\nBy using our website, you hereby consent to our Privacy Policy and agree to its terms.\r\nInformation we collect\r\nThe personal information that you are asked to provide, and the reasons why you are asked to provide it, will be made clear to you at the point we ask you to provide your personal information.\r\nIf you contact us directly, we may receive additional information about you such as your name, email address, phone number, the contents of the message and/or attachments you may send us, and any other information you may choose to provide.\r\nWhen you register for an Account, we may ask for your contact information, including items such as name, company name, address, email address, and telephone number.\r\nHow we use your information\r\nWe use the information we collect in various ways, including to:\r\n[ul]\r\n[li]Provide, operate, and maintain our webste[/li]\r\n[li]Improve, personalize, and expand our webste[/li]\r\n[li]Understand and analyze how you use our webste[/li]\r\n[li]Develop new products, services, features, and functionality[/li]\r\n[li]Communicate with you, either directly or through one of our partners, including for customer service, to provide you with updates and other information relating to the webste, and for marketing and promotional purposes[/li]\r\n[li]Send you emails[/li]\r\n[li]Find and prevent fraud[/li]\r\n[/ul]\r\n\r\n[b]Log Files[/b]\r\n\r\npuertokhalid follows a standard procedure of using log files. These files log visitors when they visit websites. All hosting companies do this and a part of hosting services\' analytics. The information collected by log files include internet protocol (IP) addresses, browser type, Internet Service Provider (ISP), date and time stamp, referring/exit pages, and possibly the number of clicks. These are not linked to any information that is personally identifiable. The purpose of the information is for analyzing trends, administering the site, tracking users\' movement on the website, and gathering demographic information.\r\n\r\n[b]Cookies and Web Beacons[/b]\r\nLike any other website, puertokhalid uses \'cookies\'. These cookies are used to store information including visitors\' preferences, and the pages on the website that the visitor accessed or visited. The information is used to optimize the users\' experience by customizing our web page content based on visitors\' browser type and/or other information.\r\nFor more general information on cookies, please read [url=https://www.cookieconsent.com/what-are-cookies/]&quot;What Are Cookies&quot;[/url].\r\n\r\n[b]Google DoubleClick DART Cookie[/b]\r\nGoogle is one of a third-party vendor on our site. It also uses cookies, known as DART cookies, to serve ads to our site visitors based upon their visit to www.website.com and other sites on the internet. However, visitors may choose to decline the use of DART cookies by visiting the Google ad and content network Privacy Policy at the following URL – [url=https://policies.google.com/technologies/ads]https://policies.google.com/technologies/ads[/url]\r\n\r\n[b]Advertising Partners Privacy Policies[/b]\r\nYou may consult this list to find the Privacy Policy for each of the advertising partners of puertokhalid.\r\nThird-party ad servers or ad networks uses technologies like cookies, JavaScript, or Web Beacons that are used in their respective advertisements and links that appear on puertokhalid, which are sent directly to users\' browser. They automatically receive your IP address when this occurs. These technologies are used to measure the effectiveness of their advertising campaigns and/or to personalize the advertising content that you see on websites that you visit.\r\nNote that puertokhalid has no access to or control over these cookies that are used by third-party advertisers.\r\n\r\n[b]Third Party Privacy Policies[/b]\r\npuertokhalid\'s Privacy Policy does not apply to other advertisers or websites. Thus, we are advising you to consult the respective Privacy Policies of these third-party ad servers for more detailed information. It may include their practices and instructions about how to opt-out of certain options. You may find a complete list of these Privacy Policies and their links here: Privacy Policy Links.\r\nYou can choose to disable cookies through your individual browser options. To know more detailed information about cookie management with specific web browsers, it can be found at the browsers\' respective websites. What Are Cookies?\r\n\r\n[b]CCPA Privacy Rights (Do Not Sell My Personal Information)[/b]\r\nUnder the CCPA, among other rights, California consumers have the right to:\r\nRequest that a business that collects a consumer\'s personal data disclose the categories and specific pieces of personal data that a business has collected about consumers.\r\nRequest that a business delete any personal data about the consumer that a business has collected.\r\nRequest that a business that sells a consumer\'s personal data, not sell the consumer\'s personal data.\r\nIf you make a request, we have one month to respond to you. If you would like to exercise any of these rights, please contact us.\r\n\r\n[b]GDPR Data Protection Rights[/b]\r\nWe would like to make sure you are fully aware of all of your data protection rights. Every user is entitled to the following:\r\nThe right to access – You have the right to request copies of your personal data. We may charge you a small fee for this service.\r\nThe right to rectification – You have the right to request that we correct any information you believe is inaccurate. You also have the right to request that we complete the information you believe is incomplete.\r\nThe right to erasure – You have the right to request that we erase your personal data, under certain conditions.\r\nThe right to restrict processing – You have the right to request that we restrict the processing of your personal data, under certain conditions.\r\n\r\nThe right to object to processing – You have the right to object to our processing of your personal data, under certain conditions.\r\nThe right to data portability – You have the right to request that we transfer the data that we have collected to another organization, or directly to you, under certain conditions.\r\nIf you make a request, we have one month to respond to you. If you would like to exercise any of these rights, please contact us.\r\n\r\n[b]Children\'s Information[/b]\r\nAnother part of our priority is adding protection for children while using the internet. We encourage parents and guardians to observe, participate in, and/or monitor and guide their online activity.\r\n\r\npuertokhalid does not knowingly collect any Personal Identifiable Information from children under the age of 13. If you think that your child provided this kind of information on our website, we strongly encourage you to contact us immediately and we will do our best efforts to promptly remove such information from our records.\r\n', 0);
	");


	$db->query("
	CREATE TABLE `".prefix."reset_passwords` (
	  `id` smallint(5) UNSIGNED NOT NULL,
	  `email` varchar(255) DEFAULT NULL,
	  `date` int(10) UNSIGNED DEFAULT NULL,
	  `ip` varchar(255) DEFAULT NULL,
	  `status` tinyint(1) UNSIGNED DEFAULT NULL,
	  `token` varchar(100) DEFAULT NULL
	) ENGINE=InnoDB DEFAULT CHARSET=latin1;
	");


	$db->query("
	CREATE TABLE `".prefix."users` (
	  `id` int(11) NOT NULL,
	  `username` varchar(200) DEFAULT NULL,
	  `password` varchar(200) DEFAULT NULL,
	  `date` int(10) UNSIGNED DEFAULT '0',
	  `status` tinyint(1) UNSIGNED DEFAULT NULL,
	  `token` varchar(200) DEFAULT NULL,
	  `updated_at` int(10) UNSIGNED DEFAULT NULL,
	  `family` smallint(6) UNSIGNED DEFAULT '0',
	  `firstname` varchar(100) DEFAULT NULL,
	  `lastname` varchar(100) DEFAULT NULL,
	  `gender` tinyint(1) UNSIGNED DEFAULT '0',
	  `birth` varchar(100) DEFAULT NULL,
	  `death` tinyint(1) UNSIGNED DEFAULT '0',
	  `type` tinyint(1) UNSIGNED DEFAULT '0',
	  `photo` varchar(255) DEFAULT NULL,
	  `email` varchar(200) DEFAULT NULL,
	  `site` varchar(200) DEFAULT NULL,
	  `tel` varchar(15) DEFAULT NULL,
	  `mobile` varchar(15) DEFAULT NULL,
	  `birthplace` varchar(255) DEFAULT NULL,
	  `deathplace` varchar(255) DEFAULT NULL,
	  `profession` varchar(255) DEFAULT NULL,
	  `company` varchar(255) DEFAULT NULL,
	  `interests` varchar(255) DEFAULT NULL,
	  `bio` text,
	  `level` tinyint(1) UNSIGNED DEFAULT '1',
	  `parent` int(11) UNSIGNED DEFAULT '0',
	  `birthday` tinyint(2) UNSIGNED DEFAULT '0',
	  `birthmonth` tinyint(2) UNSIGNED DEFAULT '0',
	  `birthyear` smallint(4) UNSIGNED DEFAULT '0',
	  `deathday` tinyint(2) UNSIGNED DEFAULT '0',
	  `deathmonth` tinyint(2) UNSIGNED DEFAULT '0',
	  `deathyear` smallint(4) UNSIGNED DEFAULT '0',
	  `birthdate` int(11) DEFAULT '0',
	  `mariagedate` int(11) DEFAULT '0',
	  `deathdate` int(11) DEFAULT '0',
	  `facebook` varchar(255) DEFAULT NULL,
	  `instagram` varchar(255) DEFAULT NULL,
	  `twitter` varchar(255) DEFAULT NULL
	) ENGINE=InnoDB DEFAULT CHARSET=latin1;
	");


	$db->query("
	ALTER TABLE `".prefix."configs`
	  ADD PRIMARY KEY (`id`);
	");
	$db->query("
	ALTER TABLE `".prefix."families`
	  ADD PRIMARY KEY (`id`);
	");
	$db->query("
	ALTER TABLE `".prefix."heritage`
	  ADD PRIMARY KEY (`id`);
	");
	$db->query("
	ALTER TABLE `".prefix."images`
	  ADD PRIMARY KEY (`id`);
	");
	$db->query("
	ALTER TABLE `".prefix."members`
	  ADD PRIMARY KEY (`id`);
	");
	$db->query("
	ALTER TABLE `".prefix."notifications`
	  ADD PRIMARY KEY (`id`);
	");
	$db->query("
	ALTER TABLE `".prefix."pages`
	  ADD PRIMARY KEY (`id`);
	");
	$db->query("
	ALTER TABLE `".prefix."reset_passwords`
	  ADD PRIMARY KEY (`id`);
	");
	$db->query("
	ALTER TABLE `".prefix."users`
	  ADD PRIMARY KEY (`id`);
	");
	$db->query("
	ALTER TABLE `".prefix."configs`
	  MODIFY `id` tinyint(3) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
	");
	$db->query("
	ALTER TABLE `".prefix."families`
	  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;
	");

	$db->query("
	ALTER TABLE `".prefix."heritage`
	  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
	");
	$db->query("
	ALTER TABLE `".prefix."images`
	  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
	");
	$db->query("
	ALTER TABLE `".prefix."members`
	  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
	");
	$db->query("
	ALTER TABLE `".prefix."notifications`
	  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
	");
	$db->query("
	ALTER TABLE `".prefix."pages`
	  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
	");
	$db->query("
	ALTER TABLE `".prefix."reset_passwords`
	  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT;
	");
	$db->query("
	ALTER TABLE `".prefix."users`
	  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
	");

	$db->query("
		INSERT INTO `".prefix."users` (`id`, `username`, `password`, `date`, `status`, `token`, `updated_at`, `family`, `firstname`, `lastname`, `gender`, `birth`, `death`, `type`, `photo`, `email`, `site`, `tel`, `mobile`, `birthplace`, `deathplace`, `profession`, `company`, `interests`, `bio`, `level`, `parent`, `birthday`, `birthmonth`, `birthyear`, `deathday`, `deathmonth`, `deathyear`, `birthdate`, `mariagedate`, `deathdate`, `facebook`, `instagram`, `twitter`) VALUES
	(1, '{$admin}', '".sc_pass($pass)."', ".time().", 0, '', NULL, 0, NULL, NULL, 0, NULL, 0, 0, NULL, '{$email}', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 6, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL);
	");

	$db->query("INSERT INTO `".prefix."configs` (`id`, `variable`, `value`) VALUES (NULL, 'color1', '#27ae60'), (NULL, 'color2', '#2ecc71'), (NULL, 'color3', '#0e8842'), (NULL, 'color4', '#f0f9f7'), (NULL, 'color5', '#35a299'), (NULL, 'color6', '#a29bfe'), (NULL, 'color7', '#fdb105'), (NULL, 'color8', '#d43233'), (NULL, 'color9', '#000'), (NULL, 'color10', '#DDD');");





	$db->query("ALTER TABLE `".prefix."users` ADD `plan` TINYINT(1) NULL DEFAULT '0' AFTER `twitter`, ADD `lastpayment` INT NULL DEFAULT '0' AFTER `plan`;");


	$db->query("
	INSERT INTO `".prefix."configs` (`id`, `variable`, `value`) VALUES
	(51, 'site_smtp_auth', '1'),
	(50, 'site_smtp_port', '587'),
	(26, 'site_noreply', 'donotreply@puertokhalid.com'),
	(31, 'login_facebook', '1'),
	(32, 'login_twitter', '1'),
	(33, 'login_google', '1'),
	(34, 'login_fbAppId', ''),
	(35, 'login_fbAppSecret', ''),
	(36, 'login_fbAppVersion', ''),
	(37, 'login_twConKey', ''),
	(38, 'login_twConSecret', ''),
	(39, 'login_ggClientId', ''),
	(40, 'login_ggClientSecret', ''),
	(41, 'site_paypal_id', ''),
	(42, 'site_paypal_live', '0'),
	(43, 'site_currency_name', 'USD'),
	(44, 'site_currency_symbol', '$'),
	(45, 'site_smtp', '0'),
	(46, 'site_smtp_host', 'localhost'),
	(47, 'site_smtp_username', ''),
	(48, 'site_smtp_password', ''),
	(49, 'site_smtp_encryption', 'none'),
	(52, 'site_favicon', 'assets/img/fav.png'),
	(53, 'site_paypal_client_id', ''),
	(54, 'site_paypal_client_secret', ''),
	(62, 'site_stripe_key', ''),
	(63, 'site_stripe_secret', ''),
	(65, 'site_ads1', '<a href=\"https://codecanyon.net/item/ifood-multi-restaurant-merchant-hosting-site/27556124\" target=\"_blank\"><img src=\"https://puertokhalid.com/puertosurveys/v1.2/img/ads/728x90cs.jpg\"></a>'),
	(66, 'site_ads2', '<img src=\"http://puertokhalid.com/quizy/assets/img/ads/ads2.png\">'),
	(67, 'site_ads3', '<img src=\"http://puertokhalid.com/quizy/assets/img/ads/ads3.png\">'),
	(68, 'site_ads4', '<img src=\"http://puertokhalid.com/quizy/assets/img/ads/ads3.png\">'),
	(69, 'site_ads5', '<img src=\"http://puertokhalid.com/quizy/assets/img/ads/ads2.png\">'),
	(70, 'site_ads6', '<img src=\"http://puertokhalid.com/quizy/assets/img/ads/ads2.png\">'),
	(71, 'site_language', '{\"rtl\":\"false\",\"lang\":\"en\",\"success\":\"Success!\",\"error\":\"Error!\",\"rip\":\"R.I.P\",\"site\":{\"title\":\"Puerto Family Tree\",\"no-result\":\"No Result Found!\",\"submit\":\"Submit\",\"close\":\"Close\",\"emailver\":\"Email verification:\"},\"header\":{\"welcome\":\"Welcome!\",\"search\":\"Search for family...\",\"home\":\"Home\",\"family\":\"Family Trees\",\"plans\":\"Plans\",\"about\":\"About Us\",\"contact\":\"Contact Us\",\"details\":\"Your Details\",\"logout\":\"Logout!\",\"no-not\":\"No notifications\",\"newtree\":\"Create a tree\",\"dashboard\":\"Dashboard\",\"users\":\"Users\",\"fam\":\"Family Tree\",\"fammanag\":\"Managers (Only Usernames):\"},\"plans\":{\"title\":\"Simple Pricing for Everyone!\",\"desc\":\"Pricing is built for businesses of all sizes. Always know what you will pay. All plans come with a 100% money-back guarantee.\",\"month\":\"/per month\",\"btn\":\"Get Started\",\"alert\":{\"success\":\"Your payments have been calculated!\"}},\"indexpage\":{\"h4\":\"Building Family Tree.\",\"h2\":\"Who are they?\",\"p\":\"Make your family tree live with Puerto Family Tree and do not leave it just a memory hanging. build it with the participation of everyone and make it stretch to infinity.\",\"form\":{\"b\":\"More than just a family tree.\",\"s\":\"A new home for family memories\",\"login\":\"Login\",\"register\":\"Register\",\"fid\":{\"l\":\"Family ID:\",\"i\":\"Write your family ID\"},\"pass\":{\"l\":\"Password:\",\"i\":\"Write your password\"},\"npass\":{\"l\":\"New Password:\",\"i\":\"Write your new password\"},\"vpass\":{\"l\":\"View Password:\",\"i\":\"Write your view password\"},\"email\":{\"l\":\"Email:\",\"i\":\"Write your email\"},\"in\":\"Sign In\",\"up\":\"Sign Up\",\"view\":\"Can everyone see this family (public view)\"},\"my\":\"My Family Tree\",\"list\":\"List Of the trees you manage!\",\"more\":\"More Results!\",\"forget\":\"Forget your password?\",\"reset\":\"Reset it now\",\"pravicy\":\"Pravicy policy\",\"byclick\":\"By clicking in Sign up button you are automaticly accepting in our {a}, dont hasitate to read it first!\"},\"treepage\":{\"vp\":{\"t\":\"View Password :\",\"p\":\"We are sorry to inform you that, this family isnt public view. you need to have password view to show it.\",\"i\":\"Write the view password\",\"b\":\"Submit\"},\"edit\":\"Edit\",\"new\":\"New Member\",\"link\":\"Tree Link\",\"fam\":\"s Family Tree:\",\"share\":\"Share\",\"share_f\":\"Share on Facebook\",\"share_t\":\"Share on Twitter\",\"share_w\":\"Share on Whatsapp\",\"share_e\":\"Send in Email\",\"pdf\":\"Export PDF\"},\"heritage\":{\"title\":\"Heritage a family                     :\",\"link\":\"Link this momber as a parent of family:\"},\"detailspage\":{\"title\":\"Manege your details\",\"send\":\"Send Details\",\"username\":\"Your Username\",\"username_l\":\"Write your username\"},\"contactpage\":{\"title\":\"Contact Us\"},\"aboutpage\":{\"title\":\"About Us\"},\"userspage\":{\"title\":\"Users:\",\"families\":\"families\"},\"resetpage\":{\"title1\":\"Reset your password:\",\"email\":\"Your Registred Email Address\",\"title\":\"Reset new password :\",\"npass\":\"New Password       :\",\"npass_l\":\"type your password\",\"rpass\":\"Re-Password        :\",\"rpass_l\":\"type your re-password\"},\"listpage\":{\"title\":\"Famelie Tree List\",\"no-result\":\"No Result Found!\",\"members\":\"Members\",\"my\":\"My Trees\",\"edit\":\"Edit\"},\"timedate\":{\"time_second\":\"second\",\"time_minute\":\"minute\",\"time_hour\":\"hour\",\"time_day\":\"day\",\"time_week\":\"week\",\"time_month\":\"month\",\"time_year\":\"year\",\"time_decade\":\"decade\",\"time_ago\":\"ago\"},\"newmember\":{\"title\":\"Add New member\",\"personal\":\"Personal\",\"contact\":\"Contact\",\"biographical\":\"Biographical\",\"pictures\":\"Pictures\",\"link\":\"Link this member to a user:\",\"first\":\"First Name:\",\"last\":\"Last Name\",\"gender\":\"Gender\",\"female\":\"Female\",\"male\":\"Male\",\"rtype\":\"Relation Type\",\"child\":\"Child\",\"ex\":\"Ex-Partner\",\"parent\":\"Parent\",\"partner\":\"Partner\",\"bdate\":\"Birth Date\",\"mdate\":\"Mariage Date\",\"ddate\":\"Death Date\",\"alive\":\"This person is alive\",\"photo_url\":\"Enter Photo URL\",\"photo\":\"Photo\",\"choose\":\"Choose an image from your device\",\"instead\":\"Or choose an avatar instead\",\"website\":\"Website\",\"tel\":\"Home Tel\",\"mobile\":\"Mobile\",\"bplace\":\"Birth Place\",\"dplace\":\"Death Place\",\"profession\":\"Profession\",\"company\":\"Company\",\"interests\":\"Interests\",\"bio\":\"Bio Notes\",\"photos\":\"Photos\",\"lab1\":\"Enter first name\",\"lab2\":\"Enter last name\",\"lab3\":\"Enter Facebook\",\"lab4\":\"Enter Twitter\",\"lab5\":\"Enter Instagram\",\"lab6\":\"Enter Email\",\"lab7\":\"Enter Website\",\"lab8\":\"Enter Home Tel\",\"lab9\":\"Enter Mobile\",\"lab10\":\"Enter Birth Place\",\"lab11\":\"Enter Death Place\",\"lab12\":\"Enter Profession\",\"lab13\":\"Enter Company\",\"lab14\":\"Enter Interests\",\"lab15\":\"Enter Bio Notes\",\"bornat\":\"Born at\",\"bornin\":\"in\",\"deadat\":\"Dead at\",\"marriageat\":\"Marriage at\"},\"details\":{\"title\":\"Manage infos:\",\"firstname\":\"Your first name\",\"lastname\":\"Your last name\",\"username\":\"Edit Username\",\"password\":\"Edit Password\",\"email\":\"Edit Email\",\"male\":\"Male\",\"female\":\"Female\",\"country\":\"Country\",\"state\":\"State/Region\",\"city\":\"City\",\"address\":\"Full Address\",\"image_n\":\"No image chosen...\",\"image_c\":\"Choose Image\",\"button\":\"Send info\",\"alert\":{\"success\":\"Edit infos process has ended successfully.\"}},\"alerts\":{\"families\":\"Your number of families that you can add for the plan you have is expired, please upgrade your plan for more!\",\"members\":\"Your number of members per family that you can add for the plan you have is expired, please upgrade your plan for more!\",\"albums\":\"You dont have permission to add photos in albums using the plan you have, please upgrade your plan for more!\",\"heritage\":\"You dont have permission to heritage using the plan you have, please upgrade your plan for more!\",\"no-data\":\"No data found!\",\"nodata\":\"No data found!\",\"logout\":\"Are you sure you want to logout?\",\"nofile\":\"No file chosen...\",\"required\":\"All fields are required!\",\"login\":\"You have login succesfully!\",\"viewp\":\"View password is incorrect!\",\"wrong\":\"something wrong!\",\"done\":\"All done!\",\"payment\":\"Payment success!\",\"payment_f\":\"Failed to retrieve payment from PayPal!\",\"alldone\":\"Success, all done!\",\"famexist\":\"This family is already exist!\",\"name\":\"Name is required!\",\"correctemail\":\"You need a correct email address!\",\"existemail\":\"This Email is already exist!\",\"existusername\":\"This Username is already exist!\",\"regsuccess\":\"Your have being registred succesfuly.\",\"regsuccess1\":\"Your have being registred succesfuly, but we sent you an email for verification!\",\"regsuccess2\":\"Your have being registred succesfuly, but need to be accepted by administration!\",\"famsuccess\":\"Your family ID has created succesfully!\",\"logsuccess\":\"You have login succesfully!\",\"logapprov\":\"this user needs approval by administration before sign in!\",\"logverif\":\"this user needs to verify by email address!\",\"logerror\":\"Family ID or password is incorrect!\",\"reseterror\":\"There is no user with this info!\",\"resetsuccess\":\"The resset password sent succcesfuly.\",\"permission\":\"You have no permission for accessing to this page!\",\"emailver\":\"All right, you can login now.\",\"her_1\":\"you cant herirate this family beacause it isnt yours!\",\"her_2\":\"you cant herirate a family twise in the same tree!\",\"her_3\":\"you cant herirate this family beacause it isnt public!\",\"her_4\":\"you cant herirate this family!\",\"pass1\":\"password more than 6 letters\",\"pass2\":\"password dont match repassword\",\"pass3\":\"you can login now with this new password\",\"de_mem\":\"Are you sure you want to delete this memebr?\"},\"dash\":{\"p_disacticate\":\"Disable plans option\",\"planalert\":\"The plans have been saved successfully.\",\"p_title\":\"Payments\",\"p_user\":\"User\",\"p_status\":\"Status\",\"p_amount\":\"Amount\",\"p_paymentid\":\"Payment ID\",\"p_payerid\":\"Payer ID\",\"created_at\":\"Created At\",\"u_create\":\"Create a User\"},\"dashboard\":{\"hello\":\"Hello,\",\"welcome\":\"Welcome back again to your dashboard.\",\"stats_line_d\":\"Statistics for the last 7 days\",\"stats_line_m\":\"Statistics for this year\",\"stats_bar_d\":\"Statistics for the last 7 days\",\"stats_bar_m\":\"Statistics for this year\",\"surveys\":\"Families\",\"families\":\"Families\",\"users\":\"Users\",\"responses\":\"Members\",\"questions\":\"Images\",\"new_u\":\"New Users (24h)\",\"new_p\":\"Latest Payements (24h)\",\"new_s\":\"Latest Surveys (24h)\",\"u_users\":\"Members\",\"u_status\":\"Status\",\"u_username\":\"Username\",\"u_plan\":\"Plan\",\"u_pages\":\"Pages\",\"u_credits\":\"Credits\",\"u_last_p\":\"Last Payment\",\"u_registred\":\"Registred at\",\"u_updated\":\"Updated at\",\"u_delete\":\"Delete User\",\"u_edit\":\"Edit User\",\"p_title\":\"Payments\",\"p_user\":\"User\",\"p_status\":\"Status\",\"p_plan\":\"Plan\",\"p_amount\":\"Amount\",\"p_date\":\"Payment Date\",\"p_txn\":\"TXN\",\"set_title\":\"General Settings\",\"set_stitle\":\"Site title:\",\"set_keys\":\"Site keywords:\",\"set_desc\":\"Site Description:\",\"set_url\":\"Site URL:\",\"set_btn\":\"Send Settings\",\"days\":\"Days\",\"months\":\"Months\",\"latest_f\":\"Latest Families\",\"latest_m\":\"Latest Members\",\"status\":\"Status\",\"name\":\"name\",\"public\":\"public\",\"members\":\"members\",\"moderators\":\"moderators\",\"date\":\"Date\",\"edit\":\"Edit\",\"delete\":\"Delete\",\"verification\":\"Verification\",\"npage\":\"New Page\",\"title\":\"Title\",\"inmenu\":\"in Menu\",\"created\":\"Created\",\"regstatus\":\"Registration Status:\",\"mneedsapproval\":\"Need Approval Without Email\",\"open\":\"Open\",\"hidereg\":\"Hide registration form\",\"fneedsapproval\":\"Families needs approval before being live\",\"colors\":\"Colors\",\"byemail\":\"By Email\",\"ptitle\":\"Page Title\",\"picon\":\"Page Icon\",\"pcontent\":\"Page Content\",\"dmenu\":\"Display it in menu\",\"save\":\"Save\",\"alert\":{\"success\":\"Setting has sent successfully.\"}}}');
	") or die($db->error);



	$db->query("
	CREATE TABLE `".prefix."payments` (
	  `id` int(11) NOT NULL,
	  `plan` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
	  `payment_id` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
	  `payer_id` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
	  `token` varchar(150) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
	  `price` float(10,2) DEFAULT NULL,
	  `currency` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
	  `status` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
	  `date` int(11) DEFAULT '0',
	  `author` int(11) DEFAULT '0'
	) ENGINE=InnoDB DEFAULT CHARSET=utf8;
	") or die($db->error);

	$db->query("
	CREATE TABLE `".prefix."plans` (
		`id` int(11) NOT NULL,
  `plan` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` float(10,2) DEFAULT NULL,
  `currency` varchar(5) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `desc1` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `desc2` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `desc3` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `desc4` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `desc5` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `desc7` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `desc8` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `desc9` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) DEFAULT '0',
  `quizzes` int(11) DEFAULT '0',
  `takers` int(11) DEFAULT '0',
  `questions` int(11) DEFAULT '0',
  `export_statistics` tinyint(1) DEFAULT '0',
  `backgound` tinyint(1) DEFAULT '0',
  `integrations` tinyint(1) DEFAULT '0',
  `show_ads` tinyint(1) DEFAULT '0',
  `support` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
	") or die($db->error);

	$db->query("
	INSERT INTO `".prefix."plans` (`id`, `plan`, `price`, `currency`, `desc1`, `desc2`, `desc3`, `desc4`, `desc5`, `desc7`, `desc8`, `desc9`, `created_at`, `quizzes`, `takers`, `questions`, `export_statistics`, `backgound`, `integrations`, `show_ads`, `support`) VALUES
(1, 'Free Plan', 0.00, '$', '3 Famillies', '10 Members per family', '1 Private Family', 'Enable to heritate families', 'Enable to create albums', 'PDF Export', 'No advertisements', 'Priority support', 0, 1, 10, 10, 0, 0, 0, 0, 0),
(2, 'Basic Plan', 9.99, '$', '12 Famillies', '50 Members per family', '20 Private Family', 'Enable to heritate families', 'Enable to create albums', 'PDF Export', 'No advertisements', 'Priority support', 0, 12, 50, 20, 0, 1, 0, 0, 0),
(3, 'Regular Plan', 19.99, '$', 'Unlimited Famillies', 'Unlimited Members per family', 'Unlimited Private Family', 'Enable to heritate families', 'Enable to create albums', 'PDF Export', 'No advertisements', 'Priority support', 0, 999999, 999999, 999999, 1, 1, 1, 1, 1);
	") or die($db->error);

	$db->query("
	ALTER TABLE `".prefix."payments` ADD PRIMARY KEY (`id`);
	") or die($db->error);

	$db->query("
	ALTER TABLE `".prefix."plans` ADD PRIMARY KEY (`id`);
	") or die($db->error);

	$db->query("
	ALTER TABLE `".prefix."payments` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
	") or die($db->error);

	$db->query("
	ALTER TABLE `".prefix."plans` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
	") or die($db->error);






	$db->query("ALTER TABLE `".prefix."members` CHANGE `birthdate` `birthdate` BIGINT NULL DEFAULT '0';") or die( $db->error );
	$db->query("ALTER TABLE `".prefix."members` CHANGE `mariagedate` `mariagedate` BIGINT NULL DEFAULT '0';") or die( $db->error );
	$db->query("ALTER TABLE `".prefix."members` CHANGE `deathdate` `deathdate` BIGINT NULL DEFAULT '0';") or die( $db->error );



	$db->query("
	CREATE TABLE `".prefix."languages` (
	  `id` int(11) NOT NULL,
	  `language` varchar(100) DEFAULT NULL,
	  `short` varchar(4) DEFAULT NULL,
	  `isdefault` tinyint(1) NOT NULL,
	  `created_at` int(11) DEFAULT NULL,
	  `updated_at` int(11) DEFAULT NULL,
	  `content` longtext
	) ENGINE=InnoDB DEFAULT CHARSET=utf8;
	") or die( $db->error );

	$en = '{"rtl":"rtl_false","lang":"en","success":"Success!","error":"Error!","rip":"R.I.P","no-result":"No Result Found!","submit":"Submit","close":"Close","header":{"welcome":"Welcome!","search":"Search for family...","home":"Home","family":"Family Trees","plans":"Plans","about":"About Us","contact":"Contact Us","details":"Your Details","logout":"Logout!","no-not":"No notifications","newtree":"Create a tree","dashboard":"Dashboard","users":"Users","fam":"Family Tree","fammanag":"Managers (Only Usernames):","emailver":"Email verification:"},"plans":{"title":"Simple Pricing for Everyone!","desc":"Pricing is built for businesses of all sizes. Always know what you\'ll pay. &lt;br \/&gt;All plans come with a 100% money-back guarantee.","month":"\/per month","btn":"Get Started"},"indexpage":{"h4":"Building Family Tree.","h2":"Who are they?","p":"Make your family tree live with Puerto Family Tree and do not leave it just a memory hanging. build it with the participation of everyone and make it stretch to infinity.","form_b":"More than just a family tree.","form_s":"A new home for family memories","form_login":"Login","form_register":"Register","form_fid_l":"Family ID:","form_fid_i":"Write your family ID","form_pass_l":"Password:","form_pass_i":"Write your password","form_npass_l":"New Password:","form_npass_i":"Write your new password","form_vpass_l":"View Password:","form_vpass_i":"Write your view password","form_email_l":"Email:","form_email_i":"Write your email","form_in":"Sign In","form_up":"Sign Up","form_view":"Can everyone see this family (public view)","my":"My Family Tree","list":"List Of the trees you manage!","more":"More Results!","forget":"Forget your password?","reset":"Reset it now","pravicy":"Pravicy policy","byclick":"By clicking in \'Sign up\' button you are automaticly accepting in our {a}, don\'t hasitate to read it first!"},"treepage":{"vp_t":"View Password :","vp_p":"We are sorry to inform you that, this family isn\'t public view. you need to have password view to show it.","vp_i":"Write the view password","vp_b":"Submit","edit":"Edit","new":"New Member","link":"Tree Link","fam":"\'s Family Tree:","share":"Share","share_f":"Share on Facebook","share_t":"Share on Twitter","share_w":"Share on Whatsapp","share_e":"Send in Email","pdf":"Export PDF"},"heritage":{"title":"Heritage a family :","link":"Link this momber as a parent of family:"},"detailspage":{"title":"Manege your details","send":"Send Details","username":"Your Username","username_l":"Write your username","image_n":"No image chosen...","image_c":"Choose Image"},"resetpage":{"title1":"Reset your password:","email":"Your Registred Email Address","title":"Reset new password :","npass":"New Password       :","npass_l":"type your password","rpass":"Re-Password :","rpass_l":"type your re-password"},"listpage":{"title":"Famelie Tree List","no-result":"No Result Found!","members":"Members","my":"My Trees","edit":"Edit"},"timedate":{"time_second":"second","time_minute":"minute","time_hour":"hour","time_day":"day","time_week":"week","time_month":"month","time_year":"year","time_decade":"decade","time_ago":"ago"},"newmember":{"title":"Add New member","personal":"Personal","contact":"Contact","biographical":"Biographical","pictures":"Pictures","link":"Link this member to a user:","first":"First Name:","last":"Last Name","gender":"Gender","female":"Female","male":"Male","rtype":"Relation Type","child":"Child","ex":"Ex-Partner","parent":"Parent","partner":"Partner","bdate":"Birth Date","mdate":"Mariage Date","ddate":"Death Date","alive":"This person is alive","photo_url":"Enter Photo URL","photo":"Photo","choose":"Choose an image from your device","instead":"Or choose an avatar instead","website":"Website","tel":"Home Tel","mobile":"Mobile","bplace":"Birth Place","dplace":"Death Place","profession":"Profession","company":"Company","interests":"Interests","bio":"Bio Notes","photos":"Photos","lab1":"Enter first name","lab2":"Enter last name","lab3":"Enter Facebook","lab4":"Enter Twitter","lab5":"Enter Instagram","lab6":"Enter Email","lab7":"Enter Website","lab8":"Enter Home Tel","lab9":"Enter Mobile","lab10":"Enter Birth Place","lab11":"Enter Death Place","lab12":"Enter Profession","lab13":"Enter Company","lab14":"Enter Interests","lab15":"Enter Bio Notes","bornat":"Born at","bornin":"in","deadat":"Dead at","marriageat":"Marriage at"},"alerts":{"required":"All fields are required!","login":"You have login succesfully!","viewp":"View password is incorrect!","her_1":"you can\'t herirate this family beacause it isn\'t yours!","her_2":"you can\'t herirate a family twise in the same tree!","her_3":"you can\'t herirate this family beacause it isn\'t public!","her_4":"you can\'t herirate this family!","alldone":"Success, all done!","famexist":"This family is already exist!","name":"Name is required!","wrong":"something wrong!","correctemail":"You need a correct email address!","existemail":"This Email is already exist!","existusername":"This Username is already exist!","regsuccess":"Your have being registred succesfuly.","regsuccess1":"Your have being registred succesfuly, but we sent you an email for verification!","regsuccess2":"Your have being registred succesfuly, but need to be accepted by administration!","famsuccess":"Your family ID has created succesfully!","logsuccess":"You have login succesfully!","logapprov":"this user needs approval by administration before sign in!","logverif":"this user needs to verify by email address!","logerror":"Family ID or password is incorrect!","reseterror":"There is no user with this info!","resetsuccess":"The resset password sent succcesfuly.","pass1":"password more than 6 letters","pass2":"password don\'t match repassword","pass3":"you can login now with this new password","nodata":"No data found!","emailver":"All right, you can login now.","families":"Your number of families that you can add for the plan you have is expired, please upgrade your plan for more!","heritage":"You don\'t have permission to heritage using the plan you have, please upgrade your plan for more!","members":"Your number of members per family that you can add for the plan you have is expired, please upgrade your plan for more!","albums":"You don\'t have permission to add photos in albums using the plan you have, please upgrade your plan for more!","permission":"You have no permission for accessing to this page!","payment":"Payment success!","payment_f":"Failed to retrieve payment from PayPal!","logout":"Are you sure you want to logout?","nofile":"No file chosen...","de_mem":"Are you sure you want to delete this memebr?"},"dashboard":{"hello":"Hello,","welcome":"Welcome back again to your dashboard.","families":"Families","users":"Users","responses":"Members","questions":"Images","days":"Days","months":"Months","new_u":"New Users (24h)","latest_f":"Latest Families","latest_m":"Latest Members","save":"Save","p_disacticate":"Disable plans option","status":"Status","name":"name","public":"public","members":"members","moderators":"moderators","date":"Date","edit":"Edit","delete":"Delete","u_users":"Members","u_status":"Status","u_username":"Username","verification":"Verification","u_registred":"Registred at","u_updated":"Updated at","u_delete":"Delete User","u_edit":"Edit User","u_create":"Create a User","u_pages":"Pages","npage":"New Page","title":"Title","inmenu":"in Menu","created":"Created","p_title":"Payments","p_user":"User","u_plan":"Plan","p_amount":"Amount","p_paymentid":"Payment ID","p_payerid":"Payer ID","created_at":"Created At","set_title":"General Settings","set_stitle":"Site title:","set_keys":"Site keywords:","set_desc":"Site Description:","set_url":"Site URL:","regstatus":"Registration Status:","byemail":"By Email","mneedsapproval":"Need Approval Without Email","open":"Open","hidereg":"Hide registration form","fneedsapproval":"Families needs approval before being live","colors":"Colors","ptitle":"Page Title","picon":"Page Icon","pcontent":"Page Content","dmenu":"Display it in menu","stats_line_d":"Statistics for the last 7 days","stats_line_m":"Statistics for this year","planalert":"The plans have been saved successfully."}}';

	$db->query("
	INSERT INTO `".prefix."languages` (`id`, `language`, `short`, `isdefault`, `created_at`, `updated_at`, `content`) VALUES
	(1, 'English', 'us', 1, 1634381925, 1634486191, '".addslashes($en)."');
	") or die( $db->error );


	$db->query("ALTER TABLE `".prefix."languages` ADD PRIMARY KEY (`id`);") or die( $db->error );
	$db->query("ALTER TABLE `".prefix."languages` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;") or die( $db->error );










	$db->query("SET collation_connection = 'utf8_general_ci';");
	$db->query("ALTER TABLE ".prefix."families CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci;");
	$db->query("ALTER TABLE ".prefix."users CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci;");
	$db->query("ALTER TABLE ".prefix."members CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci;");
	$db->query("ALTER TABLE ".prefix."configs CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci;");
	$db->query("ALTER TABLE ".prefix."pages CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci;");
	$db->query("ALTER TABLE ".prefix."plans CONVERT TO CHARACTER SET utf8 COLLATE utf8_general_ci;");






?>


<div class="install-box">
	<h1>Congratulations...</h1>
	<p>
		Congratulations Puerto Family Tree Script is installed successfully. if you have any problem or issue with the script or the instraction that I provide please contact me first ASAP in:

		</p>
		<ul>
			<li>my Email: <span class="p-h">el.bouirtou@gmail.com</span></li>
			<li>my Facebook account <span class="p-h"><a href="https://fb.com/prof.puertokhalid">fb.com/prof.puertokhalid</a></span></li>
			<li>on the Instagram <span class="p-h"><a href="https://instagram.com/khalidpuerto">instagram.com/khalidpuerto</a></span></li>
			<li>Codecanyon profile <span class="p-h"><a href="http://codecanyon.net/user/puertokhalid">codecanyon.net/user/puertokhalid</a></span></li>
		</ul>
		<p>
		 and I will back to you with all help you need.<br><br>
		<span class="red">Please do not forget to delete the installation file 'install.php'.</span><br>
		<a href="index.php" class="button">Go to index</a>
	</p>
</div>

<?php
rename (__DIR__."/install.php", __DIR__."/install@.php");
endif;
