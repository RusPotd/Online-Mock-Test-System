<html>
    <head>
        <style>
            .loadQuestionClaass{
                float:left;
                width:42%;
                margin-right: 3%;
                margin-top: 1%;
            }
        </style>
    </head>
    <body>
            <?php

            $serverName = "localhost";
            $userName = "root";
            $passWord = "";
            $dbName = "gatedipex";

            $num = 1;

            $conn = mysqli_connect($serverName, $userName, $passWord, $dbName);

            $exam = $_SESSION['examName'];

            $sql = "SELECT * FROM `questions` WHERE examName='".$exam."' ORDER BY id DESC;";

            if($set==1){  
                $result = $conn->query($sql);
                $num = $result->num_rows;
                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) { //$row["id"]
                    
                        echo "
                            <fieldset class='card card-body loadQuestionClaass'>
                                <table class='table'>
                                    <tr>
                                        <td><strong style='margin-right:10px;'>".$num.") </strong></td>
                                        <td><label class='btn btn-sm btn-warning mr-2' style='float:right;' onclick=window.location.href='testManage/deleteQuestion.php?id=".$row['id']."&exam=".str_replace(' ', '_', $row['examName'])."' >Delete Q. ".$num."</label></td>
                                     </tr>
                                    <tr>
                                        <td><label style='margin-right:10px;'><strong>Question Type : </strong>".$row["type"]."</label></td>
                                    </tr><br>
                                    <tr>
                                        <td><label style='margin-right:10px;'><strong>Marks : ".$row["marks"]."</strong></label></td>
                                        <td><label style='margin-right:10px;'><strong>Negative Marks : ".$row["negative"]."</strong></label></td>
                                    </tr>
                                    <tr><td colspan=2>
                                    <fieldset style='overflow-y: auto; height:80px;'>
                                        <label><strong>Question : </strong>".$row["question"]."</label>
                                    </fieldset></td></tr>
                                    ";
                                    if($row['image']!=""){
                                        echo "<tr><td colspan=2><a class='fa fa-eye' style='height:auto; width:100%;' target='_blank' href='img/".$row['image']."'> Click Here to preview uploaded Image</td></tr>";
                                    }
                                    else{
                                        echo "<tr><td colspan=2>No Image Uploaded!</td></tr>";
                                    }
                                    echo "
                                    <tr><td colspan=2><label>1) ".$row["option1"]."</label></td></tr>
                                    <tr><td colspan=2><label>2) ".$row["option2"]."</label></td></tr>
                                    <tr><td colspan=2><label>3) ".$row["option3"]."</label></td></tr>
                                    <tr><td colspan=2><label>4) ".$row["option4"]."</label></td></tr>
                                    <tr><td colspan=2><label><strong>True Answer Option: </strong>".$row["original"]."</label></td></tr>
                                    </table>
                            </fieldset>
                        ";
                        $num-=1;

                    }
                }
            }
            ?>
    </body>
    
</html>