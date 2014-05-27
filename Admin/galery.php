<?php require_once('../Connections/koneksi.php'); ?>
<?php
$maxRows_galery = 50;
$pageNum_galery = 0;
if (isset($_GET['pageNum_galery'])) {
  $pageNum_galery = $_GET['pageNum_galery'];
}
$startRow_galery = $pageNum_galery * $maxRows_galery;

mysql_select_db($database_koneksi, $koneksi);
$query_galery = "SELECT * FROM galery";
$query_limit_galery = sprintf("%s LIMIT %d, %d", $query_galery, $startRow_galery, $maxRows_galery);
$galery = mysql_query($query_limit_galery, $koneksi) or die(mysql_error());
$row_galery = mysql_fetch_assoc($galery);

if (isset($_GET['totalRows_galery'])) {
  $totalRows_galery = $_GET['totalRows_galery'];
} else {
  $all_galery = mysql_query($query_galery);
  $totalRows_galery = mysql_num_rows($all_galery);
}
$totalPages_galery = ceil($totalRows_galery/$maxRows_galery)-1;
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>


<body>
<p>
<a href="galery_input.php">Input Galery Baru </a></p>
<table width="446" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td width="45" align="center"><b>No</b></td>
    <td width="273" align="center"><b>Nama Galery </b></td>
	<td colspan="2" align="center"><b>Aksi</b></td>
  </tr>
  <?php do { ?>
    <tr>
      <td><?php $i=0; $i++; echo "$i" ?></td>
      <td><?php echo $row_galery['nama_galery']; ?></td>
      <td width="58"><a href="galery_edit.php?idgalery=<?php echo $row_album ['id_galery'];?>">Edit</a></td>
      <td width="60"> <a href="galery_hapus.php?idgalery=<?php echo $row_album ['id_galery'];?>">Hapus</a></td>
    </tr>
    <?php } while ($row_galery = mysql_fetch_assoc($galery)); ?>
</table>
</body>
</html>
<?php
mysql_free_result($galery);
?>
