<?PHP
require_once("../../include/membersite_config.php");

if(isset($_POST['submitted']))
{

   if($fgmembersite->Login())
   {

        $str=str_split(md5($_SESSION['name_of_user']));
        for($i=0;$i<4;$i++)
        {
            $str[$i]=hexdec($str[$i])%4;
        }
        $_SESSION["knock_sequence"]=$str[0].$str[1].$str[2].$str[3];
        if(!isset($_COOKIE['uname'])){
        setcookie('uname',$_SESSION["name_of_user"],time() + (86400 * 30), "/");}
        $knock_sequence=$_SESSION["name_of_user"]."_ks";
        $ctr=$_SESSION["name_of_user"]."_ctr";
        $seq=$_SESSION["name_of_user"]."_seq";
        if(!isset($_COOKIE[$ctr])){
        setcookie($ctr, 0, time() + (86400 * 30), "/");}
        if(!isset($_COOKIE[$knock_sequence])){
        setcookie($knock_sequence,$str[0].$str[1].$str[2].$str[3],time() + (86400 * 30), "/");}
        if(!isset($_COOKIE['path'])){
        setcookie('path'," ",time() + (86400 * 30), "/");}
        if(!isset($_COOKIE[$seq])){
        setcookie($seq," ",time() + (86400 * 30), "/");}
        if(!isset($_COOKIE['mode'])){
        setcookie('mode',"public",time() + (86400 * 30), "/");}
        $fgmembersite->RedirectToURL("login-home.php");
   }
}
else
{
if(isset($_COOKIE['uname']))
{
    $knock_sequence=$_COOKIE['uname']."_ks";
    $ctr=$_COOKIE['uname']."_ctr";
    $seq=$_COOKIE['uname']."_seq";
    
    $_COOKIE[$ctr]++;
    setcookie($ctr, $_COOKIE[$ctr], time() + (86400 * 30), "/");
    setcookie('path',$_SERVER['PHP_SELF'] , time() + (86400 * 30), "/");
    $_COOKIE[$seq]=$_COOKIE[$seq]."1";
    setcookie($seq,$_COOKIE[$seq] , time() + (86400 * 30), "/");
    if(strcmp(substr($_COOKIE[$seq],strlen($_COOKIE[$seq])-4),$_COOKIE[$knock_sequence])==0)
    {
        
        setcookie('mode',"private", time() + (86400 * 30), "/");
    }
    
}
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Register</title>
<link rel="STYLESHEET" type="text/css" href="../../style/fg_membersite.css" />
<script type='text/javascript' src='../../scripts/gen_validatorv31.js'></script>
<link rel="STYLESHEET" type="text/css" href="../../style/pwdwidget.css" />
<script src="../../scripts/pwdwidget.js" type="text/javascript"></script>      
</head>
<body>

<div id='fg_membersite'>
<form id='login' action='<?php echo $fgmembersite->GetSelfScript(); ?>' method='post' accept-charset='UTF-8'>
<fieldset >
<legend>Login</legend>

<input type='hidden' name='submitted' id='submitted' value='1'/>

<div class='short_explanation'>* required fields</div>

<div><span class='error'><?php echo $fgmembersite->GetErrorMessage(); ?></span></div>
<div class='container'>
    <label for='username' >UserName*:</label><br/>
    <input type='text' name='username' id='username' value='<?php echo $fgmembersite->SafeDisplay('username') ?>' maxlength="50" /><br/>
    <span id='login_username_errorloc' class='error'></span>
</div>
<div class='container'>
    <label for='password' >Password*:</label><br/>
    <input type='password' name='password' id='password' maxlength="50" /><br/>
    <span id='login_password_errorloc' class='error'></span>
</div>

<div class='container'>
    <input type='submit' name='Submit' value='Submit' />
</div>
<div class='short_explanation'><a href='reset-pwd-req.php'>Forgot Password?</a></div>
</fieldset>
</form>
</div>
<script type='text/javascript'>
    var frmvalidator  = new Validator("login");
    frmvalidator.EnableOnPageErrorDisplay();
    frmvalidator.EnableMsgsTogether();

    frmvalidator.addValidation("username","req","Please provide your username");
    
    frmvalidator.addValidation("password","req","Please provide the password");
</script>

</body>
</html>