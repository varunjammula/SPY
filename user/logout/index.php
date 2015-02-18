<?PHP
require_once("../../include/membersite_config.php");

$fgmembersite->LogOut();
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

<h2>You have logged out</h2>
<p>
<a href='../login/'>Login Again</a>
</p>
<?
unset($_SESSION["name_of_user"]);
//unset($_SESSION["email_of_user"]);
//print_r($_SESSION);
/*foreach ($_COOKIE as $c_id => $c_value)
{
	//echo $c_id."-->".$c_value;
    setcookie($c_id, " ", time() - 3600);
}*/

if (isset($_SERVER['HTTP_COOKIE'])) {
    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
    foreach($cookies as $cookie) {
        $parts = explode('=', $cookie);
        $name = trim($parts[0]);
        setcookie($name, '', time()-10000);
        setcookie($name, '', time()-10000, '/');
    }
}
print_r($_COOKIE);

?>
</body>
</html>