<?php
session_start();

$serverName = "localhost";
            $userName = "root";
            $passWord = "";
            $dbName = "gatedipex";

            $uname="";
            $pass="";

            $conn = mysqli_connect($serverName, $userName, $passWord, $dbName);

            $sql = "SELECT * FROM `exams` WHERE active=1";

            #echo $sql;

$result = $conn->query($sql);

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

    <link rel="stylesheet" href="assets/css/welcome.css">

<script>
  
function SetActive(a){
  if(a==1){
    window.location.href="welcome.php?page=students/history";
  }
  else if(a==0){
    window.location.href="welcome.php?page=home";
  }
  else if(a==3){
    window.location.href="welcome.php?page=students/feedback";
  }
}
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
        <a href="#">DIPEX MOCK Test</a>
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
            <strong><?php echo $_SESSION['uname']; ?></strong>
          </span>
          <span class="user-role">Student</span>
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
            <a href="#">
              <i class="fa fa-tachometer-alt"></i>
              <span>Dashboard</span>
              <!--<span class="badge badge-pill badge-warning">New</span>-->
            </a>
          </li>
          <li onClick="SetActive(1);">
            <a href="#">
              <i class="fa fa-history"></i>
              <span>History</span>
              <!--<span class="badge badge-pill badge-danger">3</span>-->
            </a>
          </li>
          <li  onClick="SetActive(3);">
            <a href="#">
              <i class="fa fa-edit"></i>
              <span>Feedback</span>
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
      <h2>Students Dashboard</h2>
      <hr>
      <div class="row">
        <div class="form-group col-md-12">
          <h5>Overall Stats</h5>
        </div>
        <section class="statistics">
          <div class="container-fluid">
            <div style="width:100%;">
              <div style="margin:0px 10px; float:left;">
                <div class="box">
                  <i class="fa fa-envelope fa-fw bg-primary"></i>
                  <div class="info">
                    <h3><?php  //tests attended
                         $sql11 = "SELECT `name` FROM `rank` WHERE name='".$_SESSION['uname']."'";
                         $result11 = $conn->query($sql11);   
                         echo $result11->num_rows; 
                         
                    ?></h3> <span>Tests Attainded</span>
                  </div>
                </div>
              </div>
              <div style="margin:0px 10px; float:left;">
                <div class="box">
                  <i class="fa fa-file fa-fw danger"></i>
                  <div class="info">
                    <h3><?php echo $result->num_rows; ?></h3> <span>Total Tests</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

      </div>    
      <br>
      <h5>Running Exams</h5>
      <hr>
      <div class="row">
        <?php
            if ($result->num_rows > 0) {
              $numofvisibleTests=0;
                // output data of each row
                while($row = $result->fetch_assoc()) { //$row["id"]
                  
                  if($row['active']==0){
                    ++$numofvisibleTests;
                    continue;
                  }

                  $sqlStart = "SELECT EXISTS(SELECT `id`, `name`, `exam`, `start`, `end`, `finish` FROM `time` WHERE name='".$_SESSION['uname']."' AND exam='".$row["name"]."')";

                  $resultStart = $conn->query($sqlStart);
      
                  if ($resultStart->num_rows > 0) {
                      // output data of each row
                      while($rowStart = $resultStart->fetch_row()) { 
                          if($rowStart[0]==1){
                              //exists do nothing
                              $sqlFinish = "SELECT `end`, `finish` FROM `time` WHERE name='".$_SESSION['uname']."' AND exam='".$row["name"]."'";

                              $resultFinish = $conn->query($sqlFinish);
                  
                              if ($resultFinish->num_rows > 0) {
                                  // output data of each row
                                  while($rowFinish = $resultFinish->fetch_assoc()) { 
                                    if($rowFinish['finish']==0){

                                      echo "
                                      <script>
                                        // Set the date we're counting down to
                                        var countDownDate = 1;
                                        var minRemaining = 0;
                                        var secRemaining = 0;
                                       
                                        ";
                                            $totalSec = strtotime($rowFinish['end']) - strtotime(date('Y-m-d H:i:s'));
                                            $minLeft = floor($totalSec/60);
                                            $secLeft = $totalSec%60;
                                            echo "minRemaining = ".$minLeft.";";
                                            echo "secRemaining = ".$secLeft.";";
     
                                        echo "
                                        // Update the count down every 1 second
                                        var x = setInterval(function() {
                    
                                        document.getElementById('remainingTimeShow').innerHTML = minRemaining+':'+secRemaining;
                                        secRemaining-=1;
                                        if(minRemaining>0 && secRemaining<=0 ){
                                            minRemaining-=1;
                                            secRemaining=60;
                                        }
                                        if(minRemaining<=0 && secRemaining<=0){
                                          clearInterval(x);
                                          window.location.href='welcome.php?page=viewResult&exam=".$row["name"]."&name=".$_SESSION['uname']."';
                                        }
                                        }, 1000);
                                    </script>
                                      ";
                            
                                        echo "
                                        <div class='col-xs-6 col-sm-3 col-md-3 col-lg-3'>
                                          <div class='card rounded-0 p-0 shadow-sm'>
                                            <img src='https://user-images.githubusercontent.com/25878302/58369568-a49b2480-7efc-11e9-9ca9-2be44afacda1.png' class='card-img-top rounded-0' alt='Angular pro sidebar'>
                                            <div class='card-body text-center'>
                                              <h6 class='card-title'>".$row["name"]."</h6>
                                              <a href='start_test.php?test=".$row["name"]."&id=0&r=1' class='btn btn-primary btn-sm'>Resume Test</a>
                                              <hr>
                                              <p><strong>Questions:</strong> ".$row["marks"]."  <strong>Time Left:</strong> <label id='remainingTimeShow' /></p>
                                            </div>
                                          </div>
                                        </div>
                                      ";
                                    }
                                    else{
                                      ++$numofvisibleTests;
                                    }
                                  }
                              }
                          }
                          else{
                            echo "<script>
                              function checkRunning(){
                            "; 
                              if(isset($_SESSION['examStarted'])){
                                echo "var isExamStarted = 1";
                              }
                              else{
                                echo "var isExamStarted = 0";
                              }
                            echo "
                                if(isExamStarted==0){
                                  return true;
                                }
                                else{
                                  alert('Looks like there is running exam, wait until it finishes');
                                  return false;
                                }
                              }
                            </script>
                            ";
                            echo "
                              <div class='col-xs-6 col-sm-3 col-md-3 col-lg-3'>
                                <div class='card rounded-0 p-0 shadow-sm'>
                                  <img src='https://user-images.githubusercontent.com/25878302/58369568-a49b2480-7efc-11e9-9ca9-2be44afacda1.png' class='card-img-top rounded-0' alt='Angular pro sidebar'>
                                  <div class='card-body text-center'>
                                    <h6 class='card-title'>".$row["name"]."</h6>
                                    <a class='btn btn-primary btn-sm' style='color:white;' href='start_test.php?test=".$row["name"]."&id=0&r=0' onclick='return checkRunning();'>Start Test</a>
                                    <hr>
                                    <p><strong>Questions:</strong> ".$row["marks"]."  <strong>Time:</strong> ".$row["time"]."</p>
                                  </div>
                                </div>
                              </div>
                            ";
                          }
                        }
                  }
                }
                if($result->num_rows == $numofvisibleTests){
                  echo "<h6 style='margin-left:20px;'> No More Running Exams </h6>";
                }
              }
        ?>

      </div>
      <hr>
      
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
$(".sidebar-dropdown > a").click(function() {
  $(".sidebar-submenu").slideUp(200);
  if (
    $(this)
      .parent()
      .hasClass("active")
  ) {
    $(".sidebar-dropdown").removeClass("active");
    $(this)
      .parent()
      .removeClass("active");
  } else {
    $(".sidebar-dropdown").removeClass("active");
    $(this)
      .next(".sidebar-submenu")
      .slideDown(200);
    $(this)
      .parent()
      .addClass("active");
  }
});

$("#close-sidebar").click(function() {
  $(".page-wrapper").removeClass("toggled");
});
$("#show-sidebar").click(function() {
  $(".page-wrapper").addClass("toggled");
});


</script>
</body>
</html>