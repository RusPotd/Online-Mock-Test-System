<?php
$exam = $_GET['exam'];
$exam = str_replace('_', ' ', $exam);

$serverName = "localhost";
$userName = "root";
$passWord = "";
$dbName = "gatedipex";

$conn = mysqli_connect($serverName, $userName, $passWord, $dbName);

$sql = "DELETE FROM `exams` WHERE name='".$exam."'";
$conn->query($sql);

echo "<script>
    window.location.href='../welcome_admin.php?page=home';
</script>
";

?>