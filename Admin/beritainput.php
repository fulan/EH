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
  $insertSQL = sprintf("INSERT INTO berita (id_berita, judul, isi, gambar, penulis, tanggal, jam) VALUES (%s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['id_berita'], "int"),
                       GetSQLValueString($_POST['judul'], "text"),
                       GetSQLValueString($_POST['isi'], "text"),
                       GetSQLValueString($_POST['gambar'], "text"),
                       GetSQLValueString($_POST['penulis'], "text"),
                       GetSQLValueString($_POST['tanggal'], "date"),
                       GetSQLValueString($_POST['jam'], "date"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($insertSQL, $koneksi) or die(mysql_error());
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<link href="style.css" rel="stylesheet" type="text/css"/>
</head>

<body>
<?php include "header.php"?>
	<div id="content-wrapper">
<div id="content">
<p>
<div align="center"><strong> Halaman Tambah Berita</strong></div>
</p>
<table width="504" border="1" cellspacing="1" cellpadding="1">
  <tr>
    <td width="500"><div align="center"><b> Tambah Berita Baru Disini</b></div> </td>
  </tr>
  <tr>
    <td>&nbsp;
      <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
        <table align="center">
          
          <tr valign="baseline">
            <td nowrap align="right">Judul:</td>
            <td><input type="text" name="judul" value="" size="32"></td>
          </tr>
          <tr valign="baseline">
            <td nowrap align="right">Isi:</td>
            <td><input type="text" name="isi" value="" size="32"></td>
          </tr>
          <tr valign="baseline">
            <td nowrap align="right">Gambar:</td>
            <td><input type="file" name="gambar" value="" size="32"></td>
          </tr>
          <tr valign="baseline">
            <td nowrap align="right">Penulis:</td>
            <td><input type="text" name="penulis" value="" size="32"></td>
          </tr>
          <tr valign="baseline">
            <td nowrap align="right">&nbsp;</td>
            <td><input type="submit" value="Insert record"></td>
          </tr>
        </table>
        <input type="hidden" name="tanggal" value="<?php echo $tanggal=date("d-f-y");?>">
        <input type="hidden" name="jam" value="<?php echo $jam=date("H:i:s");?>">
        <input type="hidden" name="MM_insert" value="form1">
      </form>
    <p>&nbsp;</p></td>
  </tr>
</table>
<p><a href="beritatampil.php">Lihat Berita Disini</a></p>
</div>
<?php include "menu.php"?>
</div>
<?php include "footer.php"?>

<p>&nbsp;</p>
</body>
</html>
