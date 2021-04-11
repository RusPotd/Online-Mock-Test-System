<?php
$name = $_GET['name'];

$serverName = "localhost";
$userName = "root";
$passWord = "";
$dbName = "gatedipex";

$conn = mysqli_connect($serverName, $userName, $passWord, $dbName);

$sql = "DELETE FROM `students` WHERE username='".$name."'";
$conn->query($sql);


$sql = "DELETE FROM `rank` WHERE name='".$name."'";
$conn->query($sql);

echo "<script>
    window.location.href='../welcome_admin.php?page=admin/manageStudents';
</script>
";

?>