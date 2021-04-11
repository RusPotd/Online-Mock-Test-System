<?php
session_start();

$exam =  $_SESSION['examName'];
//echo $exam;
$type =  $_GET['type'];
$questionMarks =  $_GET['questionMarks'];
$negativeMarks =  $_GET['negativeMarks'];
$questionMain =  $_GET['questionMain'];
$answer1 =  $_GET['answer1'];
$answer2 =  $_GET['answer2'];
$answer3 =  $_GET['answer3'];
$answer4 =  $_GET['answer4'];
$answerMain =  $_GET['answerMain'];

$serverName = "localhost";
$userName = "root";
$passWord = "";
$dbName = "gatedipex";

$conn = mysqli_connect($serverName, $userName, $passWord, $dbName);

$sql = "INSERT INTO `questions`(`examName`, `type`, `marks`, `negative`, `question`, `option1`, `option2`, `option3`, `option4`, `original`) VALUES ('".$exam."','".$type."',".$questionMarks.",".$negativeMarks.",'".$questionMain."','".$answer1."','".$answer2."','".$answer3."','".$answer4."','".$answerMain."')";

$conn->query($sql); 

echo "<script>window.location.href='../welcome_admin.php?page=admin/addExam&set=1&exam=".$exam."'</script>";

?>