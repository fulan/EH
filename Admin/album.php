<?php require_once('../Connections/koneksi.php'); ?>
<?php
$maxRows_album = 100;
$pageNum_album = 0;
if (isset($_GET['pageNum_album'])) {
  $pageNum_album = $_GET['pageNum_album'];
}
$startRow_album = $pageNum_album * $maxRows_album;

mysql_select_db($database_koneksi, $koneksi);
$query_album = "SELECT * FROM album ORDER BY nama_album ASC";
$query_limit_album = sprintf("%s LIMIT %d, %d", $query_album, $startRow_album, $maxRows_album);
$album = mysql_query($query_limit_album, $koneksi) or die(mysql_error());
$row_album = mysql_fetch_assoc($album);

if (isset($_GET['totalRows_album'])) {
  $totalRows_album = $_GET['totalRows_album'];
} else {
  $all_album = mysql_query($query_album);
  $totalRows_album = mysql_num_rows($all_album);
}
$totalPages_album = ceil($totalRows_album/$maxRows_album)-1;
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

<a href="album_input.php"><p>Input Album Baru</p></a>
<table width="463" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td width="44" align="center">No</td>
    <td width="305" align="center">Nama Album </td>
    <td colspan="2" align="center">Aksi</td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php $i=0;$i++;echo "$i"?></td>
      <td><?php echo $row_album['nama_album']; ?></td>
      <td width="51"><a href="album_edit.php?idalbum=<?php echo $row_album ['id_album'];?>">Edit</a></td>
      <td width="53"><a href="album_hapus.php?idalbum=<?php echo $row_album['id_album'];?>">Hapus</a></td>
    </tr>
    <?php } while ($row_album = mysql_fetch_assoc($album)); ?>
</table>

</div>
<?php include "menu.php" ?>
</div>
<?php include "footer.php" ?>

</body>
</html>
<?php
mysql_free_result($album);
?>
