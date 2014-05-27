<?php require_once('../Connections/koneksi.php'); ?>
<?php
$maxRows_tampilberita = 10;
$pageNum_tampilberita = 0;
if (isset($_GET['pageNum_tampilberita'])) {
  $pageNum_tampilberita = $_GET['pageNum_tampilberita'];
}
$startRow_tampilberita = $pageNum_tampilberita * $maxRows_tampilberita;

mysql_select_db($database_koneksi, $koneksi);
$query_tampilberita = "SELECT * FROM berita";
$query_limit_tampilberita = sprintf("%s LIMIT %d, %d", $query_tampilberita, $startRow_tampilberita, $maxRows_tampilberita);
$tampilberita = mysql_query($query_limit_tampilberita, $koneksi) or die(mysql_error());
$row_tampilberita = mysql_fetch_assoc($tampilberita);

if (isset($_GET['totalRows_tampilberita'])) {
  $totalRows_tampilberita = $_GET['totalRows_tampilberita'];
} else {
  $all_tampilberita = mysql_query($query_tampilberita);
  $totalRows_tampilberita = mysql_num_rows($all_tampilberita);
}
$totalPages_tampilberita = ceil($totalRows_tampilberita/$maxRows_tampilberita)-1;
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
<p><div align="center"><strong> Halaman Untuk Mengelola Berita</strong></div>
</p>
<a href="beritainput.php"><strong>Input Berita Baru</strong></a>
<p><table width="591" border="1" cellpadding="0" cellspacing="0">
<tr>
	<td width="45"><div align="center"><strong>No</strong></div></td>
	<td width="225" align="center"><strong> Judul Berita</strong></td>
	<td width="200"><div align="center"><strong>Tanggal</strong></div></td>
	<td colspan="2"><div align="center"><strong>Aksi</strong></div></td>
</tr>
<?php do { ?>
<tr>
  	<td><?php
		$i=0;$i++;
		echo $i;
		?>
    </td>
    <td align="left"><?php echo $row_tampilberita['judul']; ?></td>
    <td align="left"><div align="left"><?php echo $row_tampilberita['tanggal']; ?></div></td>
    <td width="70"><a href="beritaedit.php?idberita=<?php echo $row_tampilberita['id_berita'];?>">Edit</a></td>
    <td width="39"><a href="beritahapus.php?idberita=<?php echo $row_tampilberita['id_berita'];?>">Hapus</a></td>
  </tr>
  <?php } while ($row_tampilberita = mysql_fetch_assoc($tampilberita)); ?>
</table>
</div>
	<?php include "menu.php" ?>
</div>

<?php include "footer.php" ?>
</body>
</html>
<?php
mysql_free_result($tampilberita);
?>
