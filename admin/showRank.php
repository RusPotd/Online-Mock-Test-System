<html>
    <head>
      
    </head>
    <body>
    <div class="form-group col-md-12">
          <br><br><h5>Ranking</h5>
          <hr><br>
          <label for="type"  style="margin-right:10px;">Choose Exam:</label>
            <select id="type" onchange="changeFunc();">

            <?php
              $index = $_GET['row'];
              echo $index;

              $serverName = "localhost";
              $userName = "root";
              $passWord = "";
              $dbName = "gatedipex";

              $examName = "";
              
              $uname="";
              $contact="";
              $email="";
              
              $conn = mysqli_connect($serverName, $userName, $passWord, $dbName);
              $num = 1;
              
              $sql = "SELECT * FROM `exams`";
              $result = $conn->query($sql);
              
              if ($result->num_rows > 0) {
                // output data of each row
                while($row = $result->fetch_assoc()) {
                  echo "<option value='".$num."' "; 
                    if($num==$index){
                      echo "selected";
                      $examName = $row['name'];
                    }
                  echo " >".$row['name']."</option>";
                  $num+=1;
                }
              }
              
            ?> 
            </select>

          <br><br>
          <div class="alert alert-warning" role="alert">
            <table class="manageExams">
              <tr>
                <th>Rank</th>
                <th>UserName</th>
                <th>Full Name</th>
                <th>Marks</th>
                <th>View Result</th>
              </tr>
              <?php
                  $sql = "SELECT * FROM `rank` WHERE exam='".$examName."' ORDER BY score DESC ";
                  $result = $conn->query($sql);
                  $num = 1;
                  if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                      $fullName="";
                      $sql8 = "SELECT `name` FROM `students` WHERE username='".$row['name']."'";
                      $result8 = $conn->query($sql8);
                      if ($result8->num_rows > 0) {
                        while($row8 = $result8->fetch_assoc()) {
                            $fullName = $row8['name'];
                        }
                      }

                      echo"
                      <tr>
                        <td>".$num."</td>
                        <td>".$row['name']."</td>
                        <td>".$fullName."</td>
                        <td>".$row['score']."/".$row['total']."</td>
                        <td class='fa fa-eye' style='margin-left:35%;' onclick=window.location.href='welcome_admin.php?page=viewResult&exam=".str_replace(' ', '_', $examName)."&name=".$row['name']."'></td>
                      </tr>
                      ";   
                      $num+=1; 
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
    <script>
        function changeFunc() {
          var selectBox = document.getElementById("type");
          var selectedValue = selectBox.options[selectBox.selectedIndex].value;
          //alert(selectedValue);
          window.location.href="welcome_admin.php?page=admin/showRank&row="+selectedValue;
        }
    </script>
    </body>
</html>