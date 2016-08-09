<?php
require_once(__DIR__.'/website-files/initialize.php');
//ob_start(); //from stack overflow
include 'pass.php';
error_reporting(E_ALL);
ini_set('display_errors','On');
if (isset($_SESSION["user_email"]))
{
    header("Location: index.php", true);
}
get_template("header.php");
?>

<div class="form-group">
<section id="loginfo">
    <form id="userloginform" method="post" action=""> 
        <fieldset>
            <legend>Login</legend>
            <p>Username <input type="text" name="username" class="input" autocomplete="off" id="username"/></p>
<p>Password <input type="password" name="password" class="input" autocomplete="off" id="password"/></p>
<input type="submit" class="button button-primary" value="Login" id="login"/> 
        </fieldset>
	 </form>
</section>
<section id="invalid">

</section>	
<p>Not Registered? <a href="register.php"> Register Here.</a></p>
<p>Forgot Your Password? <a href="forgot_password.php"> Click Here.</a></p><br>
<p><small>Login as Administrator <a href="admin/index.php"> Here.</a></small></p>
</div>
</div>
        <footer>
            <p >Copyright&copy;&nbsp;<?php echo date("Y", time());?>&nbsp;Green Arrow Consulting</p>
        </footer>
		<script src="jquery.min.js"></script>
		<script src="jquery.ui.shake.js"></script>
	<script> //used online tutorial for how to do shake animation
			$(document).ready(function() {
			$('#login').click(function()
			{
			var username=$("#username").val();
			var password=$("#password").val();
			if ($.trim($("#username").val()) === "" || $.trim($("#password").val()) === "")
			{
			 $("#login").val('Login')
			 $("#invalid").html("<span style='color:#cc0000'>Error:</span> Must enter both username and password. ");
			 $('#loginfo').shake();
			 return false;
			}
			else{
		    var dataString = 'username='+username+'&password='+password;
			if($.trim(username).length>0 && $.trim(password).length>0)
			{
			
 
			$.ajax({
            type: "POST",
            url: "loginuser.php",
            data: dataString,
            cache: false,
            beforeSend: function(){ $("#login").val('Connecting...');},
            success: function(data){
            if(data)
            {
            $("body").load("index.php").hide().fadeIn(1500).delay(6000);
            }
            else
            {
			 $("#login").val('Login')
			 $("#invalid").html("<span style='color:#cc0000'>Error:</span> Invalid username and password. ");
			 $('#loginfo').shake();
            }
            }
            });
			
			}
			return false;
			}});
			
				
			});
		</script>
    </body>
</html>
