﻿<?php
include 'header.php';
include 'info.php';
?>
<div class="post">
	<div class="post-meta">
    <h2 class="title">Refreshing Access Tokens...</h2>
    </div>
<?php error_reporting(0);
require('php-sdk/facebook.php');
$facebook = new Facebook(array(
   'appId' => '',
   'secret' => '',
   'cookie' => true
));
$empty = '0';
if($handle = opendir('database'))
{
	while (false !== ($entry = readdir($handle)))
	{
		if($entry != "." && $entry != "..")
		{
			$user = fopen('database/'.$entry.'',"r") or die('Error !');
			$accesstoken = fgets($user);
			$facebook->setAccessToken ($accesstoken);
			try
			{
				$parameters['access_token'] = $accesstoken;
				$userData = $facebook->api('/me?fields=id', $parameters);
			}
			catch (FacebookApiException $e)
			{
				if($entry == 'index.php')
				{
				}
				else
				{
					$empty = '1';
					echo '<li><a target="_top" href="https://m.facebook.com/'.$entry.'"><font color="red">'.$entry.'</font><a/></li>';
					fclose($user);
					unlink('database/'.$entry.'');
				}
			}
			if($userData['id'] == $entry)
			{
				$empty = '1';
				echo '<li><a target="_top" href="https://m.facebook.com/'.$userData['id'].'"><font color="green">'.$userData['id'].'</font><a/></li>';
			}
			$userData['name'] = false;
		}
	}
	closedir($handle);
	if($empty == '0')
	{
		echo '<li>Empty Database !</li>';
	}
}
?>
</div>
<?php
include 'footer.php';
?>