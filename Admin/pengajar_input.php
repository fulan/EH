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
  $insertSQL = sprintf("INSERT INTO pengajar (id_pengajar, nomer_induk_pengajar, nama_pengajar, username, password, `level`, gender, agama, TTL, alamat, tlp, email, foto_pengajar) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id_pengajar'], "int"),
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
                       GetSQLValueString($_POST['foto_pengajar'], "text"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($insertSQL, $koneksi) or die(mysql_error());

  $insertGoTo = "pengajar.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}
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
<p>
<table width="300" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center"><b>Tambah Pengajar Baru</b> </td>
  </tr>
  <tr>
    <td>&nbsp;
      <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
        <table width="500" align="center">
          <tr valign="baseline">
            <td width="147" align="right" nowrap>Id_pengajar:</td>
            <td width="321"><input type="text" name="id_pengajar" value="" size="32"></td>
          </tr>
          <tr valign="baseline">
            <td nowrap align="right">Nomer_induk_pengajar:</td>
            <td><input type="text" name="nomer_induk_pengajar" value="" size="32"></td>
          </tr>
          <tr valign="baseline">
            <td nowrap align="right">Nama_pengajar:</td>
            <td><input type="text" name="nama_pengajar" value="" size="32"></td>
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
            <td nowrap align="right">Tlp:</td>
            <td><input type="text" name="tlp" value="" size="32"></td>
          </tr>
          <tr valign="baseline">
            <td nowrap align="right">Email:</td>
            <td><input type="text" name="email" value="" size="32"></td>
          </tr>
          <tr valign="baseline">
            <td nowrap align="right">Foto_pengajar:</td>
            <td><input type="text" name="foto_pengajar" value="" size="32"></td>
          </tr>
          <tr valign="baseline">
            <td nowrap align="right">&nbsp;</td>
            <td><input type="submit" value="Insert record"></td>
          </tr>
        </table>
        <input type="hidden" name="MM_insert" value="form1">
      </form>
    <p>&nbsp;</p></td>
  </tr>
</table>
</div>
<?php include "menu.php" ?>
</div>
<?php include "footer.php" ?>

</body>
</html>
