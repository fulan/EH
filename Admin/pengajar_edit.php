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
  $updateSQL = sprintf("UPDATE pengajar SET nomer_induk_pengajar=%s, nama_pengajar=%s, username=%s, password=%s, `level`=%s, gender=%s, agama=%s, TTL=%s, alamat=%s, tlp=%s, email=%s, foto_pengajar=%s WHERE id_pengajar=%s",
                       GetSQLValueString($_POST['nomer_induk_pengajar'], "text"),
                       GetSQLValueString($_POST['nama_pengajar'], "text"),
                       GetSQLValueString($_POST['username'], "text"),
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['level'], "text"),
                       GetSQLValueString($_POST['gender'], "text"),
                       GetSQLValueString($_POST['agama'], "text"),
                       GetSQLValueString($_POST['TTL'], "date"),
                       GetSQLValueString($_POST['alamat'], "text"),
                       GetSQLValueString($_POST['tlp'], "text"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['foto_pengajar'], "text"),
                       GetSQLValueString($_POST['id_pengajar'], "int"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($updateSQL, $koneksi) or die(mysql_error());

  $updateGoTo = "pengajar.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

mysql_select_db($database_koneksi, $koneksi);
$query_pengajar_edit = "SELECT * FROM pengajar";
$pengajar_edit = mysql_query($query_pengajar_edit, $koneksi) or die(mysql_error());
$row_pengajar_edit = mysql_fetch_assoc($pengajar_edit);
$totalRows_pengajar_edit = mysql_num_rows($pengajar_edit);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php include "header.php" ?>
<div id="content-wrapper">
<div id="content">
<p align="center"> <b>Halaman Edit Pengajar</b> </p>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table align="left">
    <tr valign="baseline">
      <td nowrap align="right">Id_pengajar:</td>
      <td><?php echo $row_pengajar_edit['id_pengajar']; ?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Nomer_induk_pengajar:</td>
      <td><input type="text" name="nomer_induk_pengajar" value="<?php echo $row_pengajar_edit['nomer_induk_pengajar']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Nama_pengajar:</td>
      <td><input type="text" name="nama_pengajar" value="<?php echo $row_pengajar_edit['nama_pengajar']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Username:</td>
      <td><input type="text" name="username" value="<?php echo $row_pengajar_edit['username']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Password:</td>
      <td><input type="text" name="password" value="<?php echo $row_pengajar_edit['password']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Level:</td>
      <td><input type="text" name="level" value="<?php echo $row_pengajar_edit['level']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Gender:</td>
      <td><input type="text" name="gender" value="<?php echo $row_pengajar_edit['gender']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Agama:</td>
      <td><input type="text" name="agama" value="<?php echo $row_pengajar_edit['agama']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">TTL:</td>
      <td><input type="text" name="TTL" value="<?php echo $row_pengajar_edit['TTL']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Alamat:</td>
      <td><input type="text" name="alamat" value="<?php echo $row_pengajar_edit['alamat']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Tlp:</td>
      <td><input type="text" name="tlp" value="<?php echo $row_pengajar_edit['tlp']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Email:</td>
      <td><input type="text" name="email" value="<?php echo $row_pengajar_edit['email']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Foto_pengajar:</td>
      <td><input type="text" name="foto_pengajar" value="<?php echo $row_pengajar_edit['foto_pengajar']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Update record"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="id_pengajar" value="<?php echo $row_pengajar_edit['id_pengajar']; ?>">
</form>
</div>
<?php include "menu.php"?>
</div>
<?php include "footer.php"?>
<p>&nbsp;</p>
</body>
</html>
<?php
mysql_free_result($pengajar_edit);
?>
