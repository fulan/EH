<?php require_once('../Connections/koneksi.php'); ?>
<?php
mysql_select_db($database_koneksi, $koneksi);
$query_admin_login = "SELECT * FROM `admin`";
$admin_login = mysql_query($query_admin_login, $koneksi) or die(mysql_error());
$row_admin_login = mysql_fetch_assoc($admin_login);
$totalRows_admin_login = mysql_num_rows($admin_login);
?><?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['nama'])) {
  $loginUsername=$_POST['nama'];
  $password=$_POST['paswword'];
  $MM_fldUserAuthorization = "level";
  $MM_redirectLoginSuccess = "home.php";
  $MM_redirectLoginFailed = "adminlogin.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_koneksi, $koneksi);
  	
  $LoginRS__query=sprintf("SELECT username, password, level FROM admin WHERE username='%s' AND password='%s'",
  get_magic_quotes_gpc() ? $loginUsername : addslashes($loginUsername), get_magic_quotes_gpc() ? $password : addslashes($password)); 
   
  $LoginRS = mysql_query($LoginRS__query, $koneksi) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
    
    $loginStrGroup  = mysql_result($LoginRS,0,'level');
    
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<form id="form1" name="form1" method="POST" action="<?php echo $loginFormAction; ?>">
<table width="300" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td>Username</td>
    <td>:</td>
    <td><input type="text" name="nama" id="nama" /></td>
  </tr>
  <tr>
    <td>Password</td>
    <td>:</td>
    <td><input type="text" name="paswword" id="paswword" /></td>
  </tr>
  <tr>
    <td colspan="3"><label>
      <input type="submit" name="Submit" value="Submit" />
    </label></td>
    </tr>
</table>

 
<label></label>
</form>
</body>
</html>
<?php
mysql_free_result($admin_login);
?>
