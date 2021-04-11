<?php
session_start();

$uname = $_SESSION['uname'];
$currentId = $_SESSION['currentId'];
$qId= $_GET['qid'];
$exam= $_GET['exam'];
$type = $_GET['type'];
$op1= $_GET['0'];
$op2= $_GET['1'];
$op3= $_GET['2'];
$op4= $_GET['3'];
$totalQuestion= $_GET['total'];
$isReview = $_GET['r'];

$reviewVar = 0;

$ans = "";

if($op1==1){
    $ans.="1,";
}
if($op2==1){
    $ans.="2,";
}
if($op3==1){
    $ans.="3,";
}
if($op4==1){
    $ans.="4,";
}

if($isReview==0 || $isReview==1){
    $reviewVar = $isReview;
}
else if($isReview==2 && $ans!=""){
    $reviewVar = $isReview;
}


$serverName = "localhost";
$userName = "root";
$passWord = "";
$dbName = "gatedipex";

$conn = mysqli_connect($serverName, $userName, $passWord, $dbName);

$sqlMain = "SELECT EXISTS(SELECT * from answers WHERE name='".$uname."' AND quesId=".$qId." AND exam='".$exam."')";

$result = $conn->query($sqlMain);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_row()) { 
        if($row[0]==1){
            //exists
            $sql="UPDATE `answers` SET `ans`='".$ans."', `review`=".$reviewVar." WHERE name='".$uname."' AND quesId=".$qId." AND exam='".$exam."' ";
            $conn->query($sql);
        }
        else{
            $sql="INSERT INTO `answers`(`name`, `exam`, `quesId`, `quesType`, `ans`, `review`) VALUES ('".$uname."','".$exam."',".$qId.",'".$type."','".$ans."', ".$reviewVar.")";
            $conn->query($sql); 
            //echo "<script>alert('not exists');</script>";
        }
    }
}

if($currentId==($totalQuestion-1)){
    echo "<script>window.location.href='../start_test.php?test=".$exam."&id=".($currentId)."&r=1';</script>";
}
else{
    echo "<script>window.location.href='../start_test.php?test=".$exam."&id=".($currentId+1)."&r=1';</script>";
}

?>