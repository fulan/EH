<?php require_once('../Connections/koneksi.php'); ?>
<?php
$colname_pengajar_lihat = "-1";
if (isset($_GET['idpengajar'])) {
  $colname_pengajar_lihat = (get_magic_quotes_gpc()) ? $_GET['idpengajar'] : addslashes($_GET['idpengajar']);
}
mysql_select_db($database_koneksi, $koneksi);
$query_pengajar_lihat = sprintf("SELECT * FROM pengajar WHERE id_pengajar = %s", $colname_pengajar_lihat);
$pengajar_lihat = mysql_query($query_pengajar_lihat, $koneksi) or die(mysql_error());
$row_pengajar_lihat = mysql_fetch_assoc($pengajar_lihat);
$totalRows_pengajar_lihat = mysql_num_rows($pengajar_lihat);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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
<p align="center"> <b>Detail DataPengajar</b></p>
<table width="300" border="0" cellspacing="1" cellpadding="0">

  <tr>
    <td>No</td>
    <td>&nbsp;<?php $i=0; $i++; echo "$i"; ?></td>
  </tr>
  <tr>
    <td>Id Pengajar </td>
    <td><?php echo $row_pengajar_lihat['id_pengajar']; ?></td>
  </tr>
  <tr>
    <td>Nomer Induk </td>
    <td><?php echo $row_pengajar_lihat['nomer_induk_pengajar']; ?></td>
  </tr>
  <tr>
    <td>Nama </td>
    <td><?php echo $row_pengajar_lihat['nama_pengajar']; ?></td>
  </tr>
  <tr>
    <td>Username</td>
    <td><?php echo $row_pengajar_lihat['username']; ?></td>
  </tr>
  <tr>
    <td>Password</td>
    <td><?php echo $row_pengajar_lihat['password']; ?></td>
  </tr>
  <tr>
    <td>Level</td>
    <td><?php echo $row_pengajar_lihat['level']; ?></td>
  </tr>
  <tr>
    <td>Gender</td>
    <td><?php echo $row_pengajar_lihat['gender']; ?></td>
  </tr>
  <tr>
    <td>Agama</td>
    <td><?php echo $row_pengajar_lihat['agama']; ?></td>
  </tr>
  <tr>
    <td>TTL</td>
    <td><?php echo $row_pengajar_lihat['TTL']; ?></td>
  </tr>
  <tr>
    <td>Alamat</td>
    <td><?php echo $row_pengajar_lihat['alamat']; ?></td>
  </tr>
  <tr>
    <td>TLP</td>
    <td><?php echo $row_pengajar_lihat['tlp']; ?></td>
  </tr>
  <tr>
    <td>Email</td>
    <td><?php echo $row_pengajar_lihat['email']; ?></td>
  </tr>
  <tr>
    <td>Foto</td>
    <td><?php echo $row_pengajar_lihat['foto_pengajar']; ?></td>
  </tr>
</table>
</div>
<?php include "menu.php"?>
</div>
<?php include "footer.php"?>
</body>
</html>
<?php
mysql_free_result($pengajar_lihat);
?>
