<?php
session_start();

$serverName = "localhost";
$userName = "root";
$passWord = "";
$dbName = "gatedipex";

$uname="";
$pass="";

$conn = mysqli_connect($serverName, $userName, $passWord, $dbName);


$isLogin = $_GET['l'];

if($isLogin==1){
    $enteredName = $_POST['uname'];
    $_SESSION['uname'] = $enteredName;
        
    if($enteredName=="admin"){
        $sql = "SELECT `username`, `password` FROM `admin` WHERE 1";
    }
    else{
        $sql = "SELECT `username`, `name`, `email`, `contact`, `password` FROM `students` WHERE username='".$enteredName."'";
    }

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    // output data of each row
        while($row = $result->fetch_assoc()) {
        $uname = $row["username"];
        $pass = $row["password"];   //$row["id"]
        }
    }

    if($enteredName==$uname && $_POST['pass']==$pass){
        $_SESSION['uname']= $uname;
        $_SESSION['pass']= $pass;
        #echo $uname;
        if($uname=="admin"){
            echo "<script>location.href='welcome_admin.php?page=home'</script>";
        }
        else{
            echo "<script>location.href='welcome.php?page=home'</script>";
        }
    }
    else{
        echo "<script>alert('No Login Details found! Go Back and Register');
              window.location.href='index.php';</script>
        ";   
    }
}
else{
    $enteredName = $_POST['uname_r'];
    $enteredEmail = $_POST['email_r'];
    $enteredContact = $_POST['contact_r'];
    $enteredPass = $_POST['pass_r'];
    $enteredFullName = $_POST['fullname_r'];

    $_SESSION['uname'] = $enteredName;

    $sql= "INSERT INTO `students`(`username`, `name`, `email`, `contact`, `password`) VALUES ('".$enteredName."','".$enteredFullName."','".$enteredEmail."','".$enteredContact."','".$enteredPass."')";

    $conn->query($sql);

    echo "<script>location.href='welcome.php?page=home'</script>";
}


?>