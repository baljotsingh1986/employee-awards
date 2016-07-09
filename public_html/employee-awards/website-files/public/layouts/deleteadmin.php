<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);*/
require_once(__DIR__.'/../../initialize.php');
$session->check_adm_login();
if(!$session->is_admin_logged_in()){
    redirect_to('index.php');
} ?>
<?php
$GLOBALS['msg'] = "";
$success = 'not';
    if(isset($_POST["id"])){
        $id = $_POST["id"];
    
        if(trim($id) != ""){
            $admin = new Admin();
			$admin->id = $id;
            if($admin->delete_admin()){
                $GLOBALS['msg'] = '<p style="color:green; text-align: center;"><b>Admin is deleted Successfully.</b></p>';
                $success = 'yes';
				$admin_action = new AdminActions();
				$admin_action->admin_id = $session->admin_id;
				$admin_action->action = 'Admin '.$session->admin_username.' deleted Admin '.$_POST["name"];
				$admin_action->add_new();
            }
            else{
				$re=$admin->delete_admin();
                $GLOBALS['msg'] = '<p style="color:red; text-align: center;"><b>Data base error.Try Again.</b></p>'.$re;
            }
        }
        else{
            $GLOBALS['msg'] = '<p style="color:red; text-align: center;"><b>Error Occured.</b></p>';
        }
    }
header('Content-Type: application/json');
$arr = array("msg"=>$GLOBALS['msg'], 'success'=>$success);
echo json_encode($arr);
?>