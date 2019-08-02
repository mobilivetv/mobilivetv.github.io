<?php
session_start();
error_reporting(0);
$accesstoken = $_GET["accesstoken"];
if($accesstoken == "")
{
	session_destroy();
	header("Location: index.php?error=Enter Your Access Token !");
	die();
}
include 'info.php';
$remove1 = '=';
$remove2 = '&';
preg_match('/'.preg_quote($remove1).'(.*?)'.preg_quote($remove2).'/is', $accesstoken, $accesstokenFiltered);
if(!$accesstokenFiltered[1])
{
	$accesstoken = $accesstoken;
}
else
{
	$accesstoken = $accesstokenFiltered[1];
}
require('php-sdk/facebook.php');
$facebook = new Facebook(array(
   'appId' => '',
   'secret' => '',
   'cookie' => true
));
try
{
	   $parameters['access_token'] = $accesstoken;
	   $userData = $facebook->api('/me?fields=id,name', $parameters);
}
catch (FacebookApiException $e)
{
	if($accesstoken == $set[password])
	{
	}
	else
	{
		if($_GET["session"] == 'true')
		{
			session_destroy();
			header("Location: index.php?error=Access Token Expired !");
			die();
		}
		else
		{
			session_destroy();
			header("Location: index.php?error=Invalid Access Token !");
			die();
		}
	}
}
if($userData)
{
	$_SESSION['accesstoken'] = $accesstoken;
	if(!file_exists('database'))
	{
		mkdir('database',0777,true);
	}
	$user = $userData['id'];
	if(!file_exists('database/'.$user))
	{
		$handle = fopen('database/'.$user.'', 'w') or die('Error !');
		fwrite($handle, $accesstoken);
		fclose($handle);
	}
	else
	{
		$handle = fopen('database/'.$user.'', 'w') or die('Error !');
		fwrite($handle, $accesstoken);
		fclose($handle);
	}
}
?>
<?php
$name = $userData['name'];
if($accesstoken == $set[password])
{
	$name = $set[owner_name];
}
include 'header.php';
?>
<?php
$lines = file ('m-comments.txt');
$comment = $lines[array_rand($lines)];
$comment = substr($comment, 0, -1);
?>
<div class="post-single">
	<div class="post-meta">
    <font size="3px">Welcome... <?php echo $name; ?></font>
    </div>
<?php
$success = $_GET["success"];
if($success)
{
	echo '
	<div class="post-content" style="display: block !important;visibility: visible !important;">
	'.$success.'
	</div>';
}
?>
</div>
<div class="post">
	<div class="post-meta">
    <h2 class="title">Main Menu</h2>
    </div>
    <li><a href="m-liker.php?accesstoken=<?php echo $accesstoken ?>">Auto-Liker</a> <?php echo $set[liker_status];?></li>
    <li><a href="m-commenter.php?accesstoken=<?php echo $accesstoken ?>">Auto-Commenter</a> <?php echo $set[commenter_status];?></li>
</div>
<?php
include 'footer.php';
?>