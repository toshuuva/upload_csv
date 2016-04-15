<?php 
include_once('connection.php');
$sql="SELECT id, std_name as name, class, bday FROM bday_detail WHERE status=1";
$res=$dbh->query($sql);
$res->setFetchMode(PDO::FETCH_ASSOC);
if(!empty($_GET['delete']))
{
	$sql="UPDATE bday_detail SET status=0 WHERE id=:id";
	$stmt = $dbh->prepare($sql);                                  
	$stmt->bindParam(':id', $_GET['delete'], PDO::PARAM_INT);
	$stmt->execute();

	header('Location: modify.php');
}
?>
<html>
	<head>
		<title>Student Birthday List</title>
	</head>
	<body>
		<div>
			<a href="upload.php">Upload</a> | <a href="modify.php">Modidy</a>| <a href="edit.php">Add</a>
		</div>

		<table border="1">
			<thead>
			<tr>
			<th>Student name</th>
			<th>Class</th>
			<th>Bday Date</th>
			<th>Edit / Delete</th>
			</tr>
			</thead>
			<tbody>
			<?php while ($r = $res->fetch()): ?>
			<tr>
			<td><?php echo htmlspecialchars($r['name'])?></td>
			<td><?php echo htmlspecialchars($r['class']); ?></td>
			<td><?php echo htmlspecialchars($r['bday']); ?></td>
			<td><a href="edit.php?id=<?php echo htmlspecialchars($r['id']); ?>">Edit</a> / <a onclick="return confirm('Are you sure you want to delete?')" href="modify.php?delete=<?php echo htmlspecialchars($r['id']); ?>">Delete</a></td>
			</tr>
			<?php endwhile; ?>
			</tbody>
		</table>
	</body>
</html>