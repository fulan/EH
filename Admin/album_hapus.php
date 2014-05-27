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

if ((isset($_GET['idalbum'])) && ($_GET['idalbum'] != "")) {
  $deleteSQL = sprintf("DELETE FROM album WHERE id_album=%s",
                       GetSQLValueString($_GET['idalbum'], "int"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($deleteSQL, $koneksi) or die(mysql_error());

  $deleteGoTo = "album.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

$colname_album_hapus = "-1";
if (isset($_GET['idalbum'])) {
  $colname_album_hapus = (get_magic_quotes_gpc()) ? $_GET['idalbum'] : addslashes($_GET['idalbum']);
}
mysql_select_db($database_koneksi, $koneksi);
$query_album_hapus = sprintf("SELECT * FROM album WHERE id_album = %s", $colname_album_hapus);
$album_hapus = mysql_query($query_album_hapus, $koneksi) or die(mysql_error());
$row_album_hapus = mysql_fetch_assoc($album_hapus);
$totalRows_album_hapus = mysql_num_rows($album_hapus);
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
mysql_free_result($album_hapus);
?>
