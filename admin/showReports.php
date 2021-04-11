<?php

$serverName = "localhost";
$userName = "root";
$passWord = "";
$dbName = "gatedipex";

$fullName="";
$report="";
$email="";

$conn = mysqli_connect($serverName, $userName, $passWord, $dbName);
$num = 1;

$sql = "SELECT `username`, `name`, `email`, `report` FROM `reports`";

?>
<html>
    <head>
        <style>

        </style>
    </head>
    <body>
    <div class="form-group col-md-12">
          <br><br><h5>Reports</h5>
          <hr><br>
         
          <div class="alert alert-danger" role="alert">
            <table class="manageExams">
              <tr>
                <th>ID</th>
                <th>Name</th>
                <th colspan='2'>Email</th>
                <th colspan="3">Report</th>
              </tr>
              <?php
               $result = $conn->query($sql);


               if ($result->num_rows > 0) {
                   // output data of each row
                   while($row = $result->fetch_assoc()) {
                     $fullName = $row["name"];
                     $report = $row["report"];   //$row["id"]
                     $email = $row["email"];
              echo "
                <tr>
                  <td>".$num."</td>
                  <td>".$fullName."</td>
                  <td colspan='2'>".$email."</td>
                  <td colspan='3'>".$report."</td>
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
    </body>
</html>