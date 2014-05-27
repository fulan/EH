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
  $updateSQL = sprintf("UPDATE member SET Nomer_induk_member=%s, nama_member=%s, username=%s, password=%s, `level`=%s, gender=%s, agama=%s, TTL=%s, alamat=%s, TLP=%s, email=%s, foto_member=%s WHERE id_member=%s",
                       GetSQLValueString($_POST['Nomer_induk_member'], "text"),
                       GetSQLValueString($_POST['nama_member'], "text"),
                       GetSQLValueString($_POST['username'], "text"),
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['level'], "text"),
                       GetSQLValueString($_POST['gender'], "text"),
                       GetSQLValueString($_POST['agama'], "int"),
                       GetSQLValueString($_POST['TTL'], "date"),
                       GetSQLValueString($_POST['alamat'], "int"),
                       GetSQLValueString($_POST['TLP'], "int"),
                       GetSQLValueString($_POST['email'], "text"),
                       GetSQLValueString($_POST['foto_member'], "text"),
                       GetSQLValueString($_POST['id_member'], "int"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($updateSQL, $koneksi) or die(mysql_error());

  $updateGoTo = "member.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

mysql_select_db($database_koneksi, $koneksi);
$query_member_edit = "SELECT * FROM member";
$member_edit = mysql_query($query_member_edit, $koneksi) or die(mysql_error());
$row_member_edit = mysql_fetch_assoc($member_edit);
$totalRows_member_edit = mysql_num_rows($member_edit);
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
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table align="center">
    <tr valign="baseline">
      <td nowrap align="right">Id_member:</td>
      <td><?php echo $row_member_edit['id_member']; ?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Nomer_induk_member:</td>
      <td><input type="text" name="Nomer_induk_member" value="<?php echo $row_member_edit['Nomer_induk_member']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Nama_member:</td>
      <td><input type="text" name="nama_member" value="<?php echo $row_member_edit['nama_member']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Username:</td>
      <td><input type="text" name="username" value="<?php echo $row_member_edit['username']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Password:</td>
      <td><input type="text" name="password" value="<?php echo $row_member_edit['password']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Level:</td>
      <td><input type="text" name="level" value="<?php echo $row_member_edit['level']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Gender:</td>
      <td><input type="text" name="gender" value="<?php echo $row_member_edit['gender']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Agama:</td>
      <td><input type="text" name="agama" value="<?php echo $row_member_edit['agama']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">TTL:</td>
      <td><input type="text" name="TTL" value="<?php echo $row_member_edit['TTL']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Alamat:</td>
      <td><input type="text" name="alamat" value="<?php echo $row_member_edit['alamat']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">TLP:</td>
      <td><input type="text" name="TLP" value="<?php echo $row_member_edit['TLP']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Email:</td>
      <td><input type="text" name="email" value="<?php echo $row_member_edit['email']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Foto_member:</td>
      <td><input type="text" name="foto_member" value="<?php echo $row_member_edit['foto_member']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Update record"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="id_member" value="<?php echo $row_member_edit['id_member']; ?>">
</form>
<p>&nbsp;</p>
</div>
<?php include "menu.php" ?>
</div>
<?php include "footer.php" ?>
</body>
</html>
<?php
mysql_free_result($member_edit);
?>

