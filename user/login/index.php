<?PHP
require_once("../../include/membersite_config.php");
if(isset($_COOKIE['uname']) && !isset($_POST['submitted']))
{
    $knock_sequence=$_COOKIE['uname']."_ks";
    $ctr=$_COOKIE['uname']."_ctr";
    $seq=$_COOKIE['uname']."_seq";
    if(strcmp($_COOKIE['path'],$_SERVER['PHP_SELF'])==0 && $_COOKIE[$ctr]==0)
    {
        //echo "Same page!";
        //$_COOKIE[$ctr]++;
        echo "Just logged in !<br>";
    }
    elseif(strcmp($_COOKIE['path'],$_SERVER['PHP_SELF'])!=0)
    {
        //echo "redirected from another!";
        $_COOKIE[$seq]=substr($_COOKIE[$seq], 0, -1);
    }
    echo "Counter value before is...".$_COOKIE[$ctr]."<br>";
    echo "Sequence value before is...".$_COOKIE[$seq]."<br>";
    $_COOKIE[$ctr]++;
    setcookie($ctr, $_COOKIE[$ctr], time() + (86400 * 30), "/");
    setcookie('path',$_SERVER['PHP_SELF'] , time() + (86400 * 30), "/");
    echo $_COOKIE[$ctr]."<br>";
    $_COOKIE[$seq]=$_COOKIE[$seq]."1";

    if($_COOKIE[$ctr]==1 && strcmp($_COOKIE[$seq],NULL)==0)
    {
        //$_COOKIE[$seq]=substr($_COOKIE[$seq], 0, -1);
        echo "This is it !<br>";
    } 
    setcookie($seq,$_COOKIE[$seq] , time() + (86400 * 30), "/");
    if($_COOKIE[$ctr]==4 && strcmp($_COOKIE[$seq],$_COOKIE[$knock_sequence])==0)
    {
        
        setcookie('mode',"private", time() + (86400 * 30), "/");
        //echo $_COOKIE['mode']."<br>";
    }
    echo $_COOKIE[$seq];
    
}
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
        setcookie('path',$_SERVER['PHP_SELF'],time() + (86400 * 30), "/");}
        if(!isset($_COOKIE[$seq])){
        setcookie($seq,NULL,time() + (86400 * 30), "/");}
        if(!isset($_COOKIE['mode'])){
        setcookie('mode',"public",time() + (86400 * 30), "/");}
        $fgmembersite->RedirectToURL("login-home.php");
   }
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
      <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
      <title>Login</title>
      <link rel="STYLESHEET" type="text/css" href="../../style/fg_membersite.css" />
      <script type='text/javascript' src='../../scripts/gen_validatorv31.js'></script>
</head>
<body>

<!-- Form Code Start -->
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
<!-- client-side Form Validations:
Uses the excellent form validation script from JavaScript-coder.com-->

<script type='text/javascript'>
// <![CDATA[

    var frmvalidator  = new Validator("login");
    frmvalidator.EnableOnPageErrorDisplay();
    frmvalidator.EnableMsgsTogether();

    frmvalidator.addValidation("username","req","Please provide your username");
    
    frmvalidator.addValidation("password","req","Please provide the password");

// ]]>
</script>
</div>
<!--
Form Code End (see html-form-guide.com for more info.)
-->
<?
  print_r($_COOKIE);
?>
</body>
</html>