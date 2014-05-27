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

if ((isset($_GET['idadmin'])) && ($_GET['idadmin'] != "")) {
  $deleteSQL = sprintf("DELETE FROM admin WHERE id_admin=%s",
                       GetSQLValueString($_GET['idadmin'], "int"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($deleteSQL, $koneksi) or die(mysql_error());

  $deleteGoTo = "admin.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

$colname_hapus_admin = "-1";
if (isset($_GET['idadmin'])) {
  $colname_hapus_admin = (get_magic_quotes_gpc()) ? $_GET['idadmin'] : addslashes($_GET['idadmin']);
}
mysql_select_db($database_koneksi, $koneksi);
$query_hapus_admin = sprintf("SELECT * FROM `admin` WHERE id_admin = %s", $colname_hapus_admin);
$hapus_admin = mysql_query($query_hapus_admin, $koneksi) or die(mysql_error());
$row_hapus_admin = mysql_fetch_assoc($hapus_admin);
$totalRows_hapus_admin = mysql_num_rows($hapus_admin);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
</body>
</html>
<?php
mysql_free_result($hapus_admin);
?>
