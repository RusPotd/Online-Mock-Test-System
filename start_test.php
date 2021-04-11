<html>
<?php
 session_start(); 

 $exam = $_GET['test'];
 $examTime = "";
 $examMarks = "";

 if(isset($_SESSION['examStarted'])){
    
     if($_SESSION['examStarted']==$_GET['test'] && $_GET['r']==0){
         //same user reloading page
         echo "<script>window.location.href='start_test.php?test=".$exam."&id=".$_GET['id']."&r=1';</script>";
     }//else {user skipped one test and started another}
 }
 else{
    $_SESSION['examStarted'] = "123456789123456789";
 }

 $id = $_GET['id'];
 $_SESSION['currentId'] = $id;
 $isReview = $_GET['r'];

 $totalQuestion = "";
 $type = "";
 $questionMarks = "";
 $negativeMarks = "";;
 $questionMain = "";
 $answer1 = "";
 $answer2 = "";
 $answer3 = "";
 $answer4 = "";
 $answerMain = "";
 $currentQuestionID = "";

 $serverName = "localhost";
 $userName = "root";
 $passWord = "";
 $dbName = "gatedipex";

 $num = 1;

 $conn = mysqli_connect($serverName, $userName, $passWord, $dbName);    

 $sql = "SELECT `id`, `name`, `time`, `marks` FROM `exams` WHERE name='".$exam."'";

 $result = $conn->query($sql);

 if ($result->num_rows > 0) {
     // output data of each row
     while($row = $result->fetch_assoc()) { //$row["id"]
        $examTime = $row["time"];
        
        $examMarks = $row["marks"];
     }
}

$sql6 = "SELECT * FROM `answers` WHERE name='".$_SESSION['uname']."' AND exam='".$exam."' AND review=1";
$result6 = $conn->query($sql6);   //matching its review
$noOfReviewQues = $result6->num_rows; 

if($isReview==0 && $_SESSION['examStarted']!=$_GET['test']){
    $_SESSION['examStarted'] = $_GET['test'];
    $present = date('Y-m-d H:i:s');
    $duration = $examTime*60;
    $endTime = date("Y-m-d H:i:s", strtotime("+$duration sec"));
    $_SESSION['endTime'] = $endTime;
    //echo "<- end at ->".$endTime;
    $sql7 = "INSERT INTO `time`( `name`, `exam`, `start`, `end`, `finish`) VALUES ('".$_SESSION['uname']."','".$exam."','".$present."','".$endTime."',0)";
    $conn->query($sql7); 
 }

?>
<head>
<!-- using online links -->
<!-- using online links -->


    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
        integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="//malihu.github.io/custom-scrollbar/jquery.mCustomScrollbar.min.css">
    <link rel="shortcut icon" type="image/png" href="img/favicon.png" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
        integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/start_test.css">

    <script>
        var id = <?php echo $id; ?>;

        function clearResponce(){
            document.getElementById("op1").checked = false;
            document.getElementById("op2").checked = false;
            document.getElementById("op3").checked = false;
            document.getElementById("op4").checked = false;
        }

        function goTo(id){
            <?php
                echo "  
                    window.location.href='start_test.php?test=".$exam."&id='+(id)+'&r=1';
                ";  
            ?>
        }

        function myFunction() {
            var x = document.getElementById("myDIV");
            if (x.style.display === "none") {
                x.style.display = "block";
            } else {
                x.style.display = "none";
            }
        }

        function finalSubmit(a=0){
            if(a==1){
                if (confirm("Had you saved all answers? Because final submit do not save answers automatically! Click 'Ok' to proceed OR click 'Cancel'.")) {
                    <?php
                        echo "window.location.href='welcome.php?page=viewResult&exam=".$exam."&name=".$_SESSION['uname']."';";
                    ?>  
                } else {
                    //do nothing
                }
            }
            else{
                <?php
                echo "window.location.href='welcome.php?page=viewResult&exam=".$exam."&name=".$_SESSION['uname']."';";
                ?>
            }
        }
    </script>
</head>
<body>
<div class="container1">
    <!--Question Paper-->
    <div class="questionPaper">

     <!--Time section-->

                <script>
                    // Set the date we're counting down to
                    var countDownDate = 1;
                    var minRemaining = 0;
                    var secRemaining = 0;

                    <?php 
                        $totalSec = strtotime($_SESSION['endTime']) - strtotime(date('Y-m-d H:i:s'));
                        $minLeft = floor($totalSec/60);
                        $secLeft = $totalSec%60;
                        echo "minRemaining = ".$minLeft.";";
                        echo "secRemaining = ".$secLeft.";";
                    ?>

                    // Update the count down every 1 second
                    var x = setInterval(function() {

                    document.getElementById("remainingTimeShow").innerHTML = minRemaining+':'+secRemaining;
                    secRemaining-=1;
                    if(minRemaining>0 && secRemaining<=0 ){
                        minRemaining-=1;
                        secRemaining=60;
                    }
                    if(minRemaining<=0 && secRemaining<=0){
                        //clock ended
                        finalSubmit();
                    }
                    }, 1000);
                </script>
        
                <div class='card rounded-0 p-1 timeSec'>
                    <label style="background-color:lightblue; padding:0% 5%; position: absolute;" class="panel-info"><?php echo $exam; ?></label>
                    <div style='float:right;'>
                    <label class='fa fa-calculator' style='font-size: large; color:blue; margin-right:30px;' onClick='myFunction()' ></label>
                    <strong>
                        Time Left: <label id="remainingTimeShow"></label>
                    </strong>
                    </div>
                </div>

                 <!--calculator section-->

                <div id='myDIV' class='calcy' style="display:none;">
                            <!--
                            TERMS OF USE
                            BY USING THE CODE, YOU AGREE:
                            1. THAT THE MATERIALS ARE PROVIDED "AS IS" AND WITHOUT WARRANTIES OF ANY KIND
                            2. NOT TO CHANGE ANY OF THE JAVASCRIPT CODE, INCLUDING THE LICENSE TEXT
                            3. NOT TO REMOVE THE LINE OF TEXT "powered by calculator.net"
                            4. THAT THE COPYRIGHT BELONGS TO calculator.net
                            5. NOT TO REMOVE THE TERMS OF USE
                            -->
                            <!--BEGIN OF SCIENTIFIC CALCULATOR CODE-->

                            <script>
                            /*****************************************
                            (C) https://www.calculator.net all right reserved.
                            *****************************************/
                            function gObj(obj) {var theObj;if(document.all){if(typeof obj=="string"){return document.all(obj);}else{return obj.style;}}if(document.getElementById){if(typeof obj=="string"){return document.getElementById(obj);}else{return obj.style;}}return null;}function trimAll(sString){while (sString.substring(0,1) == ' '){sString = sString.substring(1, sString.length);}while (sString.substring(sString.length-1, sString.length) == ' '){sString = sString.substring(0,sString.length-1);} return sString;} function showDebugInfo(){}function r(A){if(A=="10x"||A=="log"||A=="ex"||A=="ln"||A=="sin"||A=="asin"||A=="cos"||A=="acos"||A=="tan"||A=="atan"||A=="e"||A=="pi"||A=="n!"||A=="x2"||A=="1/x"||A=="swap"||A=="x3"||A=="3x"||A=="RND"||A=="M-"||A=="qc"||A=="MC"||A=="MR"||A=="MS"||A=="M+"||A=="sqrt"||A=="pc"){func(A)}else{if(A==1||A==2||A==3||A==4||A==5||A==6||A==7||A==8||A==9||A==0){numInput(A)}else{if(A=="pow"||A=="apow"||A=="+"||A=="-"||A=="*"||A=="/"){opt(A)}else{if(A=="("){popen()}else{if(A==")"){pclose()}else{if(A=="EXP"){exp()}else{if(A=="."){if(entered){value=0;digits=1}entered=false;if((decimal==0)&&(value==0)&&(digits==0)){digits=1}if(decimal==0){decimal=1}refresh()}else{if(A=="+/-"){if(exponent){Hj=-Hj}else{value=-value}refresh()}else{if(A=="C"){level=0;exponent=false;value=0;enter();refresh()}else{if(A=="="){enter();while(level>0){evalx()}refresh()}}}}}}}}}}}var totalDigits=12;var pareSize=12;var degreeRadians="degree";var value=0;var memory=0;var level=0;var entered=true;var decimal=0;var fixed=0;var exponent=false;var digits=0;var showValue="0";var isShowValue=true;function stackItem(){this.value=0;this.op=""}function array(A){this[0]=0;for(i=0;i<A;++i){this[i]=0;this[i]=new stackItem()}this.gG=A}uI=new array(pareSize);function push(B,C,A){if(level==pareSize){return false}for(i=level;i>0;--i){uI[i].value=uI[i-1].value;uI[i].op=uI[i-1].op;uI[i].vg=uI[i-1].vg}uI[0].value=B;uI[0].op=C;uI[0].vg=A;++level;return true}function pop(){if(level==0){return false}for(i=0;i<level;++i){uI[i].value=uI[i+1].value;uI[i].op=uI[i+1].op;uI[i].vg=uI[i+1].vg}--level;return true}function format(I){if(typeof (cc)!="undefined"){return };var E=""+I;if(E.indexOf("N")>=0||(I==2*I&&I==1+I)){return"Error "}var G=E.indexOf("e");if(G>=0){var A=E.substring(G+1,E.length);if(G>11){G=11}E=E.substring(0,G);if(E.indexOf(".")<0){E+="."}else{j=E.length-1;while(j>=0&&E.charAt(j)=="0"){--j}E=E.substring(0,j+1)}E+=" "+A}else{var J=false;if(I<0){I=-I;J=true}var C=Math.floor(I);var K=I-C;var D=totalDigits-(""+C).length-1;if(!entered&&fixed>0){D=fixed}var F=" 1000000000000000000".substring(1,D+2)+"";if((F=="")||(F==" ")){F=1}else{F=parseInt(F)}var B=Math.floor(K*F+0.5);C=Math.floor(Math.floor(I*F+0.5)/F);if(J){E="-"+C}else{E=""+C}var H="00000000000000"+B;H=H.substring(H.length-D,H.length);G=H.length-1;if(entered||fixed==0){while(G>=0&&H.charAt(G)=="0"){--G}H=H.substring(0,G+1)}if(G>=0){E+="."+H}}return E}function refresh(){var A=format(value);if(exponent){if(Hj<0){A+=" "+Hj}else{A+=" +"+Hj}}if(A.indexOf(".")<0&&A!="Error "){if(entered||decimal>0){A+="."}else{A+=" "}}if(""==(""+A)){document.getElementById("sciOutPut").innerHTML=" "}else{document.getElementById("sciOutPut").innerHTML=A}}function evalx(){if(level==0){return false}op=uI[0].op;Qk=uI[0].value;if(op=="+"){value=parseFloat(Qk)+value}else{if(op=="-"){value=Qk-value}else{if(op=="*"){value=Qk*value}else{if(op=="/"){value=Qk/value}else{if(op=="pow"){value=Math.pow(Qk,value)}else{if(op=="apow"){value=Math.pow(Qk,1/value)}}}}}}pop();if(op=="("){return false}return true}function popen(){enter();if(!push(0,"(",0)){value="NAN"}refresh()}function pclose(){enter();while(evalx()){}refresh()}function opt(A){enter();if(A=="+"||A=="-"){vg=1}else{if(A=="*"||A=="/"){vg=2}else{if(A=="pow"||A=="apow"){vg=3}}}if(level>0&&vg<=uI[0].vg){evalx()}if(!push(value,A,vg)){value="NAN"}refresh()}function enter(){if(exponent){value=value*Math.exp(Hj*Math.LN10)}entered=true;exponent=false;decimal=0;fixed=0}function numInput(A){if(entered){value=0;digits=0;entered=false}if(A==0&&digits==0){refresh();return }if(exponent){if(Hj<0){A=-A}if(digits<3){Hj=Hj*10+A;++digits;refresh()}return }if(value<0){A=-A}if(digits<totalDigits-1){++digits;if(decimal>0){decimal=decimal*10;value=value+(A/decimal);++fixed}else{value=value*10+A}}refresh()}function exp(){if(entered||exponent){return }exponent=true;Hj=0;digits=0;decimal=0;refresh()}function func(D){enter();if(D=="1/x"){value=1/value}if(D=="pc"){value=value/100}if(D=="qc"){value=value/1000}else{if(D=="swap"){var B=value;value=uI[0].value;uI[0].value=B}else{if(D=="n!"){if(value<0||value>200||value!=Math.round(value)){value="NAN"}else{var E=1;var A;for(A=1;A<=value;++A){E*=A}value=E}}else{if(D=="MR"){value=memory}else{if(D=="M+"){memory+=value}else{if(D=="MS"){memory=value}else{if(D=="MC"){memory=0}else{if(D=="M-"){memory-=value}else{if(D=="asin"){if(degreeRadians=="degree"){value=Math.asin(value)*180/Math.PI}else{value=Math.asin(value)}}else{if(D=="acos"){if(degreeRadians=="degree"){value=Math.acos(value)*180/Math.PI}else{value=Math.acos(value)}}else{if(D=="atan"){if(degreeRadians=="degree"){value=Math.atan(value)*180/Math.PI}else{value=Math.atan(value)}}else{if(D=="e^x"){value=Math.exp(value*Math.LN10)}else{if(D=="2^x"){value=Math.exp(value*Math.LN2)}else{if(D=="e^x"){value=Math.exp(value)}else{if(D=="x^2"){value=value*value}else{if(D=="e"){value=Math.E}else{if(D=="ex"){value=Math.pow(Math.E,value)}else{if(D=="10x"){value=Math.pow(10,value)}else{if(D=="x3"){value=value*value*value}else{if(D=="3x"){value=Math.pow(value,1/3)}else{if(D=="x2"){value=value*value}else{if(D=="sin"){if(degreeRadians=="degree"){value=Math.sin(value/180*Math.PI)}else{value=Math.sin(value)}}else{if(D=="cos"){if(degreeRadians=="degree"){var C=(value%360);if(C<0){C=C+360}if(C==90){value=0}else{if(C==270){value=0}else{value=Math.cos(value/180*Math.PI)}}}else{var C=(value*180/Math.PI)%360;if(C<0){C=C+360}if((Math.abs(C-90)<1e-10)||(Math.abs(C-270)<1e-10)){value=0}else{value=Math.cos(value)}}}else{if(D=="tan"){if(degreeRadians=="degree"){value=Math.tan(value/180*Math.PI)}else{value=Math.tan(value)}}else{if(D=="log"){value=Math.log(value)/Math.LN10}else{if(D=="log2"){value=Math.log(value)/Math.LN2}else{if(D=="ln"){value=Math.log(value)}else{if(D=="sqrt"){value=Math.sqrt(value)}else{if(D=="pi"){value=Math.PI}else{if(D=="RND"){value=Math.random()}}}}}}}}}}}}}}}}}}}}}}}}}}}}}}refresh()};
                            </script>
                            <table><tr><td id="sciout"><div><div id="sciOutPut">0</div></div><div style="padding-top:3px;width:100%"><div><span onclick="r('sin')" class="scifunc">sin</span><span onclick="r('cos')" class="scifunc">cos</span><span onclick="r('tan')" class="scifunc">tan</span><span class="scird"><label for="scirdsettingd"><input id="scirdsettingd" type="radio" name="scirdsetting" value="deg" onClick="degreeRadians='degree';" checked>Deg</label><label for="scirdsettingr"><input id="scirdsettingr" type="radio" name="scirdsetting" value="rad" onClick="degreeRadians='radians';">Rad</label></span></div><div><span onclick="r('asin')" class="scifunc">sin<sup>-1</sup></span><span onclick="r('acos')" class="scifunc">cos<sup>-1</sup></span><span onclick="r('atan')" class="scifunc">tan<sup>-1</sup></span><span onclick="r('pi')" class="scifunc">&#960;</span><span onclick="r('e')" class="scifunc">e</span></div><div><span onclick="r('pow')" class="scifunc">x<sup>y</sup></span><span onclick="r('x3')" class="scifunc">x<sup>3</sup></span><span onclick="r('x2')" class="scifunc">x<sup>2</sup></span><span onclick="r('ex')" class="scifunc">e<sup>x</sup></span><span onclick="r('10x')" class="scifunc">10<sup>x</sup></span></div><div><span onclick="r('apow')" class="scifunc"><sup>y</sup>&#8730;x</span><span onclick="r('3x')" class="scifunc"><sup>3</sup>&#8730;x</span><span onclick="r('sqrt')" class="scifunc">&#8730;x</span><span onclick="r('ln')" class="scifunc">ln</span><span onclick="r('log')" class="scifunc">log</span></div><div><span onclick="r('(')" class="scifunc">(</span><span onclick="r(')')" class="scifunc">)</span><span onclick="r('1/x')" class="scifunc">1/x</span><span onclick="r('pc')" class="scifunc">%</span><span onclick="r('n!')" class="scifunc">n!</span></div></div><div style="padding-top:3px;"><div><span onclick="r(7)" class="scinm">7</span><span onclick="r(8)" class="scinm">8</span><span onclick="r(9)" class="scinm">9</span><span onclick="r('+')" class="sciop">+</span><span onclick="r('MS')" class="sciop">MS</span></div><div><span onclick="r(4)" class="scinm">4</span><span onclick="r(5)" class="scinm">5</span><span onclick="r(6)" class="scinm">6</span><span onclick="r('-')" class="sciop">&ndash;</span><span onclick="r('M+')" class="sciop">M+</span></div><div><span onclick="r(1)" class="scinm">1</span><span onclick="r(2)" class="scinm">2</span><span onclick="r(3)" class="scinm">3</span><span onclick="r('*')" class="sciop">&#215;</span><span onclick="r('M-')" class="sciop">M-</span></div><div><span onclick="r(0)" class="scinm">0</span><span onclick="r('.')" class="scinm">.</span><span onclick="r('EXP')" class="sciop">EXP</span><span onclick="r('/')" class="sciop">&#247;</span><span onclick="r('MR')" class="sciop">MR</span></div><div><span onclick="r('+/-')" class="sciop">&#177;</span><span onclick="r('RND')" class="sciop">RND</span><span onclick="r('C')" class="scieq">C</span><span onclick="r('=')" class="scieq">=</span><span onclick="r('MC')" class="sciop">MC</span></div></div></td></tr><tr><td id="calfootnote">powered by <a href="#" rel="nofollow">calculator.net</a></td></tr></table>
                            <!--END OF SCIENTIFIC CALCULATOR CODE-->
                </div>
            
            <?php

            $sql2 = "SELECT * FROM `questions` WHERE examName='".$exam."'";

            $result = $conn->query($sql2);

            if ($result->num_rows > 0) {
                $totalQuestion = $result->num_rows;
            
                for($i=0;$i<$totalQuestion;$i++){
                    $row = $result->fetch_assoc();
                    if($id==$i){
                        $GLOBALS['currentQuestionID'] = $row["id"];
                        $GLOBALS['type'] = $row["type"];
                        $questionMarks = $row["marks"];
                        $negativeMarks = $row["negative"];
                        $questionMain = $row["question"];
                        $answer1 = $row["option1"];
                        $answer2 = $row["option2"];
                        $answer3 = $row["option3"];
                        $answer4 = $row["option4"];
                    echo "
                    <!--marks section-->
                    <div class='card rounded-0 p-1 marksSec'>
                        <strong style='color:#db8005;' >Question Type: ".$row["type"]."</strong>
                        <div style='float:right;'>
                        <label>Marks for correct answer ".$row["marks"]." | Negative marks ".$row["negative"]." </label>
                        </div>
                    </div>
                        <!--Main Question-->
                        <div class='card rounded-1 p-1 mainQues'>
                            <h5 style='margin-top:5px;'>Question Number: ".($i+1)."</h5>
                            <div class='card rounded-1 p-3' style='height:100%;  overflow-y:auto;'>
                                <h4>".$row["question"]."</h4>
                                <hr>";
                                if($row["image"]!=""){
                                    echo "<img src='img/".$row["image"]."' style='width:450px;'/>
                                    <hr>";
                                }
                                echo "
                                <div>
                                    <input type='checkbox'  id='op1' name='scales'"; if($row["type"]=="MCQ"){ echo" onchange='changed(1)'"; } echo " >
                                    <label for='scales' style='font-size: 130%;'>".$row["option1"]."</label>
                                </div>
                                <div>
                                    <input type='checkbox' id='op2' name='horns' "; if($row["type"]=="MCQ"){ echo"onchange='changed(2)'"; } echo " >
                                    <label for='horns' style='font-size: 130%;'>".$row["option2"]."</label>
                                </div>
                                <div>
                                    <input type='checkbox' id='op3' name='scales' "; if($row["type"]=="MCQ"){ echo"onchange='changed(3)'"; } echo " >
                                    <label for='scales' style='font-size: 130%;'>".$row["option3"]."</label>
                                </div>
                                <div>
                                    <input type='checkbox' id='op4' name='horns' "; if($row["type"]=="MCQ"){ echo"onchange='changed(4)'"; } echo " >
                                    <label for='horns' style='font-size: 130%;'>".$row["option4"]."</label>
                                </div>
                            </div>
                        </div>
                        <!--footer-->
                        <div class='card rounded-0 p-1 footer'>
                            <button class='btn btn-info' type='button' onClick='saveNext(1)'>
                                Mark for Review and Next
                            </button>
                            <button class='btn btn-info' type='button' onClick='clearResponce()'>
                                Clear Responce
                            </button>
                            <button class='btn btn-primary' id='saveNextBtn' type='button' style='float:right;' onClick='saveNext(2)'>
                                Save and Next
                            </button>
                        </div>
                    ";
                    }
                }
            }
  
            $sql3 = "SELECT `ans` FROM `answers` WHERE name='".$_SESSION['uname']."' AND quesId=".$GLOBALS['currentQuestionID']." AND exam='".$exam."'";
            
            $result2 = $conn->query($sql3);

            if ($result2->num_rows > 0) {
                // output data of each row
                while($row2 = $result2->fetch_assoc()) { //$row["id"]
                    $ans = $row2["ans"];
                    $str_arr = preg_split ("/\,/", $ans);
                    //print_r($str_arr); 
                    //echo sizeof($str_arr); 

                    for($k=0; $k<sizeof($str_arr); $k++){
                        if($str_arr[$k]==1){
                            echo "<script>document.getElementById('op1').checked=true;</script>";
                        }
                        if($str_arr[$k]==2){
                            echo "<script>document.getElementById('op2').checked=true;</script>";
                        }
                        if($str_arr[$k]==3){
                            echo "<script>document.getElementById('op3').checked=true;</script>";
                        }
                        if($str_arr[$k]==4){
                            echo "<script>document.getElementById('op4').checked=true;</script>";
                        }
                    }
                }
            }
        ?>
        <script>

            function changed(a){ //a is checkbox number
                if(a==1){ 
                    document.getElementById("op2").checked = false;
                    document.getElementById("op3").checked = false;
                    document.getElementById("op4").checked = false;    
                }
                else if(a==2){ 
                    document.getElementById("op1").checked = false;
                    document.getElementById("op3").checked = false;
                    document.getElementById("op4").checked = false;
                }
                else if(a==3){ 
                    document.getElementById("op2").checked = false;
                    document.getElementById("op4").checked = false;
                    document.getElementById("op1").checked = false;
                }
                else if(a==4){ 
                    document.getElementById("op2").checked = false;
                    document.getElementById("op3").checked = false;
                    document.getElementById("op1").checked = false;
                }
            }

            function saveNext(r){
            //alert("saveNext");
            var a=0; 
            var b=0;
            var c=0; 
            var d=0;
            if(document.getElementById("op1").checked){ a = 1}
            if(document.getElementById("op2").checked){ b = 1}
            if(document.getElementById("op3").checked){ c = 1}
            if(document.getElementById("op4").checked){ d = 1}
            <?php
                echo "
                window.location.href='testManage/saveAnswer.php?qid=".$GLOBALS['currentQuestionID']."&exam=".$exam."&r='+r+'&type=".$GLOBALS['type']."&0='+a+'&1='+b+'&2='+c+'&3='+d+'&total=".$totalQuestion."';
                ";
            ?>
            }
        </script>
    </div>
    <!--Side Panel-->
    <div class="sidePanel">
        <!--User Details-->
        <div class="card rounded-1 p-1 details">
            <div class="sidebar-header">
                <div class="user-pic">
                    <img class="img-responsive img-rounded userProfile" src="https://raw.githubusercontent.com/azouaoui-med/pro-sidebar-template/gh-pages/src/img/user.jpg" alt="User picture">
                </div>
                <div class="user-info">
                    <span class="user-name">
                        <strong style="margin-left: 5%;"><?php echo $_SESSION['uname'];?></strong>
                    </span><br>
                    <span class="user-role"  style="margin-left: 5%;" >Student</span>
                </div>
            </div>
            <!-- sidebar-header  -->
        </div>
         <!--Overview Panel-->
        <div class="card rounded-1 p-2 overview">
            <button class="btn btn-success navBtn " disabled>
                    <?php
                                                
                        $sqlMain = "SELECT * from answers WHERE name='".$_SESSION['uname']."' AND exam='".$exam."' AND ans!='' ";

                        $result4 = $conn->query($sqlMain);

                        $answered =  $result4->num_rows;

                        echo $answered;
                    ?>
            </button>
            <label>Answered</label><hr style="margin-top: 0.5rem; margin-bottom: 0.5rem;">
            <button class="btn btn-outline-secondary navBtn" disabled>
                    <?php
                        echo ($totalQuestion-$answered);
                    ?>
            </button>
            <label>Not Answered</label><hr style="margin-top: 0.5rem; margin-bottom: 0.5rem;">
            <button class="btn btn-warning navBtn" disabled>
                    <?php
                        echo $noOfReviewQues;
                    ?>
            </button>
            <label>Marked for Review</label><hr style="margin-top: 0.5rem; margin-bottom: 0.5rem;">
            <button class="btn btn-info navBtn " disabled>
                    <?php
                        echo $totalQuestion;
                    ?>
            </button>
            <label>Total Questions</label>
        </div>
         <!--Choose Question-->
        <div class="chooseQues card rounded-0 p-1">
            <label>Choose Question</label><br>
            <?php

            $sql5 = "SELECT * FROM `questions` WHERE examName='".$exam."'";
              
            $result5 = $conn->query($sql5);

            if ($result5->num_rows > 0) {

                //taking all question
                $j = 0;
                while($row2 = $result5->fetch_assoc()) {

                    $sql4 = "SELECT `review` FROM `answers` WHERE name='".$_SESSION['uname']."' AND exam='".$exam."' AND quesId=".$row2['id']."";
                    $result4 = $conn->query($sql4);   //matching its review
                    if($result4->num_rows > 0){
                        while($row4 = $result4->fetch_assoc()) {
                            if($row4['review']==2){
                                echo "<button type='button' class='btn btn-success navBtn' style='margin:5px;' onClick='goTo(".$j.")'> ".($j+1)." </button>";  //answered
                            }
                            else if($row4['review']==1){
                                echo "<button type='button' class='btn btn-warning navBtn' style='margin:5px;' onClick='goTo(".$j.")'> ".($j+1)." </button>"; //for review
                            }
                            else{
                                echo "<button type='button' class='btn btn-outline-secondary navBtn' style='margin:5px;' onClick='goTo(".$j.")'> ".($j+1)." </button>"; //not answered | visisted
                            }
                        }
                    }
                    else{
                        echo "<button type='button' class='btn btn-outline-secondary navBtn' style='margin:5px;' onClick='goTo(".$j.")'> ".($j+1)." </button>";
                    }

                    $j+=1;
                 }
            } 
            ?>
            
        </div>
        <!--Submit-->
        <div class="card rounded-0 p-1 submit">
            <button class="btn btn-success" type="button" onClick="finalSubmit(1)">Submit</button>
        </div>
    </div>
</div>

</body>
</html>

