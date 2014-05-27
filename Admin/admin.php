<?php require_once('../Connections/koneksi.php'); ?>
<?php 
$maxRows_admin = 20;
$pageNum_admin = 0;
if (isset($_GET['pageNum_admin'])) {
  $pageNum_admin = $_GET['pageNum_admin'];
}
$startRow_admin = $pageNum_admin * $maxRows_admin;

mysql_select_db($database_koneksi, $koneksi);
$query_admin = "SELECT * FROM `admin`";
$query_limit_admin = sprintf("%s LIMIT %d, %d", $query_admin, $startRow_admin, $maxRows_admin);
$admin = mysql_query($query_limit_admin, $koneksi) or die(mysql_error());
$row_admin = mysql_fetch_assoc($admin);

if (isset($_GET['totalRows_admin'])) {
  $totalRows_admin = $_GET['totalRows_admin'];
} else {
  $all_admin = mysql_query($query_admin);
  $totalRows_admin = mysql_num_rows($all_admin);
}
$totalPages_admin = ceil($totalRows_admin/$maxRows_admin)-1;
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
<a href="admininput.php">Input Admin Baru</a>
<p>
<table width="541" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td width="31" align="center"><b>No</b></td>
    <td width="248" align="center"><b>Daftar Admin</b> </td>
    <td colspan="3" align="center"><b>Aksi</b></td>
	
  </tr>
  <?php do { ?>
    <tr>
      <td><?php $i=0;$i++;echo "$i";?></td>
      <td><?php echo $row_admin['nama_admin']; ?></td>
      <td width="82" align="center"><a href="adminlihat.php?idadmin=<?php echo $row_admin ['id_admin'];?>">Lihat</a></td>
      <td width="77" align="center"><a href="adminedit.php?idadmin=<?php echo $row_admin ['id_admin'];?>">Edit</a></td>
      <td width="91" align="center"><a href="adminhapus.php?idadmin=<?php echo $row_admin ['id_admin'];?>">Hapus</a></td>
    </tr>
    <?php } while ($row_admin = mysql_fetch_assoc($admin)); ?>
</table>
</p>
</div>
<?php include "menu.php" ?>
</div>
<?php include "footer.php" ?>

</body>
</html>
<?php
mysql_free_result($admin);
?>
