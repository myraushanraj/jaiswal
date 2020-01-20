		
<!DOCTYPE html>
<html lang="en" class="js csstransitions">

<head>
    <title>Bus Ticket Reservation System</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="assets/css/normalize.css" />
    <style>
    #signin{
        width: 400px;
    margin: auto;
    background: red;
    padding: 40px 100px;
    margin-top: 190px;
    }
    #signin input,#signin label{
        width:100%;
    }
    #signin input{
    border-radius: 3px;
    width: 100%;
    border: none;
    height: 37px;
    padding-left: 3px;
    margin-bottom: 12px;
    }
    .submit-btn{
        background:blue;
        color:#fff;
    }
    body{
        background: #ffc107;
    }
    </style>
   
<body>

<?php
	session_start();

	include_once 'dbconnect.php';
	include 'adminfunction.php';
?>
	
	<div id="signin">
		<h1>Jaiswal Admin Dashboard</h1>
                <form role="form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" name="loginform" class="signin-form">
                    <div class="input-container">
                    <label for="signinEmail" class="floating">Email</label>
                        <input type="email" name="signinEmail" placeholder="Email" class="input-field" id="signinEmail" autocomplete="off" required>
                      
                        <div class="input-field-shadow"></div>
                    </div>
                    <div class="input-container">
                    <label for="signinPassword" class="floating">Password</label>
                        <input type="password" name="signinPassword" placeholder="Password" class="input-field" id="signinPassword" required>
                      
                        <div class="input-field-shadow"></div>
                    </div>
                    <br>
                    <div class="submit-container">
                        <input type="submit" name="submit-signin" value="Sign In" class="submit-btn">
                        <div class="submit-btn-shadow"></div>
                    </div>
                    <span class="text-danger"><?php if (isset($signinErrormsg)) { echo $signinErrormsg; } ?></span>
                </form>
<!--
                <footer class="forget-footer">
                    <div class="signin-forget"> <a href="#" id="forget-button">Forget Your Password ?</a> </div>
                    <div class="create-account"> <a href="#" id="create-button">Create New Account</a> </div>
                </footer>
-->
            </div>
	        
	
	</body>
	</html>
	