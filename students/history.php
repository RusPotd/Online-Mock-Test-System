<html>
    <head>
        <style>

        </style>
    </head>
    <body>
    <div class="form-group col-md-12">
          <br><br><h5>History</h5>
          <hr><br>

          <div class="alert alert-warning" role="alert">
            <table class="manageExams">
              <tr>
                <th>Exam Name</th>
                <th>Your Score</th>
                <th>Rank</th>
                <th>View Result</th>
              </tr>
              <?php

              $sql = "SELECT `name`, `exam`, `score`, `total` FROM `rank` WHERE name='".$_SESSION['uname']."'";

              $result = $conn->query($sql);

              if ($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()){

                    $sql2 = "SELECT * FROM `rank` WHERE exam='".$row['exam']."' ORDER BY score DESC";

                    $result2 = $conn->query($sql2);
                    $totalUsers=0;
                    $rankCounter=1;
                    if ($result2->num_rows > 0) {
                        $totalUsers = $result2->num_rows;
                        while($row2 = $result2->fetch_assoc()){

                          if($row2['name']==$row['name']){
                            break;
                          }
                          $rankCounter+=1;
                        }
                    }

                    echo"
                    <tr>
                      <td>".$row['exam']."</td>
                      <td><strong>".$row['score']."</strong> <label style='opacity:0.7;'>out of ".$row['total']."</label></td>

                      ";

                      $sql3 = "SELECT * FROM `exams` WHERE name='".$row['exam']."'";

                      $result3 = $conn->query($sql3);

                      if ($result3->num_rows > 0) {
                          while($row3 = $result3->fetch_assoc()){
                            if($row3['result']==1){
                              echo"
                                <td><strong>".$rankCounter."</strong> <label style='opacity:0.7;'>out of ".$totalUsers."</label></a></td>
                                <td class='fa fa-eye' style='margin-left:35%;' onClick=window.location.href='welcome.php?page=viewResult&exam=".str_replace(" ","_",$row['exam'])."&name=".$_SESSION['uname']."'></td>
                              </tr>
                            ";
                            }
                            else{
                              echo"
                                <td><label style='opacity:0.7;'>In Progress...</label></a></td>
                                <td style='opacity:0.7;'>In Progress...</td>
                              </tr>
                            ";
                            }

                          }
                      }

                    
                  }
              }
              ?>

            </table>

            <!--<a href="https://azouaoui-med.github.io/react-pro-sidebar" target="_blank" class="btn btn-sm btn-success">
              Demo</a>-->
          </div>
        </div>

        <!-- using online scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
        integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js"
        integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous">
    </script>
    <script src="//malihu.github.io/custom-scrollbar/jquery.mCustomScrollbar.concat.min.js"></script>
    </body>
</html>