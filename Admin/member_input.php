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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO member (id_member, Nomer_induk_member, nama_member, username, password, `level`, gender, agama, TTL, alamat, TLP, email, foto_member) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id_member'], "int"),
                       GetSQLValueString($_POST['Nomer_induk_member'], "text"),
                       GetSQLValueString($_POST['nama_member'], "int"),
                       GetSQLValueString($_POST['username'], "text"),
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['level'], "text"),
                       GetSQLValueString($_POST['gender'], "text"),
                       GetSQLValueString($_POST['agama'], "int"),
                       GetSQLValueString($_POST['TTL'], "date"),
                       GetSQLValueString($_POST['alamat'], "int"),
                       GetSQLValueString($_POST['TLP'], "int"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['foto_member'], "text"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($insertSQL, $koneksi) or die(mysql_error());

  $insertGoTo = "member.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_koneksi, $koneksi);
$query_member_input = "SELECT * FROM member";
$member_input = mysql_query($query_member_input, $koneksi) or die(mysql_error());
$row_member_input = mysql_fetch_assoc($member_input);
$totalRows_member_input = mysql_num_rows($member_input);
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
<p align="center"><b> Halaman Edit Member</b></p>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table align="left">
    
    <tr valign="baseline">
      <td nowrap align="right">Nomer_induk_member:</td>
      <td><input type="text" name="Nomer_induk_member" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Nama_member:</td>
      <td><input type="text" name="nama_member" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Username:</td>
      <td><input type="text" name="username" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Password:</td>
      <td><input type="text" name="password" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Level:</td>
      <td><input type="text" name="level" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Gender:</td>
      <td><input type="text" name="gender" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Agama:</td>
      <td><input type="text" name="agama" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">TTL:</td>
      <td><input type="text" name="TTL" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Alamat:</td>
      <td><input type="text" name="alamat" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">TLP:</td>
      <td><input type="text" name="TLP" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Email:</td>
      <td><input type="text" name="email" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Foto_member:</td>
      <td><input type="text" name="foto_member" value="" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Insert record"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1">
</form>
<p>&nbsp;</p>
</div>
<?php include "menu.php" ?>
</div>
<?php include "footer.php" ?>
</body>
</html>
<?php
mysql_free_result($member_input);
?>

