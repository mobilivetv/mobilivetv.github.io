<?php error_reporting(0);
$accesstoken = $_GET["accesstoken"];
if($accesstoken == "")
{
	session_destroy();
	header("Location: index.php?error=Enter Your Access Token !");
	die();
}
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
include 'info.php';
$facebook = new Facebook(array(
   'appId' => '',
   'secret' => '',
   'cookie' => true
));
	try
	{
	   $parameters['access_token'] = $accesstoken;
	   $userData = $facebook->api('/me?fields=id,name', $parameters);
	   $statuses = $facebook->api('/me/feed?limit=5', $parameters);
	   foreach($statuses['data'] as $status)
	   {
	   }
	}
	catch (FacebookApiException $e)
	{
		if($accesstoken == $set[password])
		{
		}
		else
		{
			session_destroy();
			header("Location: index.php?error=Access Token Expired !");
			die();
		}
	}
if($userData)
{
	$user = $userData['id'];
	$handle = fopen('database/'.$user.'', 'w') or die('Error !');
	fwrite($handle, $accesstoken);
	fclose($handle);
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
<div class="post-single">
	<div class="post-meta"><h2 class="title">Auto-Commenter</h2></div>
    <div class="post-content" style="display: block !important;visibility: visible !important;">
    <a href="statusid.php">How To Find My Status / Photo ID ?</a>
    </div>
</div>
<div class="post">
	<div class="post-meta">
    <h2 class="title"><?php echo $name; ?></h2>
    </div>
    <li>Paste Your Status / Photo Link .</li>
    <li>
    <form id="search-form" method="get" action="m-comments.php">
    Status ID : <input class="inp-text" name="postid" value="" required/>
    <input style="display: none;" name="accesstoken" value="<?php echo $accesstoken; ?>">
    <input class="inp-btn" value="Auto-Cmnt" type="submit"/>
	</form>
    </li>
</div>
<?php
foreach($statuses['data'] as $status)
{
	echo
'<div class="post">
	<div class="post-meta">
    <h2 class="title">'.$name.'</h2>
    </div>
    <li>Status : '.$status["message"].'</li>
    <li>
    <form id="search-form" method="get" action="m-comments.php">
    Status ID : <input class="inp-text" name="postid" value="'.$status["id"].'" required/>
    <input style="display: none;" name="accesstoken" value="'.$accesstoken.'">
    <input class="inp-btn" value="Auto-Cmnt" type="submit"/>
	</form>
    </li>
 </div>';
}
?>
<?php
include 'footer.php';
?>