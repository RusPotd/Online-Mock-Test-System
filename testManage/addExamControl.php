<?php

session_start();

$examName =  $_GET['e'];
$_SESSION['examName'] = $examName;
$examTime =  $_GET['t'];
$examMarks =  $_GET['m'];


$serverName = "localhost";
$userName = "root";
$passWord = "";
$dbName = "gatedipex";

$conn = mysqli_connect($serverName, $userName, $passWord, $dbName);

$sql = "INSERT INTO `exams`(`name`, `time`, `marks`) VALUES ('".$examName."',".$examTime.",".$examMarks.")";

$conn->query($sql);



?>