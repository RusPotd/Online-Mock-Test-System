<?php
$exam = $_GET['exam'];
$exam = str_replace("_"," ",$exam);
$quesId=0;
$quesType="";
$ans="";
$Name = $_GET['name'];

unset($_SESSION['examStarted']);

$correctAnswer = 0;
$wrongAnswer = 0;
$notAnswered = 0;
$totalScore = 0;
$obtainedScore = 0;

$questionArray = array();
$yourAnswerArray = array();
$CorrectAnswerArray = array();


$serverName = "localhost";
$userName = "root";
$passWord = "";
$dbName = "gatedipex";

$conn = mysqli_connect($serverName, $userName, $passWord, $dbName);    

$sql = "SELECT `name`, `exam`, `quesId`, `quesType`, `ans` FROM `answers` WHERE name='".$Name."' AND exam='".$exam."'";

$result = $conn->query($sql);
//echo $result->num_rows." rows ";

if ($result->num_rows > 0){
    // output data of each row
    while($row = $result->fetch_assoc()) { 
        $quesId = $row['quesId'];
        $quesType = $row['quesType'];
        $ans = $row['ans'];

        //SELECT `id`, `examName`, `type`, `marks`, `negative`, `question`, `option1`, `option2`, `option3`, `option4`, `original` FROM `questions` WHERE 1
        $sql2 = "SELECT * FROM `questions` WHERE id=".$quesId." AND examName='".$exam."'";

        $result2 = $conn->query($sql2);

        if ($result2->num_rows > 0){
            // output data of each row
            while($row2 = $result2->fetch_assoc()) {
                $questionArray[] = $row2['question'];
                $str_arr = preg_split ("/\,/", $row2['original']);
                //print_r($str_arr);
                $originalAnswerDecode = "";
                for($i=0; $i<sizeof($str_arr); $i++){   //append original answer
                    if($str_arr[$i]=="1"){
                        $originalAnswerDecode.=$row2['option1'].", ";
                    }
                    else if($str_arr[$i]=="2"){
                        $originalAnswerDecode.=$row2['option2'].", ";
                    }
                    else if($str_arr[$i]=="3"){
                        $originalAnswerDecode.=$row2['option3'].", ";
                    }
                    else if($str_arr[$i]=="4"){
                        $originalAnswerDecode.=$row2['option4'].", ";
                    }
                }
                //echo $originalAnswerDecode;
                $CorrectAnswerArray[] = $originalAnswerDecode;
                //print_r($str_arr);
                if($ans==""){
                    $notAnswered+=1;
                    $totalScore+=$row2['marks'];
                    //echo "User answer<br>Null<br>";
                    $yourAnswerArray[] = "null";
                }
                else if(sizeof($str_arr)>0){
                    $str_arr_main = preg_split ("/\,/", $ans);
                    //echo "User answer<br>";
                    $userAnswerDecode = "";
                    for($i=0; $i<sizeof($str_arr_main); $i++){   //append user answer
                        if($str_arr_main[$i]=="1"){
                            $userAnswerDecode.=$row2['option1'].", ";
                        }
                        else if($str_arr_main[$i]=="2"){
                            $userAnswerDecode.=$row2['option2'].", ";
                        }
                        else if($str_arr_main[$i]=="3"){
                            $userAnswerDecode.=$row2['option3'].", ";
                        }
                        else if($str_arr_main[$i]=="4"){
                            $userAnswerDecode.=$row2['option4'].", ";
                        }
                    }
                    //echo $userAnswerDecode."<br><br>";
                    $yourAnswerArray[] = $userAnswerDecode;

                    if($quesType=="MCQ"){
                        //print_r($str_arr_main);
                        if($str_arr[0]==$str_arr_main[0]){
                            $correctAnswer+=1;
                            $totalScore+=$row2['marks'];
                            $obtainedScore+=$row2['marks'];
                            //echo $str_arr[0].".........".$str_arr_main[0];
                        }
                        else{
                            $wrongAnswer+=1;
                            $totalScore+=$row2['marks'];
                            $obtainedScore-=$row2['negative'];
                        }
                    }
                    else if($quesType=="MSQ"){
                        //$str_arr_main = preg_split ("/\,/", $ans);
                        //echo "MSQ found";
                        //print_r($str_arr);
                        //print_r($str_arr_main);
                        $count=0;
                        for($i=0; $i<sizeof($str_arr); $i++){
                            if($str_arr[$i]==""){
                                $count+=1;
                                continue;
                            }
                            else if($str_arr[$i]==$str_arr_main[$i]){
                                $count+=1;
                            }
                            else{
                                break;
                            }
                        }
                        //echo $count;
                        if($count==sizeof($str_arr)){
                            //echo "Answer correct";
                            $correctAnswer+=1;
                            $totalScore+=$row2['marks'];
                            $obtainedScore+=$row2['marks'];
                            //echo $str_arr[0].".........".$str_arr_main[0];
                        }
                        else{
                            //wrong answer
                            $wrongAnswer+=1;
                            $totalScore+=$row2['marks'];
                            $obtainedScore-=$row2['negative'];
                        }
                    }
                }
            }
        }
    }
}

/*
echo "Correct = ".$correctAnswer;
echo "wrong = ".$wrongAnswer;
echo "Not Answered = ".$notAnswered;
echo "otained = ".$obtainedScore;
echo "total = ".$totalScore;
print_r($questionArray);
print_r($CorrectAnswerArray);
print_r($yourAnswerArray);
*/
?>
<html>
    <head>
        <style>
            .overview{
                float: right;
                padding: 100px;
                z-index:1;
                position:absolute;
                margin-left:47%;
                margin-right:2%;
            }
            .detail{
                
            }
            .dot {
                height: 15px;
                width: 15px;
                border-radius: 50%;
                display: inline-block;
                margin-right: 10px;
            }
            .bottom_class{
                height: auto;
                width: 66%;
            }
            .answerLabel{
                font-family: "Courier New";
            }
            .answerLabel2{
                font-family: "Georgia";
                margin-bottom: 10px;
            }
        </style>
    </head>
    <body>
    <div class='card rounded-0 p-3 shadow-sm overview'>
    <table>
        <tr>
            <h3 style="font-family:Georgia; margin-bottom:10px;"># Result of <?php echo $exam; ?></h3>
        </tr>
        <tr>
            <td><span class="dot" style="background-color: green;"></span></td>
            <td><h5 class="answerLabel">Correct Answer: <?php echo $correctAnswer; ?></h5></td>
        </tr>
        <tr>
            <td><span class="dot" style="background-color: red;"></span></td>
            <td><h5 class="answerLabel">Wrong Answer: <?php echo $wrongAnswer; ?></h5></td>
        </tr>
        <tr>
            <td><span class="dot" style="background-color: gray;"></span></td>
            <td><h5 class="answerLabel">Not Answered: <?php echo $notAnswered; ?></h5></td>
        </tr>
        <tr>
            <td><span class="dot" style="background-color: orange;"></span></td>
            <td><h5 class="answerLabel">Total Score: <?php echo $obtainedScore."/".$totalScore; ?></h5></td>
        </tr>   
    </table>
    </div>
    <div class="bottom_class">
        <h3 style="margin-bottom: 20px; font-family:Georgia;"># Detailed Analysis</h3>
        <?php
            for($i=0; $i<sizeof($questionArray); $i++){
                echo "
                <div  class='card rounded-0 p-2 shadow-sm detail'>
                    <label class='answerLabel2' style='font-size:17px;'><strong>Question: </strong>".$questionArray[$i]."</label>
                    <label class='answerLabel2'><strong>Entered Answer: </strong>".$yourAnswerArray[$i]."</label>
                    <label class='answerLabel2'><strong>Correct Answer: </strong>".$CorrectAnswerArray[$i]."</label>
                </div>
                <br>
                ";
            }

            $sqlMain = "SELECT EXISTS(SELECT * FROM `rank` WHERE name='".$Name."' AND exam='".$exam."')";

            $result = $conn->query($sqlMain);

            if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_row()) { 
                    if($row[0]==1){
                        //exists do nothing
                    }
                    else{
                        $sql="INSERT INTO `rank` (`name`, `exam`, `score`, `total`) VALUES ('".$Name."','".$exam."',".$obtainedScore.",".$totalScore.")";
                        $conn->query($sql); 
                        $sql = "UPDATE `time` SET `finish`=1 WHERE name='".$Name."' AND exam='".$exam."'";
                        //echo $sql;
                        $conn->query($sql); 
                        //echo "<script>alert('not exists');</script>";
                    }
                }
            }
        ?>
    </div>
    </body>
</html>