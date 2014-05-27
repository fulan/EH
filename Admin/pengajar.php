<?php require_once('../Connections/koneksi.php'); ?>
<?php
$maxRows_pengajar = 200;
$pageNum_pengajar = 0;
if (isset($_GET['pageNum_pengajar'])) {
  $pageNum_pengajar = $_GET['pageNum_pengajar'];
}
$startRow_pengajar = $pageNum_pengajar * $maxRows_pengajar;

mysql_select_db($database_koneksi, $koneksi);
$query_pengajar = "SELECT * FROM pengajar";
$query_limit_pengajar = sprintf("%s LIMIT %d, %d", $query_pengajar, $startRow_pengajar, $maxRows_pengajar);
$pengajar = mysql_query($query_limit_pengajar, $koneksi) or die(mysql_error());
$row_pengajar = mysql_fetch_assoc($pengajar);

if (isset($_GET['totalRows_pengajar'])) {
  $totalRows_pengajar = $_GET['totalRows_pengajar'];
} else {
  $all_pengajar = mysql_query($query_pengajar);
  $totalRows_pengajar = mysql_num_rows($all_pengajar);
}
$totalPages_pengajar = ceil($totalRows_pengajar/$maxRows_pengajar)-1;
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
<link href="style.css" rel="stylesheet" type="text/css" /></head>

<body>
<?php include "header.php" ?>
<div id="content-wrapper">
<div id="content">
<p>
<a href="pengajar_input.php">Input Pengajar Baru</a></p>
<p>
<table width="541" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td width="31" align="center"><b>No</b></td>
	 <td width="248" align="center"><strong>Nomer Induk </strong></td>
     <td width="248" align="center"><strong>Nama Pengajar </strong></td>
     <td colspan="3" align="center"><b>Aksi</b></td>
	
  </tr>
  <?php do { ?>
    <tr>
        <td><?php $i=0;$i++;echo "$i";?></td>
      <td><?php echo $row_pengajar['nomer_induk_pengajar']; ?></td>
      <td><?php echo $row_pengajar['nama_pengajar']; ?></td
      >
      <td width="82" align="center"><a href="pengajar_lihat.php?idpengajar=<?php echo $row_pengajar ['id_pengajar'];?>">Lihat</a></td>
      <td width="77" align="center"><a href="pengajar_edit.php?idpengajar=<?php echo $row_pengajar ['id_pengajar'];?>">Edit</a></td>
      <td width="91" align="center"><a href="pengajar_hapus.php?idpengajar=<?php echo $row_pengajar ['id_pengajar'];?>">Hapus</a></td>
    </tr>
    <?php } while ($row_pengajar = mysql_fetch_assoc($pengajar)); ?>
</table>
</p>
</div>
<?php include "menu.php" ?>
</div>
<?php include "footer.php" ?>

</body>
</html>
<?php
mysql_free_result($pengajar);
?>