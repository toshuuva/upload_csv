<?php 
include_once('connection.php');
if(!empty($_GET['id'])){
$sql="SELECT id, std_name as name, class, bday FROM bday_detail WHERE id=:id";
$res=$dbh->prepare($sql);
$res->execute(array(':id' => $_GET['id']));
$q=$res->fetch();
//print_r($q);
	
}

if(isset($_POST['submit'])=='Submit'){
	//update here
	if(!empty($_POST['key'])){
		$sql="UPDATE bday_detail SET std_name= :name, class=:class, bday=:bday, updated_date=:update_date WHERE id=:id";
		$stmt = $dbh->prepare($sql);                                  
		$stmt->bindParam(':name', $_POST['std_name']);  
		$stmt->bindParam(':class', $_POST['std_class']);  
		$stmt->bindParam(':bday', $_POST['bday']);  
		$stmt->bindParam(':update_date', date('Y-m-d H:i:s'));
		$stmt->bindParam(':id', $_POST['key']);
		$stmt->execute();
		//$stmt->debugDumpParams();
		header('Location: modify.php');
	}else{
		$sql="INSERT INTO bday_detail (std_name, class, bday, created_date) VALUES(:name, :class, :bday, :created)";
		$stmt = $dbh->prepare($sql);                                  
		$stmt->bindParam(':name', $_POST['std_name'], PDO::PARAM_STR);  
		$stmt->bindParam(':class', $_POST['std_class'], PDO::PARAM_STR);  
		$stmt->bindParam(':bday', $_POST['bday'], PDO::PARAM_STR);  
		$stmt->bindParam(':created', date('Y-m-d H:i:s'));
		$stmt->execute();
		header('Location: modify.php');
	}
}


?>
<html>
	<head>
		<title>update</title>
		<link rel="stylesheet" href="datepicker/css/smoothness/jquery-ui.css">
		<script src="datepicker/js/jquery-1.9.1.js"></script>
		<script src="datepicker/js/jquery-ui.js"></script>
		<script src="validateform/lib/jquery.js"></script>
		<script src="validateform/dist/jquery.validate.js"></script>
		<script>
			$(function () {
			$.validator.addMethod("regex", function (value, element, regexpr) {
				return regexpr.test(value);
			}, "Please enter a valid value.");

			$("#myForm").validate({
				rules: {
					std_name: {
						required: true,
						regex: /^[a-zA-Z\s]+$/,
						maxlength: 30,
						minlength: 3
					},
					std_class: {
						required: true,
					},
					bday: {
						required: true,
					}
					
				}
			});
			});
		</script>
		
		<script>
			$(function() {
			$( "#datepicker" ).datepicker({
			 changeMonth:true,
			 changeYear:true,
			 yearRange:"-100:+0",
			 dateFormat:"yy-mm-dd"
			});
			});
		</script>
	</head>
	<body>
		<div>
			<a href="upload.php">Upload</a> | <a href="modify.php">Modidy</a> | <a href="edit.php">Add</a>
		</div>

		<form id="myForm" method="post" action="edit.php">
		<input type="hidden" name="key" value="<?php  echo isset($q['id'])!=''? $q['id'] : null ?>" />
		<table>
		<tr>
		<td><label for="name">Student Name:</label></td>
		<td><input type="text" name="std_name" value="<?php  echo isset($q['name'])!=''? $q['name'] : null ?>" /></td>
		</tr>
		<tr>
		<td><label for="name">Student Class: </label></td>
		<td><input type="text" name="std_class" value="<?php  echo isset($q['class'])!=''? $q['class'] : null ?>" /></td>
		</tr>
		<tr>
		<td><label for="name">Student Birthday: </label></td>
		<td><input type="text" id='datepicker' class="form-control" name="bday" value="<?php  echo isset($q['bday'])!=''? $q['bday'] : null ?>" /></td>
		
		</tr>
		<tr>
		<td></td>
		<td><input type="submit" name="submit" value="Submit" /></td>
		</tr>
		</table>
		</form>
	</body>
</html>