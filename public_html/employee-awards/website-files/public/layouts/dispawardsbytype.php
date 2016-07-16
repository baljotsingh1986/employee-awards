<?php
/*ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once(__DIR__.'/../../initialize.php');
$session->check_adm_login();
if(!$session->is_admin_logged_in()){
    echo "unauthorized access";
	return;
}
//$_POST['mindate'] = '2016-01-31';
//$_POST['maxdate'] = '2017-01-31';
if(!isset($_POST['mindate']) || !isset($_POST['maxdate'])){
	return;
}

if(trim($_POST['mindate']) == "" || trim($_POST['maxdate']) == ""){
	return;
}*/
?>

 <p><h4>Awards Group by Award Type</h4></p>
				<form style="border:none;">
    <div class="form-group">
      <div class="col-xs-6">
        <label for="minaward">Minimum Awards Given:</label>
        <input class="form-control" id="minaward" type="number" placeholder="0">
      </div>
      <div class="col-xs-6">
        <label for="maxaward">Maximum Awards Given:</label>
        <input class="form-control" id="maxaward" type="number" placeholder="5000">
      </div>
    </div>
  </form>
  <button id="filterdataawardtype" name="filter" class="btn btn-success">Filter</button>
                <table id="displaytable" class="table table-striped">
				<thead>
                    <tr>
                        <th>Award Type</th>
                        <th>Total Awards Given</th>
                    </tr>
                </thead>
				<tfoot>
                    <tr class="noExl">
                       <th>Award Type</th>
                        <th>Total Awards Given</th>
                    </tr>
                </tfoot>
                <!-- PHP-->
<?php
    $data = [];
    $awards = new Award();
	$awards->min_date = $min_date;
	$awards->max_date = $max_date;
	$data = $awards->group_by_type();
	 if(!is_array($data)){
        echo '<p style="color:red;"><b>Error in database. The awards cannot be displayed. Please try again</b></p';
		return;
    }
	else if(empty($data)){
		echo '<p style="color:red;"><b>No data to display. Please try again by changing filters.</b></p';
		return;
	}
    ?>
	<tbody>
   <?php foreach($data as $info): ?>
 <tr class="data" >
	<td><?php if(!isset($info->award_type)){ echo "Unknown/Deleted";} else if(trim($info->award_type) == ""){ echo "Unknown/Deleted";} else{ echo $info->award_type;}?></td>
     <td><?php echo $info->total_awards_type; ?></td>
</tr>

<?php endforeach; ?>
</tbody>
                </table>
				<button id="exportsheet" class="btn btn-success">Export list as excel sheet</button>