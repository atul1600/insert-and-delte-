<!DOCTYPE html>  	
<html>
<head>
	<title>system</title>
</head>
<body>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	
	<div class="container">
		<h1>welcome</h1>
		<form method="post" action="index.php" enctype="multipart/form-data">
		<div class="form-group">
			<label>Name</label>
			<input type="text" name="name" class="form-control">
		</div>
		<div class="form-group">
			<label>email</label>
			<input type="text" name="email" class="form-control">
		</div>
		<div class="form-group">
			<label>number</label>
			<input type="text" name="number" class="form-control">
		</div>
		<div class="form-group">
			<label >image</label>
			<input type="file" name="image" class="form-control">
		</div>
		<br>
		<div class="form-group">
			<input class="form-control" type="submit" name="submit"> <br>
			<input class="form-control" type="submit" name="display" value="displaydata">
			
		</div>
	</div>
</form>
</body>
</html>

<?php 
$conn = mysqli_connect('localhost','root','','cnew');
if (isset($_POST['submit'])) {
	$name = $_POST['name'];
	$email = $_POST['email'];
	$number = $_POST['number'];

	$image = $_FILES['image']['name'];
	$tmp_image = $_FILES['image']['tmp_name'];
	$target = "image/".basename($image);

	$sql = "INSERT INTO `user`(`id`, `name`, `email`, `number`, `image`) VALUES (null,'$name','$email','$number','$image')";
	$run = mysqli_query($conn,$sql);
	if (move_uploaded_file($tmp_image, $target)) {
		echo "data uploaded successfully";
	}else{
		echo "failed to upload data";
	}
}
if (isset($_POST['display'])) {
	$sql = "SELECT * FROM `user`";
	$run = mysqli_query($conn,$sql);
	$count = 1;
	if (mysqli_num_rows($run)>0) {
		?>
		<table>
			<thead>
				<tr>
					<th>Id</th>
					<th>Name</th>
					<th>Number</th>
					<th>Email</th>
					<th>Image</th>
				</tr>
				<tbody>
					<?php while($data = mysqli_fetch_assoc($run)){?>
						<tr>
							<td><?= $count ?></td>
							<td><?= $data['name']; ?></td>
							<td><?= $data['number']; ?></td>
							<td><?= $data['email']; ?></td>
							<td><img height="50px" width="50px" src="image/<?php echo $data['image'] ?>"></td>
						</tr>
						<?php $count = $count+1; ?>	
					<?php }?>
				</tbody>
			</thead>
		</table>

		<?php
	}else{
		echo "data is absent";
	}
}
 ?>