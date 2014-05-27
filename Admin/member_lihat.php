<?php require_once('../Connections/koneksi.php'); ?>
<?php
$colname_member_lihat = "-1";
if (isset($_GET['idmember'])) {
  $colname_member_lihat = (get_magic_quotes_gpc()) ? $_GET['idmember'] : addslashes($_GET['idmember']);
}
mysql_select_db($database_koneksi, $koneksi);
$query_member_lihat = sprintf("SELECT * FROM member WHERE id_member = %s", $colname_member_lihat);
$member_lihat = mysql_query($query_member_lihat, $koneksi) or die(mysql_error());
$row_member_lihat = mysql_fetch_assoc($member_lihat);
$totalRows_member_lihat = mysql_num_rows($member_lihat);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Untitled Document</title>
</head>

<body>
<table width="300" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td>No</td>
    <td><?php $i=0;$i++; echo "$i" ?></td>
  </tr>
  <tr>
    <td>NIM</td>
    <td><?php echo $row_member_lihat['Nomer_induk_member']; ?></td>
  </tr>
  <tr>
    <td>Nama</td>
    <td><?php echo $row_member_lihat['nama_member']; ?></td>
  </tr>
  <tr>
    <td>Username</td>
    <td><?php echo $row_member_lihat['username']; ?></td>
  </tr>
  <tr>
    <td>Password</td>
    <td><?php echo $row_member_lihat['password']; ?></td>
  </tr>
  <tr>
    <td>Level</td>
    <td><?php echo $row_member_lihat['level']; ?></td>
  </tr>
  <tr>
    <td>Gender</td>
    <td><?php echo $row_member_lihat['gender']; ?></td>
  </tr>
  <tr>
    <td>Agama</td>
    <td><?php echo $row_member_lihat['agama']; ?></td>
  </tr>
  <tr>
    <td>TTL</td>
    <td><?php echo $row_member_lihat['TTL']; ?></td>
  </tr>
  <tr>
    <td>Alamat</td>
    <td><?php echo $row_member_lihat['alamat']; ?></td>
  </tr>
  <tr>
    <td>TLP</td>
    <td><?php echo $row_member_lihat['TLP']; ?></td>
  </tr>
  <tr>
    <td>Email</td>
    <td><?php echo $row_member_lihat['email']; ?></td>
  </tr>
  <tr>
    <td>Foto</td>
    <td><?php echo $row_member_lihat['foto_member']; ?></td>
  </tr>
</table>

</body>
</html>
<?php
mysql_free_result($member_lihat);
?>
