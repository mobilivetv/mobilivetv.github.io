<?php error_reporting(0);
require ('info.php');
$adminpassword = $set[password];
$checkpassword = $_GET['password'];
/************* SAVE NEW DATA *********************/
if(($_GET['save'] == yes) && ($checkpassword == $adminpassword))
{
	if(($_POST['password'] == "") ||
	($_POST['site_status'] == "") ||
	($_POST['owner_name'] == "") ||
	($_POST['owner_profile_id'] == "") ||
	($_POST['page_title'] == "") ||
	($_POST['main_heading'] == "") ||
	($_POST['sub_heading'] == "") ||
	($_POST['icon_link'] == "") ||
	($_POST['token_link'] == "") ||
	($_POST['developer_heading'] == "") ||
	($_POST['liker_status'] == "") ||
	($_POST['commenter_status'] == "") ||
	($_POST['groups_heading'] == "") ||
	($_POST['group_1_id'] == "") ||
	($_POST['group_1_name'] == "") ||
	($_POST['group_2_id'] == "") ||
	($_POST['group_2_name'] == "") ||
	($_POST['pages_heading'] == "") ||
	($_POST['page_1_id'] == "") ||
	($_POST['page_1_name'] == "") ||
	($_POST['page_2_id'] == "") ||
	($_POST['page_2_name'] == ""))
	{
		header("Location: admin.php?password=".$checkpassword."&message=<font color=red>Error Found !</font>");
		die();
	}
	$file = 'info.php';
	$buka = fopen($file, 'w');
	$newdata=
	'<?php
$set[password]='.'"'."$_REQUEST[password]".'";
$set[site_status]='.'"'."$_REQUEST[site_status]".'";
$set[owner_name]='.'"'."$_REQUEST[owner_name]".'";
$set[owner_profile_id]='.'"'."$_REQUEST[owner_profile_id]".'";
$set[page_title]='.'"'."$_REQUEST[page_title]".'";
$set[main_heading]='.'"'."$_REQUEST[main_heading]".'";
$set[sub_heading]='.'"'."$_REQUEST[sub_heading]".'";
$set[icon_link]='.'"'."$_REQUEST[icon_link]".'";
$set[token_link]='.'"'."$_REQUEST[token_link]".'";
$set[developer_heading]='.'"'."$_REQUEST[developer_heading]".'";
$set[author]=$set[site_status];
$set[liker_status]='.'"'."$_REQUEST[liker_status]".'";
$set[commenter_status]='.'"'."$_REQUEST[commenter_status]".'";
$set[groups_heading]='.'"'."$_REQUEST[groups_heading]".'";
$set[group_1_id]='.'"'."$_REQUEST[group_1_id]".'";
$set[group_1_name]='.'"'."$_REQUEST[group_1_name]".'";
$set[group_2_id]='.'"'."$_REQUEST[group_2_id]".'";
$set[group_2_name]='.'"'."$_REQUEST[group_2_name]".'";
$set[pages_heading]='.'"'."$_REQUEST[pages_heading]".'";
$set[page_1_id]='.'"'."$_REQUEST[page_1_id]".'";
$set[page_1_name]='.'"'."$_REQUEST[page_1_name]".'";
$set[page_2_id]='.'"'."$_REQUEST[page_2_id]".'";
$set[page_2_name]='.'"'."$_REQUEST[page_2_name]".'";
?>';
	fwrite($buka, $newdata);
	fclose($buka);
	require ('info.php');
	$adminpassword = $set[password];
	header("Location: admin.php?password=".$set[password]."&message=<font color=white>Information Updated !</font>");
}
/************* EMPTY PASSWORD *********************/
if(empty($checkpassword))
{
	include 'header.php';
	echo
	'
	<div class="post">
			<div class="post-meta">
			<h2 class="title">Administrator Menu</h2>
			</div>
			<li style="background-color:#333; color: #FFF;">
			This Page Is Reserved For Admins Only !
			</li>
	</div>
	<div id="top-content">
		<div id="search-form">
    	<form method="get" action="admin.php">
    	<br/>
		Password
    	<br/>
    	<input class="inp-text" type="text" name="password" value="" required>
		<br/>
    	<input style="margin-top: 3px;" class="inp-btn" type="submit" value="Log In">
    	</form>
    	</div>
	</div>
	<br/>
';
}
/************* CHECK PASSWORD *********************/
else
{
	if ($adminpassword == $checkpassword)
	{
		include 'header.php';
		echo
		'
		<div class="post">
			<div class="post-meta">
			<h2 class="title">Administrator Menu</h2>
			</div>';
			if($_GET['message'])
			{
				echo'<li style="background-color:#333; color: #FFF;">'.$_GET['message'].'</li>';
			}
			echo'
			<li><a href="m-refresh.php">Refresh Access Tokens !</a></li>
			<form id="search-form" action="admin.php?save=yes&password='.$checkpassword.'" method="post">
			<center>
			<li>
			Password<br/><input type="text" class="inp-text" name="password" size="12" value="'.$set[password].'">
			</li>
			<li>
			Website Status<br/>
			<select name="site_status" class="drop-down">
			<option value="'.$set[site_status].'">Current Status : '.$set[site_status].'</option>
			<option value="online">Online</option>
			<option value="offline">Offline</option>
			</select>
			</li>
			<li>
			Owner Name<br/><input type="text" class="inp-text" name="owner_name" size="12" value="'.$set[owner_name].'">
			</li>
			<li>
			Owner Profile ID<br/><input type="text" class="inp-text" name="owner_profile_id" size="12" value="'.$set[owner_profile_id].'">
			</li>
			<li>
			Page Title<br/><input type="text" class="inp-text" name="page_title" size="12" value="'.$set[page_title].'">
			</li>
			<li>
			Main Heading<br/><input type="text" class="inp-text" name="main_heading" size="12" value="'.$set[main_heading].'">
			</li>
			<li>
			Sub Heading<br/><input type="text" class="inp-text" name="sub_heading" size="12" value="'.$set[sub_heading].'">
			</li>
			<li>
			Favicon Link<br/><input type="text" class="inp-text" name="icon_link" size="12" value="'.$set[icon_link].'">
			</li>
			<li>
			Token Link<br/><input type="text" class="inp-text" name="token_link" size="12" value="'.$set[token_link].'">
			</li>
			<li>
			Devolopers Heading<br/><input type="text" class="inp-text" name="developer_heading" size="12" value="'.$set[developer_heading].'">
			</li>
			<li>
			Auto-Liker Status<br/>
			<select name="liker_status" class="drop-down">
			<option value="'.$set[liker_status].'">Current Status : '.$set[liker_status].'</option>
			<option value="[ Active ]">[ Active ]</option>
			<option value="[ Not Active ]">[ Not Active ]</option>
			</select>
			</li>
			<li>
			Auto-Commenter Status<br/>
			<select name="commenter_status" class="drop-down">
			<option value="'.$set[commenter_status].'">Current Status : '.$set[commenter_status].'</option>
			<option value="[ Active ]">[ Active ]</option>
			<option value="[ Not Active ]">[ Not Active ]</option>
			</select>
			</li>
			<li>
			Groups Heading<br/><input type="text" class="inp-text" name="groups_heading" size="12" value="'.$set[groups_heading].'">
			</li>
			<li>
			Group 1 ID<br/><input type="text" class="inp-text" name="group_1_id" size="12" value="'.$set[group_1_id].'">
			</li>
			<li>
			Group 1 Name<br/><input type="text" class="inp-text" name="group_1_name" size="12" value="'.$set[group_1_name].'">
			</li>
			<li>
			Group 2 ID<br/><input type="text" class="inp-text" name="group_2_id" size="12" value="'.$set[group_2_id].'">
			</li>
			<li>
			Group 2 Name<br/><input type="text" class="inp-text" name="group_2_name" size="12" value="'.$set[group_2_name].'">
			</li>
			<li>
			Pages Heading<br/><input type="text" class="inp-text" name="pages_heading" size="12" value="'.$set[pages_heading].'">
			</li>
			<li>
			Page 1 ID<br/><input type="text" class="inp-text" name="page_1_id" size="12" value="'.$set[page_1_id].'">
			</li>
			<li>
			Page 1 Name<br/><input type="text" class="inp-text" name="page_1_name" size="12" value="'.$set[page_1_name].'">
			</li>
			<li>
			Page 2 ID<br/><input type="text" class="inp-text" name="page_2_id" size="12" value="'.$set[page_2_id].'">
			</li>
			<li>
			Page 2 Name<br/><input type="text" class="inp-text" name="page_2_name" size="12" value="'.$set[page_2_name].'">
			</li>
			<li>
			<center>
			<input style="width: auto;" type="submit" value="Update">
			</center>
			</li>
			</form>
		</div>
		<br/>
		';
	}
	else
	{
		include 'header.php';
		echo
		'
		<div class="post">
			<div class="post-meta">
			<h2 class="title">Administrator Menu</h2>
			</div>
			<li style="background-color:#333; color: #FFF;">
			This Page Is Reserved For Admins Only !
			</li>
			<li style="background-color:#333; color: #FFF;">
			Incorrect Password !
			</li>
		</div>
		<div id="top-content">
			<div id="search-form">
			<form method="get" action="admin.php">
			<br/>
			Password
			<br/>
			<input class="inp-text" type="text" name="password" value="" required>
			<br/>
			<input style="margin-top: 3px;" class="inp-btn" type="submit" value="Log In">
			</form>
			</div>
		</div>
		<br/>
		';
	}
}
?>
<?php
include 'footer.php';
?>