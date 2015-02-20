<?php
require_once("../../include/membersite_config.php");
if(isset($_POST['submitted']))
{
}
else
{
if(isset($_COOKIE['uname']))
{
    $knock_sequence=$_COOKIE['uname']."_ks";
    $ctr=$_COOKIE['uname']."_ctr";
    $seq=$_COOKIE['uname']."_seq";
    $mode=$_COOKIE['uname']."_mode";

    $_COOKIE[$ctr]++;
    setcookie($ctr, $_COOKIE[$ctr], time() + (86400 * 30), "/");
    setcookie('path',$_SERVER['PHP_SELF'] , time() + (86400 * 30), "/");
    $_COOKIE[$seq]=$_COOKIE[$seq]."2";
    setcookie($seq,$_COOKIE[$seq] , time() + (86400 * 30), "/");

    if(strcmp(substr($_COOKIE[$seq],strlen($_COOKIE[$seq])-4),$_COOKIE[$knock_sequence])==0)
    {
        
        setcookie($mode,"private", time() + (86400 * 30), "/");
        
    }
}
}


if(!$fgmembersite->CheckLogin())
{
    $fgmembersite->RedirectToURL("../../user/login/");
    exit;
}
else
{
	if($fgmembersite->MessageCreate())
   {
  		$fgmembersite->RedirectToURL("../../message/list/");
   }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Add message</title>
<link rel="STYLESHEET" type="text/css" href="../../style/fg_membersite.css" />
<script type='text/javascript' src='../../scripts/gen_validatorv31.js'></script>
<link rel="STYLESHEET" type="text/css" href="../../style/pwdwidget.css" />
<script src="../../scripts/pwdwidget.js" type="text/javascript"></script>      
</head>
<body>

<div id='fg_membersite'>
<p><a href='../../user/logout/'>Logout</a></p>



<form id='create-message' name='create-message' action='<?PHP echo $fgmembersite->GetSelfScript(); ?>' method='post' >
<fieldset >
<legend>Create Message</legend>

<input type='hidden' name='submitted' id='submitted' value='1'/>

<div class='short_explanation'>* required fields</div>
<input type='text'  class='spmhidip' name='<?php echo $fgmembersite->GetSpamTrapInputName(); ?>' />

<div><span class='error'><?php echo $fgmembersite->GetErrorMessage(); ?></span></div>

<div class='container'>
    <label for='title' >Title*:</label><br>
    <input type='text' name='title' id='title' value='<?php echo $fgmembersite->SafeDisplay('title') ?>' maxlength="50" /><br>
     
</div>

<div class='container'>
    <label for='message' >Message*:</label><br>
    <textarea rows="4" cols="50" name='message' id='message'></textarea>
     
</div>

<div class='container'>
    <input type='submit' name='submit' value='Submit' />
</div>

</fieldset>
</form>
</div>
<script type="text/javascript">
var frmvalidator  = new Validator("create-message");
    frmvalidator.EnableOnPageErrorDisplay();
    frmvalidator.EnableMsgsTogether();

    frmvalidator.addValidation("title","req","Please provide a title");
    
    frmvalidator.addValidation("message","req","Please provide a message");    
</script>
</body>

</html>
