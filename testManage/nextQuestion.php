
<html>
<head>
<?php
    if (isset($_POST['uploadImage'])) {
        $image = $_FILES['image']['name'];

        // image file directory
        $target = "img/".basename($image);

        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            //image uploaded success
            //echo "<script>alert('Image uploaded successfully');</script>";
        }else{
            //image upload failed
            //echo "<script>alert('Failed to upload');</script>"; 
        }

        $exam =  $_SESSION['examName'];
        $type =  $_POST['type'];
        $questionMarks =  $_POST['questionMarks'];
        $negativeMarks =  $_POST['negativeMarks'];
        $questionMain =  $_POST['questionMain'];
        $answer1 =  $_POST['answer1'];
        $answer2 =  $_POST['answer2'];
        $answer3 =  $_POST['answer3'];
        $answer4 =  $_POST['answer4'];
        $answerMain =  $_POST['answerMain'];
          
        $serverName = "localhost";
        $userName = "root";
        $passWord = "";
        $dbName = "gatedipex";
    
        $conn = mysqli_connect($serverName, $userName, $passWord, $dbName);
    
        $sql = "INSERT INTO `questions`(`examName`, `type`, `marks`, `negative`, `question`, `image`, `option1`, `option2`, `option3`, `option4`, `original`) VALUES ('".$exam."','".$type."',".$questionMarks.",".$negativeMarks.",'".$questionMain."','".$image."','".$answer1."','".$answer2."','".$answer3."','".$answer4."','".$answerMain."')";
    
        $conn->query($sql); 
    }

?>
<script>
    function finalSubmitTest(){
        if(confirm("After final submit you cannot add more questions or edit Exam!\nIf you want to add more questions then Click 'Cancel' & Go to 'Save and Add Next Question' Or Cick OK to proceed")){
        <?php
            echo "window.location.href='testManage/setTestActive.php?exam=".$_SESSION['examName']."&v=1';";
            ?>
        }
        else{
            //do nothing
        }
    }

    function insertImage(){
        document.getElementById("demo").innerHTML  = "Image uploaded successfully";
    }

</script>
<style>
    .nextQuesionClass{
        z-index:1;
        height:34.1%;
        margin-left: 52%;
    }
</style>
</head>
<body>
<form action="<?php echo "welcome_admin.php?page=admin/addExam&set=1&exam=".$_SESSION['examName']; ?>" method="post" enctype="multipart/form-data">
                <fieldset class="card rounded-2 p-4 shadow-sm nextQuesionClass" style="width:35%;">
                    <table class="table">
                        <tr>
                            <td><label>Question Type</label></td>
                            <td><select id="type" name="type">
                            <option value="MCQ">MCQ</option>
                            <option value="MSQ">MSQ</option>
                            </select></td>
                        </tr>
                        <tr>
                            <td><label style="margin-right:10px;">Marks</label></td>
                            <td><input id="questionMarks" name="questionMarks" placeholder="4" required><br></td>
                        </tr>
                        <tr>
                            <td><label style="margin-right:10px;">Negative Marks</label></td>
                            <td><input id="negativeMarks" name="negativeMarks" placeholder="1 (do not write '-' sign)" required></td>
                        </tr>
                    </table>
                </fieldset>
                <fieldset class="card rounded-2 p-4 shadow-sm" style="width:87%; margin-top:5px;">
                    <table class="table">
                    <input type="file" name="image">
                        <tr><td colspan=2><fieldset>
                            <textarea id="questionMain" name="questionMain" placeholder="Question" name="paragraph_text" cols="115" rows="5"></textarea>
                        </fieldset></td></tr><br>
                        <tr><td><input id="answer1" name="answer1" placeholder="Option  1" type="text" style="width:100%;" required></td>
                        <td><input id="answer2" name="answer2" placeholder="Option  2" type="text" style="width:100%;" required></td></tr>
                        <tr><td><input id="answer3" name="answer3" placeholder="Option  3" type="text" style="width:100%;" required></td>
                        <td><input id="answer4" name="answer4" placeholder="Option  4" type="text" style="width:100%;" required></td></tr>
                        <tr><td colspan=2><input id="answerMain" name="answerMain" placeholder="Correct Answer Options (e.g 1,2,3,4) / use (,) for MSQ"  type="text" style="width:100%;" required></td></tr>
                        <tr><td><fieldset class=""> <!--saveNext()-->
                            <button class='btn btn-success btn-block' type="submit" name="uploadImage">  Save and Add Next Question</button>
                        </fieldset></td>
                        <td ><fieldset>
                            <button name="submit" class="btn btn-primary btn-block" id="contact-submit" onClick="finalSubmitTest()">Final Submit</button>
                        </fieldset></td></tr>
                    </table>
                </fieldset>
        </form>     
                    
</body>
</html>