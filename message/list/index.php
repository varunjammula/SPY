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
    
    $_COOKIE[$ctr]++;
    setcookie($ctr, $_COOKIE[$ctr], time() + (86400 * 30), "/");
    setcookie('path',$_SERVER['PHP_SELF'] , time() + (86400 * 30), "/");
    $_COOKIE[$seq]=$_COOKIE[$seq]."3";
    setcookie($seq,$_COOKIE[$seq] , time() + (86400 * 30), "/");

    if(strcmp(substr($_COOKIE[$seq],strlen($_COOKIE[$seq])-4),$_COOKIE[$knock_sequence])==0)
    {
        
        setcookie('mode',"private", time() + (86400 * 30), "/");
    }
}
}
if(!$fgmembersite->CheckLogin())
{	
    $fgmembersite->RedirectToURL("../../user/login/");
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>List</title>
<link rel="STYLESHEET" type="text/css" href="../../style/fg_membersite.css" />
<script type='text/javascript' src='../../scripts/gen_validatorv31.js'></script>
<link rel="STYLESHEET" type="text/css" href="../../style/pwdwidget.css" />
<script src="../../scripts/pwdwidget.js" type="text/javascript"></script>      
</head>
<body>
<div id='fg_membersite'>
<h2>Message List</h2>
Welcome back <?= $fgmembersite->UserFullName(); ?>!
<?
$text = '<p>Test paragraph.</varun><!-- Comment --> <a href="#fragment">Other text</a>';
echo strip_tags($text);
echo "\n";

echo strip_tags($text);
?>
<p><a href='../../user/logout/'>Logout</a></p>

<?PHP
$fgmembersite->ListDisplay();
?>

</div>
</body>
</html>
