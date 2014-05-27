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
  $updateSQL = sprintf("UPDATE berita SET judul=%s, isi=%s, gambar=%s, penulis=%s, tanggal=%s, jam=%s WHERE id_berita=%s",
                       GetSQLValueString($_POST['judul'], "text"),
                       GetSQLValueString($_POST['isi'], "text"),
                       GetSQLValueString($_POST['gambar'], "text"),
                       GetSQLValueString($_POST['penulis'], "text"),
                       GetSQLValueString($_POST['tanggal'], "date"),
                       GetSQLValueString($_POST['jam'], "date"),
                       GetSQLValueString($_POST['id_berita'], "int"));

  mysql_select_db($database_koneksi, $koneksi);
  $Result1 = mysql_query($updateSQL, $koneksi) or die(mysql_error());

  $updateGoTo = "beritatampil.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_edit_berita = "-1";
if (isset($_GET['idberita'])) {
  $colname_edit_berita = (get_magic_quotes_gpc()) ? $_GET['idberita'] : addslashes($_GET['idberita']);
}
mysql_select_db($database_koneksi, $koneksi);
$query_edit_berita = sprintf("SELECT * FROM berita WHERE id_berita = %s", $colname_edit_berita);
$edit_berita = mysql_query($query_edit_berita, $koneksi) or die(mysql_error());
$row_edit_berita = mysql_fetch_assoc($edit_berita);
$totalRows_edit_berita = mysql_num_rows($edit_berita);

mysql_free_result($edit_berita);
?>
<form method="post" name="form1" action="<?php echo $editFormAction; ?>">
  <table align="center">
    <tr valign="baseline">
      <td nowrap align="right">Id_berita:</td>
      <td><?php echo $row_edit_berita['id_berita']; ?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Judul:</td>
      <td><input type="text" name="judul" value="<?php echo $row_edit_berita['judul']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Isi:</td>
      <td><input type="text" name="isi" value="<?php echo $row_edit_berita['isi']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Gambar:</td>
      <td><input type="text" name="gambar" value="<?php echo $row_edit_berita['gambar']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Penulis:</td>
      <td><input type="text" name="penulis" value="<?php echo $row_edit_berita['penulis']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Tanggal:</td>
      <td><input type="text" name="tanggal" value="<?php echo $row_edit_berita['tanggal']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">Jam:</td>
      <td><input type="text" name="jam" value="<?php echo $row_edit_berita['jam']; ?>" size="32"></td>
    </tr>
    <tr valign="baseline">
      <td nowrap align="right">&nbsp;</td>
      <td><input type="submit" value="Update record"></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1">
  <input type="hidden" name="id_berita" value="<?php echo $row_edit_berita['id_berita']; ?>">
</form>
<p>&nbsp;</p>
