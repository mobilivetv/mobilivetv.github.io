<?php
#Script By : Samnad Sainulabdeen
#Contact Me : www.facebook.com/S.SAMNAD
?>
<?php
session_start();
if($_SESSION['accesstoken'])
{
	$accesstoken = $_SESSION['accesstoken'];
	header("Location: menu.php?accesstoken=".$accesstoken."&session=true");
}
include 'header.php';
?>
<div class="post-single">
	<div class="post-meta"><a href="https://m.facebook.com/settings/subscribe/">NB : Before Using Change Your Follower Setting To PUBLIC</a> .</div>
    <div class="post-content" style="display: block !important;visibility: visible !important;">
    <a href="accesstoken.php"><b>Get Access Token </a></b><a href="m-apps.php">[ More Apps ]</a>
    <font color="#CC3300"><b>
	<?php
    $error = $_GET["error"];
	if($error)
	{
		echo '<hr/>'.$error;
	}
	?>
    </b></font>
    </div>
</div>
<div id="top-content">
	<div id="search-form">
    <?php
    if($set[site_status] == 'online')
	{
		echo '
    <form method="get" action="menu.php">
    <br/>
    <b>Access Token</b>
    <br/>
    <input class="inp-text" type="text" name="accesstoken" value="" required>
    <br/>
    <input style="margin-top: 3px;" class="inp-btn" type="submit" value="Log In">
    </form>';
	}
	else
	{
		echo '<a>Website Under Construction !<br/>Please Check After Few Minutes !</a>';
	}
	?>
    </div>
</div>
<br/>
<?php
include 'footer.php';
?>