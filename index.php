<?php 
require_once('./db.php');

$sql = 'select * from products';
$res = $db->query($sql);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Catalog</title>
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
		<div class="wrapp">
			<h2>Catalog of citrus fruits &darr; </h2>
			<div class="grid">
				<?php while ($result = $res->fetch_assoc()) :?>
					<div class="grid-catalog">
						<div class="inner-grid">
							<img src="<?php echo $result['images']; ?>">
							<h1><?php echo $result['title']; ?></h1>
							<p><?php echo $result['description']; ?></p>
						</div>
					</div>
				<?php endwhile; ?>
			</div>

			<div class="comments">
				<h2>Comments</h2>

				<?php 
					$sql = 'select * from comments where status = "Approved"';
					$res = $db->query($sql);
				?>
				<?php while ($row = $res->fetch_assoc()) :?>
					<?php if ($row['status'] != 'Disapproved'): ?>
						<div>
							<p><?php echo $row['name']; ?></p>
							<p><?php echo $row['email']; ?></p>
							<p><?php echo $row['text_field']; ?></p>
						</div>	
						<hr>
					<?php endif ?>
				<?php endwhile; ?>
			</div>
			<div class="leave-comments">
				<form action="comments.php" method="post" id="usrcmnt">
					<hr>
					<h2>Leave a comments</h2>
					<div class="form-controll">
						<label>Name</label>
						<input type="text" name="name">
					</div>
					<div class="form-controll">
						<label>Email</label>
						<input type="email" name="email">
					</div>
					<div class="form-controll">
						<label>Text</label> <br>
						<textarea placeholder="Leave a comments" maxlength="1000" form="usrcmnt" name="text"></textarea> 
					</div>
					<input type="hidden" name="hn" value="post">
					<input type="submit" value="Post" class="button">
				</form>
			</div>
		</div>
	</div>
	<footer>
		<p>Citrus system &copy; <?php echo date('Y'); ?></p>
	</footer>
</body>
</html>