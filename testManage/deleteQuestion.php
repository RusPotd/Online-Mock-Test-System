<?php

$id = $_GET['id'];
$exam = $_GET['exam'];
$exam = str_replace('_', ' ', $exam);

$serverName = "localhost";
$userName = "root";
$passWord = "";
$dbName = "gatedipex";

$conn = mysqli_connect($serverName, $userName, $passWord, $dbName);

$sql = "DELETE FROM `questions` WHERE id=".$id;
$conn->query($sql);

echo "<script>
    window.location.href='../welcome_admin.php?page=admin/addExam&set=1&exam=".$exam."';
</script>
";

?>