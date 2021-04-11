<?php
session_start();
$activeSession = 0;
?>
<html>
<head>
<!-- using online links -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css"
        integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
        integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <link rel="stylesheet" href="//malihu.github.io/custom-scrollbar/jquery.mCustomScrollbar.min.css">
    <link rel="shortcut icon" type="image/png" href="img/favicon.png" />

    <link rel="stylesheet" href="assets/css/welcome_admin.css">

<script type="text/javascript">
function MyDashbooard(){
  document.location.href = "admin/admin_dashboard.php";
}

function deleteTest(){
  if(confirm("Are you sure to delete? Deleting exam may also effect to users who are giving/given this exam!")){
    return true;
  }
  else{
    return false;
    //do nothing
  }
}

function SetActive(a){
  if(a==1){
    window.location.href="welcome_admin.php?page=admin/manageStudents";
  }
  else if(a==0){
    window.location.href="welcome_admin.php?page=home";
  }
  else if(a==3){
    window.location.href="welcome_admin.php?page=admin/addExam&set=0&exam=0";
  }
  else if(a==4){
    window.location.href="welcome_admin.php?page=admin/showRank&row=1";
  }
  else if(a==5){
    window.location.href="welcome_admin.php?page=admin/showReports";
  }
}

var totalTests = 0;
var activeTests = 0;

</script>

</head>
<body>

<div class="page-wrapper chiller-theme toggled">
  <a id="show-sidebar" class="btn btn-sm btn-dark" href="#">
    <i class="fas fa-bars"></i>
  </a>
  <nav id="sidebar" class="sidebar-wrapper">
    <div class="sidebar-content">
      <div class="sidebar-brand">
        <a href="#">DIPEX MOCK TEST</a>
        <div id="close-sidebar">
          <i class="fas fa-times"></i>
        </div>
      </div>
      <div class="sidebar-header">
        <div class="user-pic">
          <img class="img-responsive img-rounded" src="https://raw.githubusercontent.com/azouaoui-med/pro-sidebar-template/gh-pages/src/img/user.jpg" alt="User picture">
        </div>
        <div class="user-info">
          <span class="user-name">
          <strong><?php echo $_SESSION['uname'];?></strong>
          </span>
          <span class="user-role">Administrator</span>
          <span class="user-status">
            <i class="fa fa-circle"></i>
            <span>Online</span>
          </span>
        </div>
      </div>
      <!-- sidebar-header  -->
     
      <div class="sidebar-menu">
        <ul>
          <li class="header-menu">
            <span>General</span>
          </li>
          <li onClick="SetActive(0);">
            <a href="#" >
              <i class="fa fa-tachometer-alt"></i>
              <span>Dashboard</span>
              <!--<span class="badge badge-pill badge-warning">New</span>-->
            </a>
          </li>
          <li onClick="SetActive(1);">
            <a href="#">
              <i class="fas fa-user-edit"></i>
              <span>Manage Students</span>
            </a>
          </li>
          <li onClick="SetActive(3);">
            <a href="#">
              <i class="fa fa-book"></i>
              <span>Add Exam</span>
            </a>
          </li>
          <li onClick="SetActive(4);">
            <a href="#">
              <i class="fa fa-chart-line"></i>
              <span>Ranking</span>
            </a>
          </li>
          <li  onClick="SetActive(5);">
            <a href="#">
              <i class="fa fa-exclamation-triangle"></i>
              <span>Reports</span>
            </a>
          </li>
        </ul>
      </div>
      <!-- sidebar-menu  -->
    </div>
    <!-- sidebar-content  -->
    <div class="sidebar-footer">
      <a href="logout.php">
        <i class="fa fa-power-off"> Log Out</i>
      </a>
    </div>
  </nav>
  <!-- sidebar-wrapper  -->
  <main class="page-content">
    <div class="container">
      <?php 
      if($_GET['page'] && $_GET['page']!='home'){
        $page=$_GET['page'];
        $display=$page.'.php';
        include($display);
      }
      else{
        ?>
      <h2>Admin Panel</h2>
      <hr>
      <div class="row">
        <?php
            $serverName = "localhost";
            $userName = "root";
            $passWord = "";
            $dbName = "gatedipex";

            $conn = mysqli_connect($serverName, $userName, $passWord, $dbName);

            $sql = "SELECT `id`, `name`, `time`, `marks` FROM `exams` WHERE 1";
           
            $result = $conn->query($sql);

            $num=1;
            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {}
            }
        ?>
        <section class="statistics">
          <div class="container-fluid">
            <div style="width:100%;">
              <div style="margin:0px 10px; float:left;">
                <div class="box">
                  <i class="fa fa-envelope fa-fw bg-primary"></i>
                  <div class="info">
                    <h3><label><?php
                      $sql10 = "SELECT * FROM `students`";
               
                      $result10 = $conn->query($sql10);
                      echo $result10->num_rows;

                    ?></h3></label><span>Total Students</span>
                  </div>
                </div>
              </div>
              <div style="margin:0px 10px; float:left;">
                <div class="box">
                  <i class="fa fa-file fa-fw danger"></i>
                  <div class="info">
                    <h3><label id="totalTests" /></h3> <span>Total Tests</span>
                  </div>
                </div>
              </div>
              <div style="margin:0px 10px; float:left;">
                <div class="box">
                  <i class="fa fa-users fa-fw success"></i>
                  <div class="info">
                    <h3><label id="activeTests" /></h3> <span>Running Test</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        

        
        <div class="form-group col-md-12">
          <br><br><h5>Tests</h5>
          <hr><br>
          <div class="alert alert-success" role="alert">
            <table class="manageExams">
              <tr>
                <th>Sr.</th>
                <th>Name</th>
                <th>Total Questions</th>
                <th>Total Marks</th>
                <th>Time (min)</th>
                <th>Status</th>
                <th>Action</th>
                <th>Display Result</th>
                <th>Delete</th>
              </tr>
              <?php

                $sql = "SELECT * FROM `exams` WHERE 1";
               
                $result = $conn->query($sql);

                $num=1;
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {

                      echo "<script>totalTests+=1;</script>";

                      $sql2 = "SELECT `examName` FROM `questions` WHERE examName='".$row['name']."'";
               
                      $numofquestions = $conn->query($sql2);

                      echo "
                        <tr>
                          <td>".$num++."</td>
                          <td>".$row['name']."</td>
                          <td>".$numofquestions->num_rows."</td>
                          <td>".$row['marks']."</td>
                          <td>".$row['time']."</td>";

                          if($row['active']==1){
                              echo "<script>activeTests+=1;</script>";
                              echo "<td class='alert-heading'>Active</td>
                              <td><a href='testManage/setTestActive.php?exam=".$row['name']."&v=0' class='btn btn-sm btn-success mr-2'>Disable</a></td>   <!--btn-danger-->
                              ";
                          }
                          else{
                            echo "<td class='alert-heading'>Inactive</td>
                            <td><a href='testManage/setTestActive.php?exam=".$row['name']."&v=1' class='btn btn-sm btn-danger mr-2'>Enable</a></td>   <!--btn-danger-->
                            ";
                          }

                          if($row['result']==0){
                            echo"
                            <td><a href='testManage/setShowResult.php?exam=".$row['name']."&v=1' class='btn btn-sm btn-danger mr-2'>Show</a></td>   <!--btn-danger-->
                            ";
                          }
                          else{
                            echo"
                            <td><a href='testManage/setShowResult.php?exam=".$row['name']."&v=0' class='btn btn-sm btn-success mr-2'>Hide</a></td>   <!--btn-danger-->
                            ";
                          }
                          
                          echo"
                          <td><a class='fas fa-trash-alt' style='margin-left:40%;' href='testManage/deleteTest.php?exam=".str_replace(' ', '_', $row['name'])."' onclick='return deleteTest();'></a></td>
                          </tr>
                          ";
                          
                          
                    }
                }
              ?>
            
            </table>

            <!--<a href="https://azouaoui-med.github.io/react-pro-sidebar" target="_blank" class="btn btn-sm btn-success">
              Demo</a>-->
          </div>
        </div>
      </div>
      <?php } 
      ?>
    </div>

  </main>
  <!-- page-content" -->
</div>
<!-- page-wrapper -->

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

document.getElementById("totalTests").innerHTML  = totalTests;
document.getElementById("activeTests").innerHTML = activeTests;

$("#close-sidebar").click(function() {
  $(".page-wrapper").removeClass("toggled");
});
$("#show-sidebar").click(function() {
  $(".page-wrapper").addClass("toggled");
});

</script>
</body>
</html>