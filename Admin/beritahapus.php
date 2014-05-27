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

if ((isset($_GET['idberita'])) && ($_GET['idberita'] != "")) {
  $deleteSQL = sprintf("DELETE FROM berita WHERE id_berita=%s",
                       GetSQLValueString($_GET['idberita'], "int"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($deleteSQL, $koneksi) or die(mysql_error());

  $deleteGoTo = "beritatampil.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $deleteGoTo .= (strpos($deleteGoTo, '?')) ? "&" : "?";
    $deleteGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $deleteGoTo));
}

$colname_hapusberita = "-1";
if (isset($_GET['idberita'])) {
  $colname_hapusberita = (get_magic_quotes_gpc()) ? $_GET['idberita'] : addslashes($_GET['idberita']);
}
mysql_select_db($database_koneksi, $koneksi);
$query_hapusberita = sprintf("SELECT * FROM berita WHERE id_berita = %s", $colname_hapusberita);
$hapusberita = mysql_query($query_hapusberita, $koneksi) or die(mysql_error());
$row_hapusberita = mysql_fetch_assoc($hapusberita);
$totalRows_hapusberita = mysql_num_rows($hapusberita);

mysql_free_result($hapusberita);
?>