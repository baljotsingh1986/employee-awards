<?php
if(!empty($_POST)){
	if(isset($_POST["user_email"]) && isset($_POST["password"])) {
		
		if(trim($_POST["user_email"]) != "" && trim($_POST["password"]) != "") {
			$user = new Admin();
			$user->user_email=$_POST["user_email"];
			$user->password=$_POST["password"];
			if($user->add_new()){
				$GLOBALS['msg'] = '<p style="color:green;"> <b>New Admin is added successfully.</b></p>';
			}
			else{
				$GLOBALS['msg'] = '<p style="color:red;"> <b>'.$user->error.'</b></p>';
			}
		}
		else{
			$GLOBALS['msg'] = '<p style="color:red;"> <b>Please Enter all required fields.</b></p>';
		}
	}
	else
	{
		$GLOBALS['msg'] = '<p style="color:red;"> <b>Please Enter all required fields.</b></p>';
	}
}	 
?>