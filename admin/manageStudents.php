<?php
//session_start();

$serverName = "localhost";
$userName = "root";
$passWord = "";
$dbName = "gatedipex";

$uname="";
$contact="";
$email="";

$conn = mysqli_connect($serverName, $userName, $passWord, $dbName);
$num = 1;

$sql = "SELECT `username`, `name`, `email`, `contact`, `password` FROM `students`";

?>

<html>
    <head>
        <script>
        function deleteStudentConfirm(){
          if(confirm("Are you sure to delete this student?")){
            return true;
          }
          else{
            return false;
            //do nothing
          }
        }

        </script>
    </head>
    <body>
    <div class="form-group col-md-12">
          <br><br><h5>All Students</h5>
          <hr><br>
          <div class="alert alert-info" role="alert">
            <table class="manageExams">
              <tr>
                <th>Id</th>
                <th>UserName</th>
                <th colspan='2'>Name</th>
                <th>Contact No</th>
                <th colspan="2">Email</th>
                <th>Action</th>
              </tr>
              <?php                              
                $result = $conn->query($sql);


                if ($result->num_rows > 0) {
                    // output data of each row
                    while($row = $result->fetch_assoc()) {
                      $uname = $row["name"];
                      $contact = $row["contact"];   //$row["id"]
                      $email = $row["email"];

                      echo "
                      <tr>
                        <td>".$num."</td>
                        <td>".$row['username']."</td>
                        <td colspan='2'>".$uname."</td>
                        <td>".$contact."</td>
                        <td colspan='2'>".$email."</td>
                        <td><a href='testManage/deleteStudent.php?name=".$row['username']."' class='btn btn-sm btn-danger mr-2' onclick='return deleteStudentConfirm();' >Remove</a></td>
                      </tr>";
                      $num+=1;
                    }
                  }

              ?>
              
            </table>

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