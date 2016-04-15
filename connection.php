<?php 
$hostname='localhost';
$username='root';
$password='';
$dbname='test';

try {
    $dbh = new PDO("mysql:host=$hostname;dbname=$dbname",$username,$password);

    }
	catch(PDOException $e)
    {
		echo $e->getMessage();
    }
?>