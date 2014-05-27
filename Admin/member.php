<?php require_once('../Connections/koneksi.php'); ?>
<?php
$maxRows_member = 1000;
$pageNum_member = 0;
if (isset($_GET['pageNum_member'])) {
  $pageNum_member = $_GET['pageNum_member'];
}
$startRow_member = $pageNum_member * $maxRows_member;

mysql_select_db($database_koneksi, $koneksi);
$query_member = "SELECT * FROM member";
$query_limit_member = sprintf("%s LIMIT %d, %d", $query_member, $startRow_member, $maxRows_member);
$member = mysql_query($query_limit_member, $koneksi) or die(mysql_error());
$row_member = mysql_fetch_assoc($member);

if (isset($_GET['totalRows_member'])) {
  $totalRows_member = $_GET['totalRows_member'];
} else {
  $all_member = mysql_query($query_member);
  $totalRows_member = mysql_num_rows($all_member);
}
$totalPages_member = ceil($totalRows_member/$maxRows_member)-1;
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

<a href="member_input.php"><p>Input Member Baru</p></a>
<p>
<table width="541" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td width="31" align="center"><b>No</b></td>
	 <td width="248" align="center"><strong>Nomer Induk </strong></td>
     <td width="248" align="center"><strong>Nama Member </strong></td>
     <td colspan="3" align="center"><b>Aksi</b></td>
  </tr>
  
    <?php do { ?>
      <tr>
        <td><?php $i=0;$i++;echo "$i";?></td>
        <td><?php echo $row_member['Nomer_induk_member']; ?></td>
        <td><?php echo $row_member['nama_member']; ?></td>
        <td width="82" align="center"><a href="member_lihat.php?idmember=<?php echo $row_member ['id_member'];?>">Lihat</a></td>
        <td width="77" align="center"><a href="member_edit.php?idmember=<?php echo $row_member ['id_member'];?>">Edit</a></td>
        <td width="91" align="center"><a href="member_hapus.php?idmember=<?php echo $row_member ['id_member'];?>">Hapus</a></td>
      </tr>
      
    <?php } while ($row_member = mysql_fetch_assoc($member)); ?>
</table>
</p>
</div>
<?php include "menu.php" ?>
</div>
<?php include "footer.php" ?>

</body>
</html>
<?php
mysql_free_result($member);


?>