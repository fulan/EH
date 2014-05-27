<?php require_once('../Connections/koneksi.php'); ?>
<?php
mysql_select_db($database_koneksi, $koneksi);
$query_u = "SELECT * FROM `admin`";
$u = mysql_query($query_u, $koneksi) or die(mysql_error());
$row_u = mysql_fetch_assoc($u);
$totalRows_u = mysql_num_rows($u);
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
    <td>1</td>
    <td>2</td>
    <td>3</td>
    <td>4</td>
    <td>5</td>
    <td>6</td>
    <td>7</td>
    <td>8</td>
    <td>9</td>
    <td>10</td>
    <td>11</td>
    <td>12</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><?php echo $row_u['id_admin']; ?></td>
    <td><?php echo $row_u['nama_admin']; ?></td>
    <td><?php echo $row_u['username']; ?></td>
    <td><?php echo $row_u['password']; ?></td>
    <td><?php echo $row_u['level']; ?></td>
    <td><?php echo $row_u['gender']; ?></td>
    <td><?php echo $row_u['agama']; ?></td>
    <td><?php echo $row_u['TTL']; ?></td>
    <td><?php echo $row_u['alamat']; ?></td>
    <td><?php echo $row_u['tlp']; ?></td>
    <td><?php echo $row_u['email']; ?></td>
    <td><?php echo $row_u['foto_admin']; ?></td>
  </tr>
</table>


</body>
</html>
<?php
mysql_free_result($u);
?>
