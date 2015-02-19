<?PHP
require_once("../../include/membersite_config.php");
if(isset($_POST['submitted']))
{
}
else{
if(isset($_COOKIE['uname']))
{
    $knock_sequence=$_COOKIE['uname']."_ks";
    $ctr=$_COOKIE['uname']."_ctr";
    $seq=$_COOKIE['uname']."_seq";
    if(strcmp($_COOKIE['path'],$_SERVER['PHP_SELF'])==0)
    {
        //echo "Same page!";
        //$_COOKIE[$ctr]++;
    }
    elseif(strcmp($_COOKIE['path'],$_SERVER['PHP_SELF'])!=0)
    {
        echo "redirected from another!";
        //$_COOKIE[$seq]=substr($_COOKIE[$seq], 0, -1);
        if($_COOKIE[$ctr]>0)
        {
            //$_COOKIE[$ctr]--;
        }
        //setcookie($ctr, $_COOKIE[$ctr], time() + (86400 * 30), "/");
    }
    

    echo "Counter value before is...".$_COOKIE[$ctr]."<br>";
    echo "Sequence value before is...".$_COOKIE[$seq]."<br>";
    
    $_COOKIE[$ctr]++;
    setcookie($ctr, $_COOKIE[$ctr], time() + (86400 * 30), "/");
    setcookie('path',$_SERVER['PHP_SELF'] , time() + (86400 * 30), "/");
    echo $_COOKIE[$ctr]."<br>";
    $_COOKIE[$seq]=$_COOKIE[$seq]."3";
    setcookie($seq,$_COOKIE[$seq] , time() + (86400 * 30), "/");

    if(strcmp(substr($_COOKIE[$seq],strlen($_COOKIE[$seq])-4),$_COOKIE[$knock_sequence])==0)
    {
        
        setcookie('mode',"private", time() + (86400 * 30), "/");
        //echo $_COOKIE['mode']."<br>";
    }
    echo $_COOKIE[$seq];
    //echo $_COOKIE['path'];
}
}
if(!$fgmembersite->CheckLogin())
{	
    $fgmembersite->RedirectToURL("../../user/login/");
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
      <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
      <title>Message List</title>
      <link rel="STYLESHEET" type="text/css" href="../../style/fg_membersite.css">
</head>
<body>
<div id='fg_membersite'>
<h2>Message List</h2>
Welcome back <?= $fgmembersite->UserFullName(); ?>!
<?
$text = '<p>Test paragraph.</varun><!-- Comment --> <a href="#fragment">Other text</a>';
echo strip_tags($text);
echo "\n";

// Allow <p> and <a>
echo strip_tags($text);
?>
<p><a href='../../user/logout/'>Logout</a></p>

<?
		$fgmembersite->ListDisplay();
		
	print_r($_COOKIE);
      
?>

</div>
</body>
</html>
