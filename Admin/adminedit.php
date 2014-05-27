<?php require_once('../Connections/koneksi.php'); ?>
<?php
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE admin SET nama_admin=%s, username=%s, password=%s, `level`=%s, gender=%s, agama=%s, TTL=%s, alamat=%s, tlp=%s, email=%s, foto_admin=%s WHERE id_admin=%s",
                       GetSQLValueString($_POST['nama_admin'], "text"),
                       GetSQLValueString($_POST['username'], "text"),
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['level'], "text"),
                       GetSQLValueString($_POST['gender'], "text"),
                       GetSQLValueString($_POST['agama'], "text"),
                       GetSQLValueString($_POST['TTL'], "date"),
                       GetSQLValueString($_POST['alamat'], "text"),
                       GetSQLValueString($_POST['tlp'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['foto_admin'], "text"),
                       GetSQLValueString($_POST['id_admin'], "int"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($updateSQL, $koneksi) or die(mysql_error());

  $updateGoTo = "admin.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_edit_admin = "-1";
if (isset($_GET['idadmin'])) {
  $colname_edit_admin = (get_magic_quotes_gpc()) ? $_GET['idadmin'] : addslashes($_GET['idadmin']);
}
mysql_select_db($database_koneksi, $koneksi);
$query_edit_admin = sprintf("SELECT * FROM `admin` WHERE id_admin = %s", $colname_edit_admin);
$edit_admin = mysql_query($query_edit_admin, $koneksi) or die(mysql_error());
$row_edit_admin = mysql_fetch_assoc($edit_admin);
$totalRows_edit_admin = mysql_num_rows($edit_admin);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php include "header.php"?>
<div id="content-wrapper">
<div id="content">
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table align="center">
    <tr valign="baseline">
      <td nowrap align="right">Id_admin:</td>
      <td><?php echo $row_edit_admin['id_admin']; ?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Nama_admin:</td>
      <td><input type="text" name="nama_admin" value="<?php echo $row_edit_admin['nama_admin']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Username:</td>
      <td><input type="text" name="username" value="<?php echo $row_edit_admin['username']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Password:</td>
      <td><input type="text" name="password" value="<?php echo $row_edit_admin['password']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Level:</td>
      <td><input type="text" name="level" value="<?php echo $row_edit_admin['level']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Gender:</td>
      <td><input type="text" name="gender" value="<?php echo $row_edit_admin['gender']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Agama:</td>
      <td><input type="text" name="agama" value="<?php echo $row_edit_admin['agama']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">TTL:</td>
      <td><input type="text" name="TTL" value="<?php echo $row_edit_admin['TTL']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Alamat:</td>
      <td><input type="text" name="alamat" value="<?php echo $row_edit_admin['alamat']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Tlp:</td>
      <td><input type="text" name="tlp" value="<?php echo $row_edit_admin['tlp']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Email:</td>
      <td><input type="text" name="email" value="<?php echo $row_edit_admin['email']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Foto_admin:</td>
      <td><input type="file" name="foto_admin" value="<?php echo $row_edit_admin['foto_admin']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Update record"></td>
    </tr>
  </table>
  
  <input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="id_admin" value="<?php echo $row_edit_admin['id_admin']; ?>">
</form>
<p>&nbsp;</p>
</div>
<?php include "menu.php" ?>
</div>
<?php include "footer.php" ?>
</body>
</html>
<?php
mysql_free_result($edit_admin);
?>
