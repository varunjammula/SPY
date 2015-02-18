<?PHP
require_once("../../include/membersite_config.php");

if(isset($_COOKIE['uname']) && !isset($_POST['submitted']))
{
    $knock_sequence=$_COOKIE['uname']."_ks";
    $ctr=$_COOKIE['uname']."_ctr";
    $seq=$_COOKIE['uname']."_seq";
    if(strcmp($_COOKIE['path'],$_SERVER['PHP_SELF'])==0)
    {
        //$_COOKIE[$ctr]++;
    }
    elseif(strcmp($_COOKIE['path'],$_SERVER['PHP_SELF'])!=0)
    {
        
        $_COOKIE[$seq]=substr($_COOKIE[$seq], 0, -1);
        //$_COOKIE[$ctr]--;
        //setcookie($ctr, $_COOKIE[$ctr], time() + (86400 * 30), "/");
    
    }
    
    /*if(strcmp($_COOKIE[$seq],"")!=0 && $_COOKIE[$ctr]==0)
    {
        $_COOKIE[$ctr]=1;
        //setcookie($ctr, $_COOKIE[$ctr], time() + (86400 * 30), "/");
        echo "Yo!<br>";
    }*/
    echo "Counter value before is...".$_COOKIE[$ctr]."<br>";
    echo "Sequence value before is...".$_COOKIE[$seq]."<br>";
    
    $_COOKIE[$ctr]++;
    setcookie($ctr, $_COOKIE[$ctr], time() + (86400 * 30), "/");
    setcookie('path',$_SERVER['PHP_SELF'] , time() + (86400 * 30), "/");
    $_COOKIE[$seq]=$_COOKIE[$seq]."0";
    setcookie($seq,$_COOKIE[$seq] , time() + (86400 * 30), "/");
    if($_COOKIE[$ctr]==4 && strcmp($_COOKIE[$seq],$_COOKIE[$knock_sequence])==0)
    {

        setcookie('mode',"private", time() + (86400 * 30), "/");
        //echo $_COOKIE['mode']."<br>";
    }

    echo $_COOKIE[$ctr]."<br>";
    echo $_COOKIE[$seq];
}

if(isset($_POST['submitted']))
{
   if($fgmembersite->RegisterUser())
   {
        $fgmembersite->RedirectToURL("../../thank-you.html");
   }
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
    <meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
    <title>Register</title>
    <link rel="STYLESHEET" type="text/css" href="../../style/fg_membersite.css" />
    <script type='text/javascript' src='../../scripts/gen_validatorv31.js'></script>
    <link rel="STYLESHEET" type="text/css" href="../../style/pwdwidget.css" />
    <script src="../../scripts/pwdwidget.js" type="text/javascript"></script>      
</head>
<body>

<!-- Form Code Start -->
<div id='fg_membersite'>
<form id='register' action='<?php echo $fgmembersite->GetSelfScript(); ?>' method='post' accept-charset='UTF-8'>
<fieldset >
<legend>Register</legend>

<input type='hidden' name='submitted' id='submitted' value='1'/>

<div class='short_explanation'>* required fields</div>
<input type='text'  class='spmhidip' name='<?php echo $fgmembersite->GetSpamTrapInputName(); ?>' />

<div><span class='error'><?php echo $fgmembersite->GetErrorMessage(); ?></span></div>

<div class='container'>
    <label for='username' >UserName*:</label><br/>
    <input type='text' name='username' id='username' value='<?php echo $fgmembersite->SafeDisplay('username') ?>' maxlength="50" /><br/>
    <span id='register_username_errorloc' class='error'></span>
</div>
<div class='container' style='height:80px;'>
    <label for='password' >Password*:</label><br/>
    <div class='pwdwidgetdiv' id='thepwddiv' ></div>
    <noscript>
    <input type='password' name='password' id='password' maxlength="50" />
    </noscript>    
    <div id='register_password_errorloc' class='error' style='clear:both'></div>
</div>

<div class='container' style='height:80px;'>
    <label for='password' >Confirm-Password*:</label><br/>
    <div class='pwdwidgetdiv' id='thepwddiv_confirm' ></div>
    <noscript>
    <input type='password' name='password_confirm' id='password_confirm' maxlength="50" />
    </noscript>    
    <div id='register_password_errorloc' class='error' style='clear:both'></div>
</div>

<div class='container'>
    <input type='submit' name='Submit' value='Submit' />
</div>

</fieldset>
</form>
<!-- client-side Form Validations:
Uses the excellent form validation script from JavaScript-coder.com-->

<script type='text/javascript'>
// <![CDATA[
    var pwdwidget = new PasswordWidget('thepwddiv','password');
    pwdwidget.MakePWDWidget();
    
    var pwdwidget1 = new PasswordWidget('thepwddiv_confirm','password_confirm');
    pwdwidget1.MakePWDWidget();

    var frmvalidator  = new Validator("register");
    frmvalidator.EnableOnPageErrorDisplay();
    frmvalidator.EnableMsgsTogether();
    //frmvalidator.addValidation("name","req","Please provide your name");

    //frmvalidator.addValidation("email","req","Please provide your email address");

    //frmvalidator.addValidation("email","email","Please provide a valid email address");

    frmvalidator.addValidation("username","req","Please provide a username");
    
    frmvalidator.addValidation("password","req","Please provide a password");
    frmvalidator.addValidation("password1","req","Please provide a password");


    

// ]]>
</script>
<?
    print_r($_COOKIE);
?>

<!--
Form Code End (see html-form-guide.com for more info.)
-->

</body>
</html>