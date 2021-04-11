<html>
<head>

<?php

  
$serverName = "localhost";
$userName = "root";
$passWord = "";
$dbName = "gatedipex";

$examTime=1;
$examMarks=1;

$conn = mysqli_connect($serverName, $userName, $passWord, $dbName);

$set = $_GET['set'];
$examName = $_GET['exam'];
$_SESSION['examName'] = $examName;

$sql = "SELECT `id`, `name`, `time`, `marks` FROM `exams` WHERE name='".$examName."'";

$num = 1;

if($set==1){  
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
        $examTime = $row["time"];
        $examMarks = $row["marks"];   //$row["id"]
        }
    }

}
?>

<link rel="stylesheet" href="assets/css/addExam.css">
<!-- using online links -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
        integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
        integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="//malihu.github.io/custom-scrollbar/jquery.mCustomScrollbar.min.css">


    <script>
        function addQuestion(){
            var e = document.getElementById('examName').value;
            var t = document.getElementById('examTime').value;
            var m = document.getElementById('examMarks').value;
            //alert(e+t+m);
            location.href="testManage/addExamControl.php?e="+e+"&t="+t+"&m="+m;
            //alert("Something wrong");
        }

    </script>

</head>
<body>
        <div id="contact" class="card rounded-2 p-4 shadow-sm">
            <h3  style='margin-bottom: 15px;'>Add Exam</h3>
            <div id="ExamDetail">
            <?php if($_GET['set']==1){ 
                echo"
                <fieldset>
                <input id='examName' class='form-control' placeholder='".$examName."' type='text' tabindex='1' disabled autofocus>
                </fieldset>
                <fieldset>
                <input id='examTime' class='form-control' placeholder='".$examTime."' type='text' tabindex='2' disabled>
                </fieldset>
                <fieldset>
                <input id='examMarks' class='form-control' placeholder='".$examMarks."' type='text' tabindex='3' disabled>
                </fieldset>
                ";

             }
             else{
                 echo " 
                 <fieldset>
                <input id='examName' placeholder='Exam Name' type='text' tabindex='1' required autofocus>
                </fieldset>
                <fieldset>
                <input id='examTime' placeholder='Total Time' type='text' tabindex='2' required>
                </fieldset>
                <fieldset>
                <input id='examMarks' placeholder='Total Marks' type='text' tabindex='3' required>
                </fieldset>
                <fieldset'>
                    <button class='btn btn-primary btn-block'  style='margin-top: 5px;' onClick='addQuestion()'>Next</button>
                </fieldset>
                 ";
             }
             
             ?>
            </div>
            </div>

            <div id="prevQuestion">
                     <?php
                        if($_GET['set']==1){ 
                        include("testManage/nextQuestion.php");
                        }
                    ?>
            </div>
            
            <div id="question">
                    <?php
                        if($_GET['set']==1){ 
                        include("testManage/loadQuestion.php");
                        }
                    ?>
            </div>
        
</body>
</html>