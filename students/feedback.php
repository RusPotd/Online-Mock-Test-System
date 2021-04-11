<html>
<head>

<link rel="stylesheet" href="assets/css/user_feedback.css">

<script>
  function showClick(){
    alert('feedback sent successfully'); 
  }
  </script>

</head>
<body>
<form action="students/sendFeedback.php" method="post">
<div class="fake-browser">
  <div class="container">
  <div class="">
    <div class="">
      <div class="row">
        
          <div class="col-md-12">
            <h2>Feedback Form
              <button id="add-task" class="btn btn-primary float-right" type="submit" onClick="showClick()">
                Submit
              </button>
            </h2>
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" class="form-control" name="name">
            </div>
                  <div class="form-group">
              <label for="name">Email</label>
              <input type="text" class="form-control" name="email">
            </div>
                  <div class="form-group">
              <label for="name">Write Feedback</label>
              <textarea placeholder="Write Here" rows="10" class="form-control" name="feedback"></textarea>
            </div>
            <div id="drawers"></div>
          </div>
        
      </div>
    </div>
  </div>
</div>
</div>
</form>
</body>

</html>