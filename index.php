<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Untitled</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/fonts/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/styles.css">

    <script>

        function checkLogin(){
            if(document.getElementById('login_password').value.trim().length <=0 || document.getElementById('login_username').value.trim().length <=0 ){
                alert("Required Areas can't be Blank!!");
                return false;
            }
            else{
                return true;
            }
        }

        function checkPass(){

            if(document.getElementById('login_password-1').value == document.getElementById('login_password-2').value){
                if(document.getElementById('login_password-1').value.trim().length <=0 || document.getElementById('login_password-r').value.trim().length <=0 || document.getElementById('login_username-1').value.trim().length <=0 || document.getElementById('login_username-r').value.trim().length <=0 || document.getElementById('login_fullname-r').value.trim().length <=0){
                    alert('Please fill the required Areas!!');
                    return false;
                }
                else{
                    if(document.getElementById('login_username-r').value.indexOf(' ') > 0){
                        alert('username must not contain white spaces!!');
                        return false;
                    }
                    else{
                        return true;
                    }
                }
                
            }   
            else{  
                alert('Password and Re-Entered Password doesnt match!!');
                return false;
            }
        
        }
    </script>

</head>

<body class="my-2">
    <div class="col-12 col-lg-8 offset-lg-2">
        <div class="row m-0 shadow-lg" id="signin">
            <div class="col-12 col-lg-12"><i class="fa fa-close pull-right p-2"></i></div>
            <div class="col-lg-10 offset-lg-1">
                <div class="row bg-white rounded-lg">
                    <div class="col-12 col-lg-7 text-center border-right mb-3">
                        <h3>Participate in one of biggest Mock Test for&nbsp;</h3>
                        <h2><strong>GATE 2021</strong>&nbsp;</h2>
                        <h3>&amp; know your level among others...</h3><img src="assets/img/img_component1_7.jpg" style="width: 60%;"></div>
                    <div class="col-12 col-lg-5" id="log_in">
                        <form action="control.php?l=1" id="loginForm" method="post" onsubmit="return checkLogin()">
                            <div class="row m-0">
                                <div class="col-10 col-lg-10 offset-1 offset-lg-1 text-right mt-3">
                                    <input type="text" id="login_username" name='uname' class="w-100 mb-3" placeholder="User Name" required>
                                    <input type="password" id="login_password" name='pass'class="w-100 mb-3" placeholder="Password" required>
                                </div>
                                <div class="col-lg-10 offset-lg-1 text-center py-2">
                                    <button class="btn btn-success w-100" id="btn_login" type="submit"">Log in<i class="fa fa-check ml-2"></i></button>
                                </div>
                                <div class="col-10 col-lg-10 offset-1 offset-lg-1 p-2"></div>
                                <div class="col-lg-10 offset-lg-1 p-3 border-top"><a class="text-danger" >Don't have an account ?</a>
                                    <button class="btn btn-primary w-100 mt-2" id="btn_register" type="button">Register<i class="fa fa-chevron-right ml-2"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-5 hide" id="register">
                        <form action="control.php?l=0" id="registerForm" method="post" onsubmit="return checkPass()">
                            <div class="row">
                                <div class="col-lg-10 offset-lg-1 text-right mt-3">
                                    <input type="text" id="login_username-r" name='uname_r' class="w-100 mb-3" placeholder="Enter Username" required>
                                    <input type="text" id="login_fullname-r" name='fullname_r' class="w-100 mb-3" placeholder="Enter Full-Name" required>
                                    <input type="text" id="login_username-1" name='email_r' class="w-100 mb-3" placeholder="Enter Email" required>
                                    <input type="text" id="login_password-r" name='contact_r' class="w-100 mb-3" placeholder="Enter Contact no." required>
                                    <input type="password" id="login_password-2" name='pass_r' class="w-100 mb-3" placeholder="Password" required>
                                    <input type="password" id="login_password-1" class="w-100 mb-3" placeholder="Re-Enter Password"></div required> 
                                <div class="col-6 col-lg-10 offset-lg-1 text-center py-2">
                                    <button class="btn btn-secondary w-100" id="close_register" type="button">&nbsp;<i class="fa fa-mail-forward mr-2"></i>Log In</button>
                                </div>
                                <div class="col-6 col-lg-10 offset-lg-1 text-center py-2">
                                    <button class="btn btn-success w-100" id="btn_login" type="submit">Register</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/register.js"></script>
</body>

</html>