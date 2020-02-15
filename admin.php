<?php 
require_once('./db.php');

$sql = 'select id, name, text_field, status from comments';
$res = $db->query($sql);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin</title>
	<link rel="stylesheet" type="text/css" href="./css/main.css">
</head>
<body>
	<div class="wrapper">
		<nav>
			<ul>
				<li><a href="index">Citrus</a></li>
			</ul>
			<ul class="links">
				<li><a href="index.php">Home</a></li>
				<li><a href="admin.php">Admin</a></li>
			</ul>
		</nav>
		<h1>Comments to approve</h1>
		<div class="table-user">
			<table border="1px" cellpadding="10" cellspacing="0">
				<thead>
					<tr class="table">
						<th>id</th>
						<th>Name</th>
						<th>Text</th>
						<th>Status</th>
						<th>Approve</th>
					</tr>
				</thead>
				<tbody>
					<?php while ($result = $res->fetch_assoc()): ?>
						<tr class="table-color">
							<td><?php echo $result['id']; ?></td>
							<td><?php echo $result['name']; ?></td>
							<td><?php echo $result['text_field']; ?></td>
							<td><?php echo $result['status']; ?></td>
							<td>
								<form action="./comments.php" method="post" class="admin-controll">
									<input type="hidden" name="hn" value="approved">
									<input type="text" name="<?php echo $result['id'];?>" placeholder="Type Approve">
								</form>
							</td>
						</tr>
					<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
	<footer>
		<p>Citrus system &copy; <?php echo date('Y'); ?></p>
	</footer>
</body>
</html>