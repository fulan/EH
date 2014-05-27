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

if ((isset($_GET['idpengajar'])) && ($_GET['idpengajar'] != "")) {
  $deleteSQL = sprintf("DELETE FROM pengajar WHERE id_pengajar=%s",
                       GetSQLValueString($_GET['idpengajar'], "int"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($deleteSQL, $koneksi) or die(mysql_error());

  $deleteGoTo = "pengajar.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

$colname_pengajar_hapus = "-1";
if (isset($_GET['idpengajar'])) {
  $colname_pengajar_hapus = (get_magic_quotes_gpc()) ? $_GET['idpengajar'] : addslashes($_GET['idpengajar']);
}
mysql_select_db($database_koneksi, $koneksi);
$query_pengajar_hapus = sprintf("SELECT * FROM pengajar WHERE id_pengajar = %s", $colname_pengajar_hapus);
$pengajar_hapus = mysql_query($query_pengajar_hapus, $koneksi) or die(mysql_error());
$row_pengajar_hapus = mysql_fetch_assoc($pengajar_hapus);
$totalRows_pengajar_hapus = mysql_num_rows($pengajar_hapus);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body>

</body>
</html>
<?php
mysql_free_result($pengajar_hapus);
?>
