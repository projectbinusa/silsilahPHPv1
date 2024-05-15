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
<title>Puerto Update</title>
<style>
	body { background: #F7F7F7; }
	.install-box { width:450px;margin:20px auto 0 auto;background: #FFF;font-family:tahoma;font-size:14px;box-shadow:0 0 5px #CCC; }
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
	<form method="post" action="update.php?step=1">

	<h1>Welcome to Puerto Family Tree</h1>
	<p>This action is for updating the script to latest version</p>
	<p>
		<b>Please notice that:</b>
	</p>
	<ul style="margin-bottom: 0">
		<li>If you are already have install the v1 of the script make sure to backup your data first.</li>
		<li>You don't need to install the script again if you already did that in v1.</li>
		<li>If you just purchase the script you don't need to update it.</li>
	</ul>
	<p>
	f you have any problem or issue with the script or the instraction that I provide please contact me first ASAP in:
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
	<button type="submit" class="button">Update Puerto Script</button>
	</p>
		</form>
</div>





<?php

else:


// $db->query("ALTER TABLE `".prefix."members` CHANGE `birthdate` `birthdate` BIGINT NULL DEFAULT '0';") or die( $db->error );
// $db->query("ALTER TABLE `".prefix."members` CHANGE `mariagedate` `mariagedate` BIGINT NULL DEFAULT '0';") or die( $db->error );
// $db->query("ALTER TABLE `".prefix."members` CHANGE `deathdate` `deathdate` BIGINT NULL DEFAULT '0';") or die( $db->error );



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



?>


<div class="install-box">
	<h1>Congratulations...</h1>
	<p>
		Congratulations Puerto Family Tree Script is updated successfully. if you have any problem or issue with the script or the instraction that I provide please contact me first ASAP in:

		</p>
		<ul>
			<li>my Email: <span class="p-h">el.bouirtou@gmail.com</span></li>
			<li>my Facebook account <span class="p-h"><a href="https://fb.com/prof.puertokhalid">fb.com/prof.puertokhalid</a></span></li>
			<li>on the Instagram <span class="p-h"><a href="https://instagram.com/khalidpuerto">instagram.com/khalidpuerto</a></span></li>
			<li>Codecanyon profile <span class="p-h"><a href="http://codecanyon.net/user/puertokhalid">codecanyon.net/user/puertokhalid</a></span></li>
		</ul>
		<p>
		 and I will back to you with all help you need.<br><br>
		<span class="red">Please do not forget to delete the update file 'update.php'.</span><br>
		<a href="index.php" class="button">Go to index</a>
	</p>
</div>

<?php
endif;
