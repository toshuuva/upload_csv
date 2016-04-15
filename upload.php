<?php 
if(isset($_POST['submit'])=='Submit'){
	include_once('connection.php');
	//get csv file from form post
	$tmp_file=$_FILES['uploadcsv']['tmp_name'];
	$file_name=$_FILES['uploadcsv']['name'].'_'.time();
	$dir='storage';
	move_uploaded_file($tmp_file, $dir.'/'.$file_name);
	//reading csv file here
	$row = 1;
	if (($handle = fopen("storage/$file_name", "r")) !== FALSE) {
		while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
			$num = count($data);
			if($row == 1){ $row++; continue; }
			$stmt = $dbh->prepare("INSERT INTO bday_detail (std_name, class, bday, created_date) VALUES (:name, :class, :bday, :date)");
			$stmt->bindParam(':name', $data[0]);
			$stmt->bindParam(':class', $data[1]);
			$bday='2002-03-'.$data[2];
			//$stmt->bindParam(':bday', date('Y-m-d', strtotime($data[2])));
			$stmt->bindParam(':bday', $bday);
			$stmt->bindParam(':date', date('Y-m-d H:i:s'));
			$stmt->execute();
		}
	}
	echo "Your file is uploaded successfully. <a href=\"upload.php\" >click here</a> to upload next file";
}else{
?>
<html>
<head>
<title>upload file</title>
</head>
<body>
	<div>
		<a href="upload.php">Upload</a> | <a href="modify.php">Modidy</a> | <a href="edit.php">Add</a>
	</div>
	<form method="post" enctype="multipart/form-data">
		<label for="upload">Upload File :<input type="file" name="uploadcsv" value="" /><br/>
		<input type="submit"  name="submit" value="Submit" />
		
	</form>
</body>
</html>
<?php } ?>