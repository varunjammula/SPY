<?PHP
require_once("../../include/membersite_config.php");

$fgmembersite->LogOut();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Logout</title>
<link rel="STYLESHEET" type="text/css" href="../../style/fg_membersite.css" />
<script type='text/javascript' src='../../scripts/gen_validatorv31.js'></script>
<link rel="STYLESHEET" type="text/css" href="../../style/pwdwidget.css" />
<script src="../../scripts/pwdwidget.js" type="text/javascript"></script>      
</head>
<body>

<h2>You have logged out</h2>
<p>
<a href='../login/'>Login Again</a>
</p>

<?PHP
unset($_SESSION["name_of_user"]);
if (isset($_SERVER['HTTP_COOKIE'])) {
    $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
    foreach($cookies as $cookie) {
        $parts = explode('=', $cookie);
        $name = trim($parts[0]);
        setcookie($name, '', time()-10000);
        setcookie($name, '', time()-10000, '/');
    }
}
?>
</body>
</html>